<?php
  
    if (isset($_POST['logout'])) {
        
        // Assuming you have a connection to the MySQL database
        $db = new mysqli('localhost', 'root', '', 'cwc');
        
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        
        // Delete all records from the login table
        $sql = "DELETE FROM login";
        $result = $db->query($sql);
        
        if ($result) {
            echo "<script>alert('Logout successful....');</script>";
            header('Location: http://localhost/codewavecommunity/index.html' );
        } else {
            echo "Error: " . $db->error;
        }
        
        $db->close();
        
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CodeWaveCommunity</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/4aeb584d0b.js" crossorigin="anonymous"></script>
    <style>
        body {
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
            margin-top: 50px;
        }

        .card {
            background-color: #23242a;
            color: #eae9e9;
            box-shadow: 0 8px 16px rgba(255, 0, 0, 0.2);
            transition: box-shadow 0.3s ease-in-out;
            margin-bottom: 20px;
            
        }

        .card:hover {
            box-shadow: 0 12px 24px rgba(255, 0, 0, 0.4);
        }

        .card-header h5 {
            margin-bottom: 0;
        }

        .btn-icon {
            margin-right: 8px;
        }

        .btn-animated-border,
        .btn-animated-background,
        .btn-animated-shadow {
            display: block;
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            position: relative;
            height: 100%;
            font-size: 18px;
        }

        .btn-animated-border i,
        .btn-animated-background i,
        .btn-animated-shadow i {
            font-size: 24px;
        }

        .btn-animated-border {
            border: 2px solid transparent;
            transition: border-color 0.3s ease-in-out;
        }

        .btn-animated-border:hover {
            border-color: red;
        }

        .btn-animated-background {
            background-color: #28a745;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-animated-background:hover {
            background-color: #218838;
        }

        .btn-animated-shadow {
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.4);
            transition: box-shadow 0.3s ease-in-out;
        }

        .btn-animated-shadow:hover {
            box-shadow: 0 6px 12px rgba(40, 167, 69, 0.6);
        }

        .tooltip {
            position: absolute;
            display: none;
            background-color: #000000;
            color: #eae9e9;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 2;
            font-size: 15px;
            text-align: center;
            top: 100%;
            transform: translateY(10px);
        }

        .btn-animated-border:hover .tooltip,
        .btn-animated-background:hover .tooltip,
        .btn-animated-shadow:hover .tooltip {
            display: block;
            opacity: 1;
            animation: fadeIn 0.5s ease-in-out;
            z-index: 3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .btn-wave {
            position: relative;
            overflow: hidden;
        }

        .btn-wave:before {
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

        .btn-animated-border:hover:before,
        .btn-animated-background:hover:before,
        .btn-animated-shadow:hover:before,
        .btn-wave:hover:before {
            transform: translateX(0);
        }
    </style>
</head>

<body>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">GOOD BY...</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            At CodeWaveCommunity, we understand the value of community. It's where ideas are
                            shared, problems are solved, and friendships are forged. Whether you're a student taking
                            your first coding steps or a seasoned programmer seeking new challenges, you'll find a
                            welcoming community of individuals who share your passion and are eager to learn, grow,
                            and share knowledge together. While our unique features, such as asking doubts,
                            troubleshooting assistance, code reviews, job listings, mentorship opportunities, and an
                            extensive programming resource library, are designed to empower you, we're more than the
                            sum of these parts. We're about your growth as a coder and your journey toward achieving
                            your goals.
                            <br><br><br>
                            Do you really want to logout? 
                        </p>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
