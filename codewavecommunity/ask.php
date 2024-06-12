<?php

// Function to generate a unique random number
function generateUniqueRandomNumber($min, $max) {
    $numbers = range($min, $max);
    shuffle($numbers);
    shuffle($numbers);
    shuffle($numbers);
    return reset($numbers); // Get the first element from the shuffled array
}

// Set the range
$minNumber = 1;
$maxNumber = 999999;

// Generate a unique random number
$uniqueRandomNumber = generateUniqueRandomNumber($minNumber, $maxNumber);

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

// Initialize username
$username = "";

// Fetch username from login table
$result = $conn->query("SELECT * FROM login");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve question
    $question = $_POST["question"];
    $id=$uniqueRandomNumber;
    // Insert the question into the 'pending_question' table
    $sql = "INSERT INTO pending_question (username, question, id) VALUES ('$username', '$question','$id')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Question submitted successfully!'); window.location.href = 'doubt.html';</script>";
        exit; // Prevent further execution
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
    <title>Ask a Doubt</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/4aeb584d0b.js" crossorigin="anonymous"></script>
    <style>
        <style>
          body {
            background-color: white;
            background-size: 400% 400%;
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
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
          
            
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            
        }

        .card-header h5 {
            margin-bottom: 10px;
            color: #000509;  /* Bootstrap primary color */
            font-size: 25px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Animation Styles */
        .btn-animated-border {
            border: 2px solid transparent;
            transition: border-color 0.5s ease-in-out;
        }

        .btn-animated-border:hover {
            border-color: red;
        }

        /* Additional Styles */
        .form-control {
            resize: vertical;
        }

        .form-control:focus {
            border-color: #007bff; /* Bootstrap primary color */
            box-shadow: none;
        }

        .btn-animated-scale {
            transition: transform 0.3s ease-in-out;
        }

        .btn-animated-scale:hover {
            transform: scale(1.1);
        }

        .btn-animated-fade {
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .btn-animated-fade:hover {
            opacity: 0.8;
        }

        .btn-animated-spin {
            transition: transform 0.5s ease-in-out;
        }

        .btn-animated-spin:hover {
            transform: rotate(360deg);
        }

        .btn-animated-bounce {
            animation: bounce 0.5s ease-in-out;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        .btn-animated-shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            10%, 30%, 50%, 70%, 90% {
                transform: translateX(-10px);
            }
            20%, 40%, 60%, 80% {
                transform: translateX(10px);
            }
        }

        .btn-animated-slide {
            transition: transform 0.5s ease-in-out;
        }

        .btn-animated-slide:hover {
            transform: translateX(20px);
        }

        .btn-animated-border {
            border: 2px solid transparent;
            transition: border-color 0.3s ease-in-out;
            font-size: 18px; /* Adjusted font size */
        }

        .btn-animated-border:hover {
            border-color: #007bff !important; /* Change to Bootstrap primary color */
        }

        .btn-animated-pulse {
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ask a Doubt</h5>
                </div>
                <div class="card-body">
                    <div>
                        <!-- Display username -->
                        <p>Welcome, <?php echo $username; ?>!</p>
                    </div>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <!-- Removed the "Your Name" field -->
                            <label for="question">Your Question:</label>
                            <textarea class="form-control" rows="6" name="question" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-animated-border btn-animated-scale btn-animated-fade btn-animated-spin btn-animated-bounce btn-animated-shake btn-animated-slide btn-animated-glow btn-animated-pulse">
                            <i class="fas fa-paper-plane"></i> Submit Question
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
