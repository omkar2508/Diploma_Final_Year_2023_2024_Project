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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $issue = $_POST['issue'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO report (username, file, issue) VALUES (:username, :file, :issue)");
    $stmt->bindParam(':username', $username);
    $stmt->bindValue(':file', $_POST['file']); // Use bindValue for direct value insertion
    $stmt->bindParam(':issue', $issue);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Reported Sucessfully.";
    } else {
        echo "Error inserting data.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Form</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input[type="text"]:hover,
        textarea:hover {
            border-color: #007bff;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
        <h2>Report Form</h2>
        <form action="#" method="post">
            <label for="username">Uploader's Name:</label>
            <input type="text" id="username" name="username" placeholder="Enter original file Uploader's name" required>

            <label for="file">Filename:</label>
            <textarea id="file" name="file" rows="4" placeholder="Enter name of the file" required></textarea> <!-- Changed input type to textarea -->

            <label for="issue">Issue:</label>
            <textarea id="issue" name="issue" rows="4" placeholder="What is your problem?" required></textarea>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
