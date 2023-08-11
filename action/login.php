<?php
session_start();
include("../config.php");


if (
    isset($_POST['username']) && $_POST['username'] != "" &&
    isset($_POST['password']) && $_POST['password'] != ""
) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginCheck = "SELECT * from users where username='$username'";
    $result = mysqli_query($connection, $loginCheck);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];
        $user_id = $row['id'];

        if (password_verify($password,$hashed_password)) {

            $_SESSION["logged_in"]=$user_id;

            $data['response'] = "y";
            $data['error'] = true;
            $data['message'] = "Logged In Sucessfully";

            echo json_encode($data);
            exit;
        } else {
            $data['response'] = "n";
            $data['error'] = true;
            $data['message'] = "Username and password does not match";
            echo json_encode($data);
            exit;
        }
    } else {
        $data['response'] = "n";
        $data['error'] = true;
        $data['message'] = "User not found";
        echo json_encode($data);
    }
} else {
    $data['response'] = "n";
    $data['error'] = true;
    $data['message'] = "All fields required";
    echo json_encode($data);
}
