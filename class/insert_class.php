<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "classroom";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into class table
$class_name = $_POST['class_name'];
$owner = $_POST['owner'];
$class_image = $_FILES['class_image']['name']; // Assuming the column name in the database is 'image'

$sql = "INSERT INTO class (name, owner, image) VALUES ('$class_name', '$owner', '$class_image')";

if ($conn->query($sql) === TRUE) {
    // Data inserted successfully
    echo "<script>";
    echo "setTimeout(function() { document.getElementById('success-image').style.display = 'block'; }, 0);"; // Display success image
    echo "setTimeout(function() { window.location.href = 'create_class.php'; }, 2000);"; // Redirect after 2 seconds
    echo "</script>";
    
    // Create a table with class name if data inserted successfully
    $create_table_sql = "CREATE TABLE IF NOT EXISTS `$class_name` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        message VARCHAR(255) UNIQUE,
        unique_id INT,
        image VARCHAR(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
        file MEDIUMBLOB
    )";
    
    
    if ($conn->query($create_table_sql) === TRUE) {
       
    } else {
        echo "Error creating table: " . $conn->error;
    }
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}// Redirect to fetch_data.php with class name and owner name as URL parameters
header("Location: fetch_data.php?class_name=" . urlencode($class_name) . "&owner=" . urlencode($owner));
exit();


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        #success-image {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }
    </style>
</head>
<body>
    <img id="success-image" src="success.gif" alt="Success" width="200">
</body>
</html>
