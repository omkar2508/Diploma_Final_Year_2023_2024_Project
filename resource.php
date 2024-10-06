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

// Fetch uploaded files from the database
$stmt = $conn->prepare("SELECT * FROM resource");
$stmt->execute();
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .container {
            margin-top: 50px;
        }
        .card {
            border: 1px solid #dee2e6;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            max-height: 200px;
            object-fit: contain;
            transition: transform 0.3s;
        }
        .card-img-top:hover {
            transform: scale(1.1); /* Increase size when hovering */
        }
        .btn-primary {
            margin: 10px;
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Uploaded Files</a>
            <form class="form-inline">
                <a href="http://localhost/codewavecommunity/report.php" class="btn btn-secondary my-2 my-sm-0">Report</a>
                <a href="http://localhost/codewavecommunity/up.php" class="btn btn-primary my-2 my-sm-0">Upload File</a>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <?php foreach ($files as $file): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="pdf.png" class="card-img-top" alt="PDF Icon">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $file['name']; ?></h5>
                            <p class="card-text"><?php echo $file['description']; ?></p>
                            <p class="card-text">Uploaded by: <?php echo $file['upload_by']; ?></p>
                            <a href="download.php?file_id=<?php echo $file['file_id']; ?>" class="btn btn-primary">Download</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
