<?php 
include("../config.php");

if(isset($_POST['user_id']) && $_POST['user_id'] != "" &&
isset($_FILES['profile_pic']) && $_FILES['profile_pic'] != "") 
{
    //verify image and save it to uploads folder and send the path to database
    $user_id=$_POST['user_id'];
    $profile_pic=$_FILES['profile_pic'];
    $profile_pic_name=$profile_pic['name'];
    $profile_pic_tmp_name=$profile_pic['tmp_name'];
    $profile_pic_size=$profile_pic['size'];
    $profile_pic_error=$profile_pic['error'];
    $profile_pic_type=$profile_pic['type'];

    $profile_pic_ext=explode('.',$profile_pic_name);
    $profile_pic_actual_ext=strtolower(end($profile_pic_ext));

    $allowed=array('jpg','jpeg','png');

    if(in_array($profile_pic_actual_ext,$allowed))
    {
        if($profile_pic_error===0)
        {
            if($profile_pic_size<1000000)
            {
                $profile_pic_new_name=uniqid('',true).".".$profile_pic_actual_ext;
                $profile_pic_destination="../uploads/".$profile_pic_new_name;
                $profile_path="uploads/".$profile_pic_new_name;
                move_uploaded_file($profile_pic_tmp_name,$profile_pic_destination);
                $query="UPDATE users SET image_path='$profile_path' WHERE id='$user_id'";
                $result=mysqli_query($connection,$query);
                
                $data['response'] = "y";
                $data['error'] = true;
                $data['message'] = "Profile picture updated sucessfully";
                echo json_encode($data);
            }
            else
            {
                $data['response'] = "n";
                $data['error'] = true;
                $data['message'] = "File size too big";
                echo json_encode($data);
            }
        }
        else
        {
            $data['response'] = "n";
            $data['error'] = true;
            $data['message'] = "Error uploading file";
            echo json_encode($data);
        }
    }
    else
    {
        $data['response'] = "n";
        $data['error'] = true;
        $data['message'] = "File type not supported";
        echo json_encode($data);
    }
   







}



?>