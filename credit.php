<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cwc";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Fetch the username from the login table
$stmt = $conn->prepare("SELECT username FROM login LIMIT 1");
$stmt->execute();
$user_row = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $user_row['username'];

// Fetch the count for the user from the credit table
$stmt = $conn->prepare("SELECT count FROM credit WHERE name = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$count_row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $count_row ? $count_row['count'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Count</title>
    <style>
        /* Custom CSS */
        .container {
            max-width: 400px;
            margin: 50px auto;
            font-family: Arial, sans-serif;
        }

        .card {
            background-color: #f5f5f5;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card h3 {
            margin-top: 0;
            font-size: 20px;
            color: #333;
        }

        .progress-wrapper {
            margin-bottom: 20px;
        }

        .progress {
            height: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #4caf50;
            transition: width 0.6s ease;
        }

        .button-container {
            text-align: center;
        }

        .get-reward-button {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .get-reward-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h3>Progress Towards Reward</h3>
            <p>Keep uploading files to earn credits! Once you reach 100 credits, you'll be eligible for a special reward.</p>
        </div>

        <div class="progress-wrapper">
            <!-- Progress Bar -->
            <div class="progress">
                <div class="progress-bar" style="width: <?php echo $count >= 100 ? '100' : $count; ?>%;"></div>
            </div>
        </div>
        
        <!-- "Get Reward" Button (Disabled by Default) -->
        <div class="button-container">
            <button class="get-reward-button" <?php echo $count < 100 ? 'disabled' : ''; ?> onclick="openRewardPage()">Get Reward</button>
        </div>
    </div>

    <script>
        function openRewardPage() {
            window.location.href = 'http://localhost/codewavecommunity/reward.php';
        }
    </script>
</body>
</html>
