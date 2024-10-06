<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cwc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["question"]) && isset($_GET["answerId"])) {
    $question = $_GET["question"];
    $answerId = $_GET["answerId"];

    // Correct the query to match the columns in the 'comments' table
    $commentsQuery = "SELECT * FROM comment WHERE question = '$question' AND answer_id = $answerId";
    $commentsResult = $conn->query($commentsQuery);

    if ($commentsResult === false) {
        // Print the SQL query and the MySQL error if there is one
        echo "Error in query: " . $commentsQuery . "<br>" . $conn->error;
    } else {
        if ($commentsResult->num_rows > 0) {
            // Output each comment
            while ($comment = $commentsResult->fetch_assoc()) {
                echo "<p><strong>" . $comment['comment_by'] . ":</strong> " . $comment['comment'] . "</p>";
            }
        } else {
            echo "<p>No comments available for this answer.</p>";
        }
    }
} else {
    echo "<p>Invalid request.</p>";
}

// Close the database connection
$conn->close();
?>
