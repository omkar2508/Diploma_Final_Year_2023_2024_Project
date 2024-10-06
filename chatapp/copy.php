<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .success-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #4CAF50; /* Green color */
            color: #fff; /* White text */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out;
            z-index: 1000;
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .success-message {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn-container {
            margin-top: 20px;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var successPopup = document.querySelector('.success-popup');
            if (successPopup) {
                successPopup.style.display = 'block';
            }
        });
    </script>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username1 = "root";
$password1 = ""; // Empty password
$cwc_dbname = "cwc";
$chatapp_dbname = "chatapp";

// Create connection to chatapp database
$chatapp_conn = new mysqli($servername, $username1, $password1, $chatapp_dbname);
if ($chatapp_conn->connect_error) {
    die("Connection to chatapp database failed: " . $chatapp_conn->connect_error);
}

// Retrieve data from the users table of the chatapp database
$select_sql = "SELECT * FROM users ORDER BY user_id DESC LIMIT 1";
$result = $chatapp_conn->query($select_sql);
if ($result === false) {
    die("Query execution failed: " . $chatapp_conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = mysqli_real_escape_string($chatapp_conn, $row['fname']);
    $lname = mysqli_real_escape_string($chatapp_conn, $row['lname']);
    $email = mysqli_real_escape_string($chatapp_conn, $row['email']);
    $password = mysqli_real_escape_string($chatapp_conn, $row['password']);
    $img = mysqli_real_escape_string($chatapp_conn, $row['img']);

    // Close the connection to the chatapp database
    $chatapp_conn->close();

    // Create connection to cwc database
    $cwc_conn = new mysqli($servername, $username1, $password1, $cwc_dbname);
    if ($cwc_conn->connect_error) {
        die("Connection to cwc database failed: " . $cwc_conn->connect_error);
    }

    // Generate unique_id
    $ran_id = rand(time(), 100000000);

    // Insert data into the users table of the cwc database
    $insert_query = mysqli_query($cwc_conn, "INSERT INTO users (name,username, email, password, profile_photo)
        VALUES ('{$fname}','{$lname}', '{$email}', '{$password}', '{$img}')");

    if ($insert_query) {
        echo "<div class='success-popup'>
                  <div class='success-message'>Registered successfully. Now Click on below login button to explore...</div>
                  <div class='btn-container'>
                  <button type='button' class='btn btn-primary' onclick=\"location.href='/codewavecommunity/login.php';\">Login</button>
                  </div>
              </div>";
    } else {
        echo "Something went wrong. Please try again!";
    }

    // Close cwc database connection
    $cwc_conn->close();
} else {
    echo "No data found in the chatapp.users table!";
}
?>
</body>
</html>








