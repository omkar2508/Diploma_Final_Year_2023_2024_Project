<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection established
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "cwc"; // Replace with your database name

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate user
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        

        // Insert username into login table
        $sqlInsert = "INSERT INTO login (username) VALUES ('$username')";
        $conn->query($sqlInsert);
        // Valid user, redirect to index.html
        header("Location: http://localhost/codewavecommunity/home.php");
        exit();
    } else {
        // Invalid user, you may handle this case accordingly (e.g., show an error message)
        $message = "Invalid credentials";
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="login.css">
    <style>
        .message {
            color: white;
        }
    </style>
    <title>Login</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.body.addEventListener('click', function () {
                document.querySelector('.message').style.display = 'none';
            });
        });
    </script>
</head>
<body>
    <div class="box">
        <span class="borderLine"></span>
        <form method="post" action="login.php">
            <h2>Login</h2>
            <div class="inputbox">
                <input type="text" name="username" required="required">
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputbox">
                <input type="password" name="password" required="required">
                <span>Password</span>
                <i></i>
            </div>
            <div class="message"><?php echo $message; ?></div>
            <div class="links">
                <a href="#">Forgot Password</a>
                <a href="#">Signup</a>
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
