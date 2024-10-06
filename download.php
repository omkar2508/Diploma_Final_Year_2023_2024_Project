<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cwc";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve file data based on file_id
    if (isset($_GET['file_id'])) {
        $file_id = $_GET['file_id'];
        $stmt = $conn->prepare("SELECT name, file FROM resource WHERE file_id = :file_id");
        $stmt->bindParam(':file_id', $file_id);
        $stmt->execute();
        $file = $stmt->fetch();

        // If file data retrieved successfully, force file download
        if ($file) {
            $filename = $file['name'] . ".pdf";
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            echo $file['file'];
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "File ID not specified.";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
