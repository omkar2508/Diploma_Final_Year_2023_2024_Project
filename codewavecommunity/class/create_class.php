<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Class</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-uTY+iN1L/da4lKZPk1JJQFay4IJ1TXOcX4zhoA/ZxJQAdEcj2mH4mksFo7rG82yv5DCDcoXhoivWFyKkEzwV4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }

        .input-container i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #888;
        }

        .input-container input[type="text"],
        .input-container input[type="file"] {
            width: calc(100% - 30px);
            padding: 10px;
            padding-left: 30px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        .input-container input[type="text"]:focus,
        .input-container input[type="file"]:focus {
            outline: none;
            border-color: #007bff;
        }

        .btn-create-class {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            font-size: 17px;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-create-class:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <img src="class.gif" alt="Class Image" width="350">
    <h2>Create Class</h2>
    <form id="createClassForm" action="insert_class.php" method="post" enctype="multipart/form-data">
        <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" name="class_name" placeholder="Name of Class" required>
        </div>
        <div class="input-container">
            <i class="fas fa-user"></i>
            <input type="text" name="owner" placeholder="Owner" required>
        </div>
        <div class="input-container">
            <i class="fas fa-image"></i>
            <input type="file" name="class_image" accept="image/*" required>
        </div>
        <button type="submit" class="btn-create-class">Create Class</button>
    </form>
</div>

<script>
    document.getElementById('createClassForm').addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();
        
        // Submit the form via JavaScript
        var form = event.target;
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Redirect to classroom.php after successful submission
                window.location.href = 'classroom.php';
            } else {
                // Handle errors if any
                console.error(xhr.responseText);
            }
        };
        xhr.onerror = function () {
            // Handle errors if any
            console.error('Error submitting the form.');
        };
        xhr.send(formData);
    });
</script>

</body>
</html>
