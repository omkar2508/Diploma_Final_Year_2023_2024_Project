<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cwc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answerId"], $_POST["commentText"])) {
    $answerId = $_POST["answerId"];
    $commentText = $_POST["commentText"];

    // Get the question and answer details based on answerId
    $answerDetailsQuery = "SELECT * FROM ans WHERE id = $answerId";
    $answerDetailsResult = $conn->query($answerDetailsQuery);

    if ($answerDetailsResult) {
        if ($answerDetailsResult->num_rows > 0) {
            $answerDetails = $answerDetailsResult->fetch_assoc();
            $question = $answerDetails["question"];
            $answer = $answerDetails["answer"];
            $answerIdFromAnsTable = $answerDetails["id"]; // Added line to get answer_id

            $answererQuery = "SELECT username FROM login LIMIT 1"; // Adjust the query as per your login table structure
            $answererResult = $conn->query($answererQuery);

            if ($answererResult) {
                if ($answererResult->num_rows > 0) {
                    $answererRow = $answererResult->fetch_assoc();
                    $commentBy = $answererRow["username"];

                    // Insert the comment into the comment table
                    $insertCommentQuery = "INSERT INTO comment (question, answer, comment, comment_by, answer_id) 
                                           VALUES ('$question', '$answer', '$commentText', '$commentBy', '$answerIdFromAnsTable')";

                    if ($conn->query($insertCommentQuery) === TRUE) {
                        echo "Comment submitted successfully!";
                        echo "<script>
                                setTimeout(function() {
                                    window.location.href = 'see_ans.php';
                                }, 1000);
                              </script>";
                    } else {
                        $error_message = "Error: " . $insertCommentQuery . "<br>" . $conn->error;
                        echo $error_message;
                        error_log($error_message); // Log the error
                    }
                } else {
                    echo "Error: No rows in the answerer result";
                }
            } else {
                echo "Error in answerer query: " . $conn->error;
            }
        } else {
            echo "Error: No rows in the answer details result";
        }
    } else {
        echo "Error in answer details query: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
