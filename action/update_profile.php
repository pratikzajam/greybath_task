<?php 
include("../config.php");


if (isset($_POST['user_id']) && $_POST['user_id'] != ""&&
isset($_POST['username']) && $_POST['username'] != ""&&
isset($_POST['email']) && $_POST['email'] != ""&& 
isset($_POST['bio']) && $_POST['bio'] != "") 
{

$user_id=$_POST['user_id'];
$username=$_POST['username'];
$email=$_POST['email'];
$bio=$_POST['bio'];


$query="UPDATE users SET username='$username',email='$email',bio='$bio' WHERE id='$user_id'";
$result=mysqli_query($connection,$query);






$data['response'] = "y";
$data['error'] = true;
$data['message'] = "Profile updated sucessfully";
echo json_encode($data);
}
else{

    $data['response'] = "n";
    $data['error'] = true;
    $data['message'] = "All fields required";
    echo json_encode($data);
}






?>