<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cwc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch distinct questions
$distinctQuestionsQuery = "SELECT DISTINCT question FROM ans";
$distinctQuestionsResult = $conn->query($distinctQuestionsQuery);
$questions = [];

while ($row = $distinctQuestionsResult->fetch_assoc()) {
    $questions[] = $row['question'];
}

// Initialize $result to an empty array
$result = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchKeyword"])) {
    $searchKeyword = $_POST["searchKeyword"];

    $searchQuery = "SELECT * FROM ans WHERE question LIKE '%$searchKeyword%'";
    $searchResult = $conn->query($searchQuery);

    while ($row = $searchResult->fetch_assoc()) {
        $result[$row['question']][] = $row;
    }
} else {
    // Fetch answers for each distinct question
    foreach ($questions as $question) {
        $answersQuery = "SELECT * FROM ans WHERE question = '$question'";
        $answersResult = $conn->query($answersQuery);

        while ($answerRow = $answersResult->fetch_assoc()) {
            $result[$question][] = $answerRow;
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Questions and Answers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style>
        body {
            background-color: white;
            background-size: 400% 400%;
            animation: gradientMotion 10s infinite linear;
            font-family: 'Arial', sans-serif;
        }

        @keyframes gradientMotion {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            background-color: #ffffff;
            position: relative; /* Added position relative */
        }

        .card:hover {
            box-shadow: 0 8px 56px rgba(0, 0, 0, 0.2);
        }

        .question-header {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 10px;
        }

        .answer {
            color: #000000;
        }

        .asked-by, .answered-by {
            color: #6c757d;
        }

        /* Animation Styles */
        .card {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .interaction-icons {
            position: absolute;
            bottom: 15px;
            right: 15px;
            display: flex;
        }

        .interaction-icons i {
            margin-right: 10px;
            cursor: pointer;
        }

        .comment-popup {
    display: none;
    position: fixed;
    top: 10%; /* Adjust top position as needed */
    left: 50%;
    transform: translateX(-50%);
    width: 80%; /* Adjust width as needed */
    max-width: 600px; /* Set a maximum width */
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000; /* Ensure the pop-up appears above other elements */
    overflow: auto; /* Enable scrolling if content exceeds the box size */
}


        .comment-popup textarea {
            width: 100%;
            height: 80px; /* Adjust height as needed */
            margin-bottom: 10px;
            resize: none;
        }

        .comment-popup button {
            float: right;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .go-back-button {
            position: fixed;
            top: 10px;
            left: 15px;
            background-color: #ff0022;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
</head>
<body>

<div class="container">
<button class="go-back-button" onclick="goBack()">
        <i class="fas fa-arrow-left"></i> Go Back
    </button>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="mb-4">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="text" class="form-control" name="searchKeyword" placeholder="Search Question..">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>

            <?php
           foreach ($result as $question => $answers) {
            foreach ($answers as $answer) {
                echo "<div class='card'>";
                echo "<p class='question-header'><i class='fas fa-question-circle'></i> Question: " . $question . "</p>";
                echo "<p class='answer'><i class='fas fa-check-circle'></i> Answer: " . nl2br($answer['answer']) . "</p>";
                echo "<p class='asked-by'><i class='fas fa-user'></i> Asked By: " . $answer['askby'] . "</p>";
                echo "<p class='answered-by'><i class='fas fa-user-check'></i> Answered By: " . $answer['ansby'] . "</p>";
        
                // Comment icon
                echo "<div class='interaction-icons'>";
                echo "<i class='fas fa-comment fa-lg comment-icon' onclick='showCommentPopup(" . $answer['id'] . ", \"" . $question . "\")'></i>";
        
                
                echo "</div>";
        
                // Comment popup
                echo "<div id='commentPopup_" . $answer['id'] . "' class='comment-popup'>";
                echo "<button class='close-button' onclick='hideCommentPopup(" . $answer['id'] . ")'><i class='fas fa-times'></i></button>";
                echo "<p><strong>Question:</strong> " . $question . "</p>";
                echo "<p><strong>Answer:</strong> " . nl2br($answer['answer']) . "</p>";
                echo "<p><a href='javascript:void(0)' onclick='loadComments(" . $answer['id'] . ", \"" . $question . "\")'>See all comments</a></p>";
                echo "<div id='comments_" . $answer['id'] . "'></div>";
                echo "<textarea id='commentText_" . $answer['id'] . "' placeholder='Write your comment...'></textarea>";
                echo "<button onclick='submitComment(" . $answer['id'] . ", \"" . $question . "\")'><i class='fas fa-paper-plane'></i> Submit Comment</button>";
                echo "</div>";
                
                
                
        
                echo "</div>";
            }
        }
            ?>
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.location.href = 'doubt.html';
    }
    document.addEventListener("click", function (event) {
        var clickedElement = event.target;

        // Check if the clicked element is not a comment icon or the comment pop-up
        if (!clickedElement.classList.contains("comment-icon") && !clickedElement.closest(".comment-popup")) {
            hideAllCommentPopups();
        }
    });

    function hideAllCommentPopups() {
        var commentPopups = document.querySelectorAll(".comment-popup");
        commentPopups.forEach(function (popup) {
            popup.style.display = "none";
        });
    }

    function showCommentPopup(answerId) {
        // Hide all comment pop-ups first
        hideAllCommentPopups();

        var commentPopup = document.getElementById("commentPopup_" + answerId);
        if (commentPopup) {
            commentPopup.style.display = "block";
        }
    }

    function submitComment(answerId) {
        var commentText = document.getElementById("commentText_" + answerId).value;

        // You may want to add additional validation for commentText

        // Send the comment to the server using a form submission
        // Here you can use JavaScript to submit a form with answerId and commentText as parameters
        var form = document.createElement('form');
        form.method = 'post';
        form.action = 'submit_comment.php'; // Replace with your comment submission PHP file

        var inputAnswerId = document.createElement('input');
        inputAnswerId.type = 'hidden';
        inputAnswerId.name = 'answerId';
        inputAnswerId.value = answerId;

        var inputCommentText = document.createElement('input');
        inputCommentText.type = 'hidden';
        inputCommentText.name = 'commentText';
        inputCommentText.value = commentText;

        form.appendChild(inputAnswerId);
        form.appendChild(inputCommentText);

        document.body.appendChild(form);
        form.submit();
    }

    
    function loadComments(answerId, question) {
        // Fetch comments from the server using PHP
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Display comments in the comments div
                document.getElementById("comments_" + answerId).innerHTML = this.responseText;
            }
        };

        // Replace 'fetch_comments.php' with the actual PHP file to fetch comments
        xhr.open("GET", "fetch_comments.php?question=" + encodeURIComponent(question) + "&answerId=" + answerId, true);
        xhr.send();
    }
    function hideCommentPopup(answerId) {
    var commentPopup = document.getElementById("commentPopup_" + answerId);
    if (commentPopup) {
        commentPopup.style.display = "none";
    }
}

</script>


</body>
</html>
