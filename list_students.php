l<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Student List</title>
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
    <h2>Student List</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Roll No.</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Age</th>
            <th scope="col">Email</th>
            <th scope="col">Gender</th>
            <th scope="col">Address</th>
            <th scope="col">Phone No.</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require 'Connection.php';
        global $con;

        $query = "SELECT * FROM students";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <tr>
                    <td><?php echo $row['rollno'] ?></td>
                    <td><?php echo $row['fname'] ?></td>
                    <td><?php echo $row['lname'] ?></td>
                    <td><?php echo $row['age'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['gender'] ?></td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><a href="add.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Delete</a></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="10">No Data Found</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
