<?php
    // PHP code for database connection and insertion
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

    // Check if the form is submitted
    if (isset($_POST['share'])) {
        // Retrieve data from the form
        $description = $_POST['description'];
        $code = $_POST['code'];

        // SQL query to insert data into the 'share' table
        $sql = "INSERT INTO share (description, code) VALUES ('$description', '$code')";

        if ($conn->query($sql) === TRUE) {
            // Display success message
            echo "<script>alert('Code shared successfully!')</script>";

            // Redirect after 3 seconds
           echo "<script>setTimeout(function() { window.location.href = 'http://localhost/codewavecommunity/share.php'; }, 1000);</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Code</title>
    <!-- Add your CSS styles and animations here -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: linear-gradient(45deg, #ff8a00, #e52e71, #0071e3, #008e00);
            background-size: 400% 400%;
            animation: gradientMotion 10s infinite linear;
        }

        @keyframes gradientMotion {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #23242a;
            color: #eae9e9;
            box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
            transition: box-shadow 0.3s ease-in-out;
            margin: 20px;
            padding: 40px;
            width: 900px;
            text-align: center;
            border-radius: 10px;
            position: relative;
            animation: moveUpDown 1s infinite;
        }

        .card:hover {
            box-shadow: 0 12px 24px rgba(255, 255, 255, 0.4);
            animation: none; /* Stop the movement on hover */
        }

        @keyframes moveUpDown {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .card h2 {
            margin-bottom: 40px;
        }

        .text-field,
        .code-field {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease-in-out;
        }

        .code-field {
            height: 300px;
        }

        .btn-animated-wave {
            position: relative;
            color: #000;
            overflow: hidden;
            display: inline-block;
            padding: 20px;
            font-size: 20px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #ff2770;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-animated-wave:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: waveAnimation 1s infinite linear;
            transform: translateX(-100%);
        }

        @keyframes waveAnimation {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .btn-animated-wave:hover {
            background-color: #45a049;
        }

        .btn-animated-wave:hover:before {
            transform: translateX(0);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Card: Share Code -->
        <div class="card">
            <h2>Share Your Code</h2>
            <form method="post" action="share.php">
                <textarea class="text-field" placeholder="Description (2-3 lines)" rows="3" spellcheck="false" name="description"></textarea>
                <textarea class="code-field" placeholder="Paste your code here" spellcheck="false" name="code"></textarea>
                <button type="submit" name="share" class="btn btn-animated-wave">Share Code</button>
            </form>
        </div>
    </div>

    <!-- Add your other scripts or external libraries here -->
</body>

</html>
