<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Classroom</title>
<script src="https://kit.fontawesome.com/4aeb584d0b.js" crossorigin="anonymous"></script>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }
  
header {
    display: flex;
    margin-bottom: 10px; 
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
  
.logo-container {
    display: flex;
    align-items: center;
}

.logo-container img {
    width: 40px;
    height: 40px;
    margin-right: 10px;
}

.logo-container h1 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

.header-right {
    display: flex;
    align-items: center;
}

.sidebar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #ffffff; /* White background */
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    text-decoration: none;
    color: #333;
    transition: color 0.3s;
    display: block;
    padding: 10px 15px;
    font-size: 20px;
}

.sidebar ul li a:hover {
    color: #f1f1f1;
}

.sidebar .close-btn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 10px; 
    border-top: 1px solid #ccc; /* Add a border line between header and container */
}

.card {
    width: 20%;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    margin: 20px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.card img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 8px 8px 0 0;
}

.card-content {
    padding: 20px;
}

.card-title {
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
}

/* Styles for modal *//* Styles for modal */
.modal {
    display: none;
    position: fixed;
    bottom: 50px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #ffffff;
    width: 80%;
    max-width: 600px; /* Set a maximum width for better readability */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 999; /* Ensure the modal appears on top of other content */
}

/* Close button style */
.close {
    float: right;
    cursor: pointer;
    font-size: 24px;
    color: #999; /* Dim the close button */
}

/* Hover effect for close button */
.close:hover {
    color: #000; /* Darken the close button on hover */
}

/* Style for modal inputs */
.modal input[type="text"],
.modal textarea {
    width: calc(100% - 40px); /* Adjust width to leave space for padding */
    padding: 10px;
    margin: 5px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Style for file input */
.modal input[type="file"] {
    margin-top: 10px;
}

/* Style for the upload button */
.modal input[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Hover effect for the upload button */
.modal input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Upload icon style */
.upload-icon {
    position: fixed;
    bottom: 20px;
    right: 20px;
    font-size: 24px;
    color: #007bff;
    cursor: pointer;
    z-index: 999; /* Ensure the icon appears on top of other content */
}

/* Container for class information */
.class-info-container {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.class-info-container img {
    width: 150px;
    height: 120px;
    margin-left: 50px;
    border-radius: 20px;
    margin-right: 10px;
}

.class-info-container .class-info {
    padding-left: 20px;
    display: flex;
    flex-direction: column;
}

.class-info h2 {
    margin: 0;
    font-size: 30px;
    color: #080000;
}

.class-info p {
    margin: 5px 0;
    font-size: 16px;
    color: #333;
}

/* Container for class information */
.class-info-container {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.class-info-container img {
    width: 150px;
    height: 120px;
    margin-left: 50px;
    border-radius: 20px;
    margin-right: 10px;
}

.class-info-container .class-info {
  padding-left: 20px;
    display: flex;
    flex-direction: column;
}

.class-info h2 {
    margin: 0;
    font-size: 30px;
    color: #080000;
}

.class-info p {
    margin: 5px 0;
    font-size: 16px;
    color: #333;
}


.no-upload-container {
    position: absolute; /* Position the container absolutely */
    top: 50%; /* Place the top edge at the vertical center of the page */
    left: 50%; /* Place the left edge at the horizontal center of the page */
    transform: translate(-50%, -50%); /* Move the container back by half of its own width and height to center it perfectly */
    text-align: center; /* Center align the contents horizontally */
}


.no-upload-container img {
    width: 150px; /* Set image width */
    height: auto; /* Maintain aspect ratio */
    display: block; /* Ensure image is centered properly */
    margin: 0 auto 20px; /* Center the image vertically and add space below */
}

.no-upload-container p {
    font-weight: bold;
    font-size: 16px;
    color: #333;
    margin: 0;
}

</style>
</head>
<body>
<header>
<div class="logo-container">
    <img src="uploads/loo.jpg" alt="Logo">
    <h1>Classroom</h1>
</div>
<div class="header-right">
    <!-- Menu icon -->
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">☰</span>
</div>
</header>

<!-- Sidebar menu -->
<div id="mySidebar" class="sidebar">
<ul>
    <li><a href="joined_classes.php">Joined Classes</a></li>
    <li><a href="classroom.php">All Classes</a></li>
</ul>
<a href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</a>
</div>

<!-- Container for class information -->
<div class="container">
<?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "classroom";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the class name from the request
    $className = $_POST['class_name'];

    // Fetch class owner and image from the database based on the class name
    $sql_info = "SELECT owner, image FROM classroom.class WHERE name = '$className'";
    $result_info = $conn->query($sql_info);

    if ($result_info->num_rows > 0) {
        $row_info = $result_info->fetch_assoc();
        $classOwner = $row_info['owner'];
        $classImage = $row_info['image'];
    } else {
        // handle case when class info is not found
        $classOwner = "Unknown Owner";
        $classImage = ""; // Provide a default image URL if no image is found
    }
?>
<!-- Container for class information -->
<div class="class-info-container">
    <?php if (!empty($classImage)) { ?>
    <img src="<?php echo $classImage; ?>" alt="Class Image">
    <?php } ?>
    <div class="class-info">
        <h2><?php echo isset($className) ? $className : ''; ?></h2>
        <p>Owner: <?php echo isset($classOwner) ? $classOwner : ''; ?></p>
    </div>
</div>

<?php
    // Get the class name from the request
    $className = $_POST['class_name'];

    // Sanitize the class name to prevent SQL injection
    $className = mysqli_real_escape_string($conn, $className);

    // Query to fetch data from the class-specific table
    $sql = "SELECT * FROM `$className`";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<div class="card-content">';
            echo '<h3 class="card-title">' . $row["message"] . '</h3>';
            // Check if there is an image
            if (!empty($row["image"])) {
                echo '<img src="' . $row["image"] . '" alt="Uploaded Image">';
            }
            // Check if there is a PDF file
            if (!empty($row["file"])) {
                echo "There's File Uploaded By Your Teacher : ".'<a href="uploads/' . $row["file"] . '" class="download-btn" download="material.pdf">Download PDF</a>';
            }
            echo '</div></div>';
        }
    } else {
        echo '<div class="no-upload-container">';
        echo '<img src="uploads/upload.gif" alt="No Uploads Image">';
        echo '<p>No uploads till now</p>';
        echo '</div>';
    }
    $conn->close();
?>


</div>
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <h2>Upload Content for <?php echo $className; ?></h2>
  <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="class_name" value="<?php echo $className; ?>">
      <input type="hidden" name="class_owner" value="<?php echo $classOwner; ?>">
      <label for="message">Message:</label><br>
      <textarea id="message" name="message" rows="4" cols="50"></textarea><br>
      <label for="image">Choose Image:</label><br>
      <input type="file" id="image" name="image"><br>
      <label for="file">Choose File:</label><br>
      <input type="file" id="file" name="file"><br><br>
      <input type="submit" value="Upload">
  </form>
</div>


<script>


// Function to open the sidebar menu
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
}

// Function to close the sidebar menu
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
}
</script>

</body>
</html>
