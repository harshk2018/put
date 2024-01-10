<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Update Student Details</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 80%;
            padding: 34px;
            margin: auto;
        }

        input, textarea {
            border: 2px solid black;
            border-radius: 6px;
            outline: none;
            font-size: 16px;
            width: 80%;
            margin: 11px 0px;
            padding: 7px;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .btn {
            color: white;
            background: purple;
            padding: 8px 12px;
            font-size: 20px;
            border: 2px solid white;
            border-radius: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    require 'Connection.php';
    global $con;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM `students` where `id` = '$id'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $row = mysqli_fetch_assoc($query_run);
        }
    }
    ?>

    <form id="updateForm">
        <h3>Update Details</h3>
        <input type="number" name="rollno" id="rollno" value="<?php echo $row['rollno'] ?>">
        <input type="text" name="fname" value="<?php echo $row['fname'] ?> " id="fname">
        <input type="text" name="lname" value="<?php echo $row['lname'] ?> " id="lname">
        <input type="text" name="age" value="<?php echo $row['age'] ?> " id="age">
        <input type="email" name="email" value="<?php echo $row['email'] ?> " id="email">
        <input type="text" name="gender" value="<?php echo $row['gender'] ?> " id="gender">
        <textarea name="address" id="address" cols="30" rows="10"><?php echo $row['address'] ?></textarea>
        <input type="phone" name="phone" value="<?php echo $row['phone'] ?> " id="phone">
        <button class="btn" type="button" onclick="updateData()">Update</button>
    </form>
</div>

<script>
    function updateData() {
        const updateForm = document.getElementById('updateForm');
        const formData = new FormData(updateForm);
        const id = <?php echo $row['id']; ?>;

        // Convert form data to JSON
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });

        // Add the id to the JSON data
        jsonData.id = id;

        // Make a PUT request using fetch API
        fetch('update.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(jsonData),
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Redirect to the page where you list all students
                window.location.href = 'list_students.php';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

</body>
</html>
