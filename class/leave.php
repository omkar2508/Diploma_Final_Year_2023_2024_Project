<?php
// Check if the leave button is clicked
if(isset($_POST['leave_class'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cwc"; // Database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the username from the login table
    $usernameQuery = "SELECT username FROM login LIMIT 1";
    $usernameResult = $conn->query($usernameQuery);

    if ($usernameResult->num_rows > 0) {
        $row = $usernameResult->fetch_assoc();
        $username = $row['username'];

        // Get the class name from the form
        $class_name = $_POST['class_name'];

        // SQL to delete the class entry from join_class table
        $sql = "DELETE FROM join_class WHERE user = '$username' AND class = '$class_name'";

        if ($conn->query($sql) === TRUE) {
            // Redirect to joined_classes.php
            header("Location: joined_classes.php");
            exit(); // Ensure that subsequent code is not executed after redirection
        } else {
            echo "Failed to leave the classroom: " . $conn->error;
        }
    } else {
        echo "Error: Unable to fetch username from login table";
    }

    $conn->close();
}
?>
