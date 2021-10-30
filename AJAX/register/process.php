<?php

$errors = [];
$data = [];

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Empty Validations
if (empty($name) or empty($email) or empty($password)) {
    $data['success'] = false;
    echo json_encode($data);
    return;
}

$connection = mysqli_connect('localhost','root','','registration');
if (!$connection){ return; }

// Duplicate check
$query = mysqli_query($connection,"SELECT * FROM user WHERE email='".$email."'");
$num_rows = mysqli_num_rows($query);
$data['success'] = $num_rows == 0;

if (!$data['success']) {
    $errors['email'] = "Email already exists";
    $data['errors'] = $errors;
} else {
    $sql = "INSERT INTO user(name, email, password) VALUES('".$name."','" . $email . "','" . md5($password) . "')";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        session_start();
        $_SESSION['sess_user'] = $name;
        $data['success'] = true;
        $data['message'] = 'Account Successfully Created !';
    } else {
        $data['success'] = false;
        $data['message'] = 'ERROR Inserting to table !';
    }
}
mysqli_close($connection);
echo json_encode($data);
