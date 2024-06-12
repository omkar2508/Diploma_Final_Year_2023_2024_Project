<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Classroom</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-uTY+iN1L/da4lKZPk1JJQFay4IJ1TXOcX4zhoA/ZxJQAdEcj2mH4mksFo7rG82yv5DCDcoXhoivWFyKkEzwV4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
   body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }
  
  header {
    display: flex;
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
  
  .header-right .create-class-btn {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-decoration: none;
    margin-right: 10px;
  }
  
  .header-right .create-class-btn:hover {
    background-color: #0056b3;
  }
  
  .header-right .profile-icon {
    font-size: 24px;
    color: #333;
    margin-right: 20px;
  }
  
  .container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
  }
  
  .card {
    width: calc(33.33% - 20px);
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }
  
  .card img {
    width: 100%;
    height: 200px; /* Adjusted height */
    object-fit: cover;
  }
  
  .card-content {
    padding: 20px;
  }
  
  .card-title {
    font-size: 18px;
    margin-bottom: 10px;
    color: #333;
  }
  
  .enroll-btn,
  .join-btn {
    display: inline-block;
    padding: 8px 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-right: 10px;
  }
  
  .enroll-btn:hover,
  .join-btn:hover {
    background-color: #45a049;
  }
  
  /* Modal Styles */
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.8);
  }
  
  .modal-content {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    text-align: center;
  }
  
  .modal img {
    width: 200px;
    margin-top: 50px;
  }
  
  #message {
    color: green;
    font-size: 24px;
    margin-top: 20px;
    font-weight: bold;
  }

  /* Sidebar menu styles */
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
  .no-upload-container {
    text-align: center; /* Center align the contents horizontally */
    position: absolute; /* Position the container relative to its nearest positioned ancestor */
    top: 50%; /* Position the container 50% from the top of its containing element */
    left: 50%; /* Position the container 50% from the left of its containing element */
    transform: translate(-50%, -50%); /* Center the container both horizontally and vertically */
}

.no-upload-container img {
    width: 200px; /* Adjust the width of the image */
    height: auto; /* Maintain aspect ratio */
    margin-bottom: 20px; /* Add space below the image */
}

.no-upload-container p {
    font-size: 18px; /* Adjust font size */
    color: #333; /* Text color */
    margin-bottom: 20px; /* Add space below the paragraph */
}

.create-class-btn {
    background-color: #007bff; /* Button background color */
    color: #fff; /* Button text color */
    padding: 10px 20px; /* Button padding */
    border-radius: 5px; /* Button border radius */
    text-decoration: none; /* Remove underline */
    transition: background-color 0.3s; /* Smooth transition for background color */
}

.create-class-btn:hover {
    background-color: #0056b3; /* Change background color on hover */
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
    <i class="fas fa-user-circle profile-icon"></i>
    <!-- Menu icon -->
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">☰</span>
  </div>
</header>

<!-- Sidebar menu -->
<div id="mySidebar" class="sidebar">
  <ul>
    <li><a href="joined_classes2.php">Joined Classes</a></li>
    <li><a href="classroom2.php">All Classes</a></li>
  </ul>
  <a href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</a>
</div>

<div class="container">
  <!-- PHP loop to generate class cards -->
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

    // Fetch data from class table excluding classes joined by the user
    $sql = "SELECT c.name, c.owner, c.image FROM classroom.class AS c WHERE c.name NOT IN (SELECT jc.class FROM cwc.join_class AS jc JOIN cwc.login AS l ON jc.user = l.username);";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<img src="' . $row["image"] . '" alt="Class Image">';
            echo '<div class="card-content">';
            echo '<h3 class="card-title">' . $row["name"] . '</h3>';
            echo '<p>Owner: ' . $row["owner"] . '</p>';
            echo '<form action="fetch_data2.php" method="post">';
            echo '<input type="hidden" name="class_name" value="' . $row["name"] . '">';
            echo '<button class="enroll-btn" type="submit"><i class="fas fa-user-plus"></i> View</button>';
            echo '<button class="join-btn" type="button" onclick="joinClass( \'' . $row["name"] . '\' , this)"><i class="fas fa-sign-in-alt"></i> Join</button>';
            echo '</form>';
            echo '</div></div>';
        }
    }else {
      // Class name not provided, display appropriate message
      echo '<div class="no-upload-container">';
      echo '<img src="uploads/no result.gif" alt="No Uploads Image">';
      echo '<p>No class is created</p>';
      echo '</div>';
  }
    $conn->close();
  ?>
</div>

<!-- Modal container -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <img src="success.gif" alt="Joined" />
    <p id="message">Yes!! You are part of Our Class Now...</p>
  </div>
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

function joinClass(className, button) {
    // Disable the button and change its style
    button.disabled = true;
    button.style.backgroundColor = '#ccc'; // Gray color

    // Make an AJAX request to join.php
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "join.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from join.php
            console.log(xhr.responseText);
            // Display modal
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            // Hide modal after 2 seconds
            setTimeout(function() {
                modal.style.display = "none";
            }, 3000);
        }
    };
    xhr.send("className=" + className);
}

</script>

</body>
</html>
