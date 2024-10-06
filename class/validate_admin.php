<?php
// Assuming you have established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cwc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch admin ID and password from POST request
$adminId = $_POST['admin_id'];
$adminPassword = $_POST['admin_password'];

// Query to check if admin ID and password exist in the admin table
$sql = "SELECT * FROM admin WHERE admin_id='$adminId' AND password='$adminPassword'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "success";
} else {
    echo "failure";
}

$conn->close();
?>
