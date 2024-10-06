<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="register.css">
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
    }
    .container{
        margin-top:50px;
        margin-bottom: 50px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <h2>Sign up to Code Wave Community</h2>
        <form method="post" action="regi.php" enctype="multipart/form-data">
            <div class="form-field">
                <label for="name">Name:</label>
                <input autocomplete="name" class="text-input" type="text" name="user_name" id="user_name">
            </div>
            <div class="form-field">
                <label for="username">Username:</label>
                <input autocorrect="off" autocapitalize="off" autocomplete="username" class="text-input" type="text" name="user_login" id="user_login">
            </div>
            <div class="form-field">
                <label for="email">Email:</label>
                <input class="text-input" type="text" name="user_email" id="user_email">
            </div>
            <div class="form-field">
                <label for="mobile">Mobile Number:</label>
                <input class="text-input" type="tel" name="user_mobile" id="user_mobile" placeholder="9999999999" pattern="\d{10}" required>
            </div>
            <div class="form-field">
                <label for="password">Password:</label>
                <input class="text-input" placeholder="6+ characters" type="password" name="user_password" id="user_password">
            </div>
            <div class="form-field">
                <label for="profile_photo">Profile Photo:</label>
                <input type="file" name="profile_photo" id="profile_photo">
            </div>
            <div class="form-field check-wrap opt-in">
                <input type="checkbox" id="user_agree_to_terms" name="user[agree_to_terms]" required>
                <label for="user_agree_to_terms">
                    I agree with CodeWaveCommunity's
                    <a target="_blank" href="/terms">Terms of Service</a>,
                    <a target="_blank" href="/privacy">Privacy Policy</a>, and default
                    <a target="_blank" href="/notifications">Notification Settings</a>.
                </label>
            </div>
            <div class="form-btns">
                <input type="submit" name="commit" value="Create Account" class="btn2 btn2--large btn2--full-width margin-t-20" data-disable-with="Create Account">
                <div class="sign-up1">
                    <p class="auth-link color-deep-blue-sea-light-20">
                        Already have an account? <a href="/session/new">Sign In</a>
                    </p>
                </div>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cwc";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $name = $_POST["user_name"];
            $username = $_POST["user_login"];
            $email = $_POST["user_email"];
            $mobile = $_POST["user_mobile"];
            $password =$_POST["user_password"];

           // Handle image upload
    $targetDir = "uploads/";
    $fileName = basename($_FILES["profile_photo"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFilePath)) {
            // Convert image data to base64 string
            $imageData = base64_encode(file_get_contents($targetFilePath));
            // Insert user data into database
            $sql = "INSERT INTO users (name, username, email, mobile, password, profile_photo) VALUES ('$name', '$username', '$email', '$mobile', '$password', '$imageData')";
            if ($conn->query($sql) === TRUE) {
                
                
                header("Location: http://localhost/codewavecommunity/copy.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Invalid file format.";
    }
    $conn->close();
}
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var successPopup = document.querySelector('.success-popup');
            if (successPopup) {
                successPopup.style.display = 'block';
            }
        });
    </script>
</body>
</html> 