<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload and Redirect</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        margin-top: 0;
    }

    p {
        margin-bottom: 20px;
    }

    .redirect-message {
        color: #007bff;
    }
</style>
</head>
<body>
<div class="container">
<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "classroom";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the class name from the request
    $className = isset($_POST['class_name']) ? $_POST['class_name'] : '';

    // Get form data
    $message = $_POST['message'];

    // File upload directory
    $targetDir = "uploads/";

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $targetFilePath = $targetDir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath);
    } else {
        $image = "";
    }

    // Handle file upload
    if (!empty($_FILES['file']['name'])) {
        $file = $_FILES['file']['name'];
        $targetFilePath = $targetDir . basename($file);
        move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);
    } else {
        $file = "";
    }

    // Insert data into the class-specific table
    $sql = "INSERT INTO `$className` (message, image, file) VALUES (:message, :image, :file)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':file', $file);
    $stmt->execute();

    echo "Thanks for posting..";
}

// Close connection
$conn = null;
?>

<script>
// Redirect to fetch_data.php after 1 seconds
setTimeout(function() {
    window.location.href = "joined_classes.php";
}, 1000); // 1000 milliseconds = 1 seconds
</script>

</div>
</body>
</html>
