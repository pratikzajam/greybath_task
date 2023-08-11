<?php 
include("../config.php");

if (isset($_POST['otp']) && $_POST['otp'] != ""&&
isset($_POST['user_id']) && $_POST['user_id'] != "") 
{


$otp=$_POST['otp'];
$user_id=$_POST['user_id'];

$verify_otp="SELECT * from email_verify where user_id='$user_id' and otp='$otp'";

$result=mysqli_query($connection,$verify_otp);

if(mysqli_num_rows($result)>0)
{
    $data['response'] = "y";
    $data['error'] = true;
    $data['message'] = "otp verified sucessfully";
    echo json_encode($data);
    exit;
}else{
    $data['response'] = "n";
    $data['error'] = true;
    $data['message'] = "otp does not match";
    echo json_encode($data);
    exit;
}
}
else{
    $data['response'] = "n";
    $data['error'] = true;
    $data['message'] = "All field required";
    echo json_encode($data);
}
