<?php

require 'Connection.php';

global $con;

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get the data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate and sanitize the input data
    $id = isset($data['id']) ? mysqli_real_escape_string($con, $data['id']) : '';
    $roll_no = isset($data['rollno']) ? mysqli_real_escape_string($con, $data['rollno']) : '';
    $fname = isset($data['fname']) ? mysqli_real_escape_string($con, $data['fname']) : '';
    $lname = isset($data['lname']) ? mysqli_real_escape_string($con, $data['lname']) : '';
    $age = isset($data['age']) ? mysqli_real_escape_string($con, $data['age']) : '';
    $email = isset($data['email']) ? mysqli_real_escape_string($con, $data['email']) : '';
    $gender = isset($data['gender']) ? mysqli_real_escape_string($con, $data['gender']) : '';
    $address = isset($data['address']) ? mysqli_real_escape_string($con, $data['address']) : '';
    $phone = isset($data['phone']) ? mysqli_real_escape_string($con, $data['phone']) : '';

    // Update the data in the database
    $query = "UPDATE `students` SET 
                `rollno`='$roll_no', 
                `fname`='$fname', 
                `lname`='$lname', 
                `age`='$age', 
                `email`='$email', 
                `gender`='$gender', 
                `address`='$address', 
                `phone`='$phone' 
              WHERE `id`='$id'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        // Successful update
        $response = array('status' => 'success', 'message' => 'Data updated successfully');

        http_response_code(200);
        header()
    } else {
        // Error in updating
        $response = array('status' => 'error', 'message' => 'Error updating data');
        http_response_code(500);
    }

    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    http_response_code(405);
    echo 'Invalid request method';
}
?>
