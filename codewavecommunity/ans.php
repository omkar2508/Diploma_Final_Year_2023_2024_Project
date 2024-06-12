<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cwc";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function generateUniqueRandomNumber($min, $max) {
    $numbers = range($min, $max);
    shuffle($numbers);
    shuffle($numbers);
    shuffle($numbers);
    return reset($numbers); // Get the first element from the shuffled array
}

// Initialize $result to an empty array
$result = [];

// Process form submission for search
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchKeyword"])) {
    $searchKeyword = $_POST["searchKeyword"];
    $sql = "SELECT * FROM pending_question WHERE question LIKE '%$searchKeyword%'";
    $result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
} else {
    // If no search keyword is provided, fetch all records
    $sql = "SELECT * FROM pending_question";
    $result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

// Process form submission for answer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["questionId"], $_POST["answer"])) {
    $questionId = $_POST["questionId"];
    $answer = $_POST["answer"];

    // Retrieve asker's name and question from pending_question table
    $askerQuery = "SELECT username, question FROM pending_question WHERE id = $questionId";
    $askerResult = $conn->query($askerQuery);

    if ($askerResult->num_rows > 0) {
        $askerRow = $askerResult->fetch_assoc();
        $askerName = $askerRow["username"];
        $questionText = $askerRow["question"];
        $minNumber = 1;
        $maxNumber = 999999;
        $answerId = generateUniqueRandomNumber($minNumber, $maxNumber);

        // Retrieve answerer's name from login table (Assuming it's a login table, adjust if different)
        $answererQuery = "SELECT username FROM login LIMIT 1"; // Adjust the query as per your login table structure
        $answererResult = $conn->query($answererQuery);

        if ($answererResult->num_rows > 0) {
            $answererRow = $answererResult->fetch_assoc();
            $answererName = $answererRow["username"];

            // Insert data into ans table with the generated unique ID
            $insertQuery = "INSERT INTO ans (question, answer, askby, ansby, id) 
            VALUES ('$questionText', '$answer', '$askerName', '$answererName','$answerId')";

            if ($conn->query($insertQuery) === TRUE) {
                // Redirect to ans.php after submitting the answer
                header("Location: ans.php");
                exit(); // Stop further execution
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Unable to retrieve answerer's name from login table";
        }
    } else {
        echo "Error: Unable to retrieve asker's name and question from pending_question table";
    }
}

// Close the database connection
$conn->close();
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Pending Questions</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/4aeb584d0b.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #ffffff; /* White background */
        }

        .container {
            margin-top: 50px;
        }

        .table {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }

        .table:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .btn-animated-border {
            border: 2px solid transparent;
            transition: border-color 0.3s ease-in-out;
        }

        .btn-animated-border:hover {
            border-color: transparent; /* Removed the red border color */
        }

        .btn-animated-scale {
            transition: transform 0.3s ease-in-out;
        }

        .btn-animated-scale:hover {
            transform: scale(1.1);
            color: #ffffff; /* White text color */
            background-color
: #007bff; /* Blue button color */
            border: 1px solid #007bff; /* Blue button border */
        }

        .btn-orange {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px; /* Adjust padding for better appearance */
            color: #ffffff; /* White text color */
            background-color: #ffa500; /* Orange button color */
            border: 1px solid #ffa500; /* Orange button border */
        }

        .search-form {
            margin-bottom: 20px;
            animation: slideInDown 0.5s ease-in-out;
        }

        .answer-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            padding: 20px;
            background-color: #ffffff; /* White background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        #answer {
            height: 350px; /* Increased textarea height */
        }
        .close {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 30px;
        font-weight: bold;
        color: white;
        background-color: #007bff; /* Blue background */
        border: none;
        border-radius: 10%;
        padding: 1px;
        cursor: pointer;
    }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="search-form">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="text" class="form-control mb-2" name="searchKeyword" placeholder="Search Question..">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-animated-border btn-animated-scale">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Asked By</th>
                        <th>Question</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['question'] . "</td>";
                    // Pass the question ID and question text to showAnswerForm
                    echo "<td>
                            <button class='btn btn-orange btn-animated-border btn-animated-scale' onclick='showAnswerForm(" . $row['id'] . ", \"" . $row['question'] . "\")'>
                                <i class='fas fa-reply'></i> Answer
                            </button>
                        </td>";
                    echo "</tr>";
                }                
                    ?>
                </tbody>
            </table>
            <div id="answerForm" class="answer-form">
                <button type="button" class="close" aria-label="Close" onclick="hideAnswerForm()">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form method="post" action="ans.php">
                    <div class="form-group">
                        <!-- Display the question -->
                        <label for="question">Question:</label>
                        <!-- Display the question as simple borderless text -->
                        <p id="question" class="form-control-plaintext"></p>
                        <!-- Your Answer -->
                        <label for="answer">Your Answer:</label>
                        <textarea class="form-control" rows="6" id="answer" required name="answer"></textarea>
                        <!-- Hidden input for question ID -->
                        <input type="hidden" id="questionId" name="questionId">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-animated-border btn-animated-scale">
                        <i class="fas fa-paper-plane"></i> Submit Answer
                    </button>
                </form>
            </div>
            
            
            
        </div>
    </div>
</div>

<script>
    function showAnswerForm(questionId, questionText) {
    // Set the question ID and question text
    document.getElementById("questionId").value = questionId;
    document.getElementById("question").textContent = questionText;
    // Display the answer form
    document.getElementById("answerForm").style.display = "block";
}

    function hideAnswerForm() {
        // Clear the answer field
        document.getElementById("answer").value = "";
        // Hide the answer pop-up
        document.getElementById("answerForm").style.display = "none";
    }
</script>

</body>
</html>
