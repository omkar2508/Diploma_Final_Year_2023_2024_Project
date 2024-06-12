<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Sharing Community</title>
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
            padding: 20px;
            width: 300px;
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
            margin-bottom: 20px;
        }

        .btn-animated-wave {
            position: relative;
            color: #000;
            overflow: hidden;
            display: inline-block;
            padding: 15px 30px;
            font-size: 18px;
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
        <!-- 1st Card: Share Code -->
        <div class="card">
            <h2>Share Your Code</h2>
            <p>Learn how sharing your code on the community can benefit you and others. Share your code on community to get the reviews and feedbacks on your code from the best developers. Click below to share your code.</p>
            <button class="btn btn-animated-wave" onclick="alert('Share code button clicked!')">Share Code</button>
        </div>

        <!-- 2nd Card: Explore Codes -->
        <div class="card">
            <h2>Explore Shared Codes</h2>
            <p>Discover the power of exploring codes shared by other community members. Explore the rich and beautiful codes shared by other developers on community and give your feedback to them. Click below to explore.</p>
            <button class="btn btn-animated-wave" onclick="alert('Explore button clicked!')">Explore</button>
        </div>
    </div>

    <!-- Add your other scripts or external libraries here -->
</body>

</html>
