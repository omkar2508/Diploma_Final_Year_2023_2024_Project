<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cwc"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the class name from the POST request
if(isset($_POST['className'])) {
    // Fetch the username from the login table
    $usernameQuery = "SELECT username FROM login LIMIT 1";
    $usernameResult = $conn->query($usernameQuery);

    if ($usernameResult->num_rows > 0) {
        $row = $usernameResult->fetch_assoc();
        $username = $row['username'];

        // Get the class name from the POST request
        $className = $_POST['className'];

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO join_class (user, class) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $className);

        // Execute the query
        if ($stmt->execute() === TRUE) {
            echo "Joined class '$className' successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Error: Unable to fetch username from login table";
    }
} else {
    echo 'Class name not received.';
}
?>
