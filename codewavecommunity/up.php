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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = $_POST['name'];
    $description = $_POST['description'];
    // File handling
    $file = $_FILES['file']['tmp_name'];
    $fileContent = file_get_contents($file);
    $upload_by = ""; // Initialize

    // Get upload_by from login table
    $stmt = $conn->prepare("SELECT username FROM login LIMIT 1");
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row) {
        $upload_by = $row['username'];
    }

    function generateUniqueRandomNumber($min, $max) {
        $numbers = range($min, $max);
        shuffle($numbers);
        shuffle($numbers);
        shuffle($numbers);
        return reset($numbers); // Get the first element from the shuffled array
    }
    
    // Set the range
    $minNumber = 1;
    $maxNumber = 99999;
    
    // Generate a unique random number
    $file_id = generateUniqueRandomNumber($minNumber, $maxNumber);
    // Generate a unique ID for the file

    // Insert data into resource table
    $stmt = $conn->prepare("INSERT INTO resource (name, description, file, upload_by,file_id) VALUES (:name, :description, :file, :upload_by, :file_id)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':file', $fileContent, PDO::PARAM_LOB);
    $stmt->bindParam(':upload_by', $upload_by);
    $stmt->bindParam(':file_id', $file_id);
    $stmt->execute();

    // Update credit table
    $stmt = $conn->prepare("UPDATE credit SET count = count + 1 WHERE name = :name");
    $stmt->bindParam(':name', $upload_by);
    $stmt->execute();

    // If user is new, insert into credit table
    if ($stmt->rowCount() == 0) {
        $stmt = $conn->prepare("INSERT INTO credit (name, count) VALUES (:name, 1)");
        $stmt->bindParam(':name', $upload_by);
        $stmt->execute();
    }

   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        .container {
            max-width: 500px;
            margin: 50px auto;
        }
        .success-message {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload a PDF File</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter File name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <!-- Larger text area for description -->
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter a description" required></textarea>
            </div>
            <div class="form-group">
                <label for="file">Choose PDF File</label>
                <input type="file" class="form-control-file" id="file" name="file" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <div id="success-message" class="success-message" style="display: none;">
                File uploaded successfully.
            </div>
        </form>
    </div>

    <script>
        // Show success message after form submission
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            document.getElementById('success-message').style.display = 'block';
        <?php endif; ?>
    </script>
</body>
</html>
