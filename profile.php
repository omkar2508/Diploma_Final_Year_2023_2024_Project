<?php
// Assuming you have a database connection established
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "cwc";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch username from login table
$result = $conn->query("SELECT * FROM login");
$username = "";

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/4aeb584d0b.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .profile-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            width: 400px;
            text-align: center;
            background-color: #fff;
            padding: 30px;
            animation: fadeInUp 0.8s ease-in-out;
            transition: box-shadow 0.3s ease-in-out;
        }

        .profile-card:hover {
            box-shadow: 0 90px 120px rgba(255, 0, 0, 0.2);
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 20px;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-username {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .logout-btn {
            background-color: #007bff;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .logout-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="profile-card">
        <div class="profile-image">
            <img src="user.jpg" alt="User Image">
        </div>
        <div class="profile-username">
            <?php echo $username; ?>
        </div>
       <a href="http://localhost/codewavecommunity/logout.php"> <button class="logout-btn" >Logout</button></a>
    </div>


</body>

</html>
