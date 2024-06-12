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
$emailSentMessage = ""; 
// Initialize variables for upiNumber and email
$upiNumber = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Fetch upiNumber and email from the form
    $upiNumber = $_POST["upiNumber"];
    $email = $_POST["email"];

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

    // If count is greater than or equal to 100, send email
    if ($count >= 100) {
        // Python script for sending email
        $python_script = "
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# Email configuration
sender_email = 'codewavecommunity44@gmail.com'
receiver_email = 'abhaypatil5474@gmail.com'
subject = 'Reward Request'
body = 'Hello Abhay, I have requested a reward.\\n\\n';
body += 'UPI Number: ' + '" . json_encode($upiNumber) . "' + '\\n';
body += 'Email: ' + '" . json_encode($email) . "' + '\\n';
body += 'Username: ' + '" . json_encode($username) . "' + '\\n';

# SMTP server configuration
smtp_server = 'smtp.gmail.com'
smtp_port = 587  # For starttls
smtp_username = 'codewavecommunity44@gmail.com'
smtp_password = 'zlrn oebm opnm cbxi'

# Create message container
msg = MIMEMultipart()
msg['From'] = sender_email
msg['To'] = receiver_email
msg['Subject'] = subject

# Attach body to the email
msg.attach(MIMEText(body, 'plain'))

try:
    # Start a secure SMTP session
    server = smtplib.SMTP(smtp_server, smtp_port)
    server.starttls()
    server.login(smtp_username, smtp_password)

    # Send the email
    server.sendmail(sender_email, receiver_email, msg.as_string())

    # Close the SMTP connection
    server.quit()
    print('Email sent successfully!')
    emailSentMessage = 'Email sent successfully!'
except Exception as e:
    print('Failed to send email:', str(e))
";

        // Write the Python script to a file
        $file = fopen("send_email.py", "w");
        fwrite($file, $python_script);
        fclose($file);

        // Execute Python script
        exec("C:\Users\abhay\AppData\Local\Programs\Python\Python310\python.exe send_email.py");

        // Delete the Python script file
        unlink("send_email.py");
        $new_count = $count - 100;
        $stmt = $conn->prepare("UPDATE credit SET count = :count WHERE name = :username");
        $stmt->bindParam(':count', $new_count);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    } else {
        echo "Failed";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Cash Out</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .container {
            max-width: 400px;
            margin: 50px auto;
            font-family: Arial, sans-serif;
        }

        .form-group label {
            font-weight: bold;
        }

        .note {
            color: red;
            margin-top: 20px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .get-cash-button {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .get-cash-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reward Cash Out</h2>
        <?php if (!empty($emailSentMessage)) : ?>
            <div class="message"><?php echo $emailSentMessage; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="upiNumber">UPI Number</label>
                <input type="text" class="form-control" id="upiNumber" name="upiNumber" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="note">
                <p>You will get your reward in 2 to 7 days to your account/number after clicking on Get Reward Button. Make sure that you have entered the correct UPI number and Email ID.</p>
            </div>
            <div class="button-container">
                <button type="submit" name="submit" class="get-cash-button">Get Reward</button>
            </div>
            <!-- Add hidden input fields to store form data and username -->
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <input type="hidden" name="count" value="<?php echo $count; ?>">
            <input type="hidden" name="username" value="<?php echo $username; ?>">
        </form>
    </div>
</body>
</html>