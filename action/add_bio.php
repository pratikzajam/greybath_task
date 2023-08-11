<?php
include("../config.php");


if (
    isset($_POST['user_id']) && $_POST['user_id'] != "" &&
    isset($_POST['bio']) && $_POST['bio'] != ""
) {
    $user_id = $_POST['user_id'];
    $bio = $_POST['bio'];

    $query = "UPDATE users SET bio ='$user_id', bio ='$bio' WHERE id = '$user_id'";
    $result = mysqli_query($connection, $query);

    $data['response'] = "y";
    $data['error'] = true;
    $data['message'] = "Bio sucessfully added";
    echo json_encode($data);
} else {

    $data['response'] = "n";
    $data['error'] = true;
    $data['message'] = "All fields required";
    echo json_encode($data);
}
