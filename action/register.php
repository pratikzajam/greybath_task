<?php
include("../config.php");

if (isset($_POST['username']) && $_POST['username'] != ""&&
isset($_POST['email']) && $_POST['email'] != ""&&
isset($_POST['password']) && $_POST['password'] != "") {

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $query = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $data['response'] = "n";
        $data['error'] = true;
        $data['message'] = "Username already exists";
        echo json_encode($data);
        exit;
    }
    
    $query ="INSERT INTO `users`(`username`, `email`, `password`) VALUES('$username','$email','$hashedPassword')";
    $result = mysqli_query($connection, $query);

    $lastInsertedId = mysqli_insert_id($connection);

    $generate_otp=rand(1000,9999);

  $generate_otp_query="INSERT INTO `email_verify`(`user_id`,`otp`)VALUES($lastInsertedId,$generate_otp)";
  $result = mysqli_query($connection,$generate_otp_query);


include('sendmail.php');

    $data['response'] = "y";
    $data['error'] =false;
    $data['message'] = "Please verify your email in order to login";
    $data['user_id']=$lastInsertedId;
    echo json_encode($data);
    exit;


}else{
    $data['response'] = "n";
    $data['error'] = true;
    $data['message'] = "All field required";
    echo json_encode($data);
}
