<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher or Student</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }

  .container {
    text-align: center;
    margin-top: 50px;
  }

  .teacher-img {
    width: 500px;
    height: auto;
    margin-bottom: 30px;
  }

  .button-container {
    display: flex;
    justify-content: center;
  }

  .button {
    display: inline-block;
    padding: 15px 30px;
    font-size: 18px;
    text-decoration: none;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .teacher-btn {
    background-color: #007bff;
    margin-right: 20px;
  }

  .student-btn {
    background-color: #28a745;
  }

  .button:hover {
    opacity: 0.8;
  }
</style>
</head>
<body>

<div class="container">
  <img src="techer2.gif" alt="Teacher" class="teacher-img">
  <div class="button-container">
    <form method="post">
      <input type="submit" name="teacher" class="button teacher-btn" value="I'm a Teacher">
      <input type="submit" name="student" class="button student-btn" value="I'm a Student">
    </form>
  </div>
</div>

<?php
if(isset($_POST['teacher'])) {
    header("Location: admin.html");
    exit();
} elseif(isset($_POST['student'])) {
    header("Location: classroom2.php");
    exit();
}
?>

</body>
</html>
