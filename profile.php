<!doctype html>
<html lang="en">

<?php session_start();
include("config.php");
include("is_logged_in.php");
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>



<?php include('header.php');?>


    <div class="d-flex justify-content-end">
        <div class="toast bg-grey" role="alert" id="myToast" aria-live="assertive" aria-atomic="true">  
            <div class="toast-header">
                <strong class="me-auto">Nofifications</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">

            </div>
        </div>
    </div>

    <?php $_SESSION['logged_in'];

    $user_id = $_SESSION['logged_in'];

    $user_data = "SELECT * FROM users where id='$user_id'";

    $user_data = mysqli_query($connection, $user_data);

    $row = mysqli_fetch_assoc($user_data);




    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-itsms-center">
                        User Profile
                        <button type="button" class="btn bg-black text-white d-flex justify-content-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Edit Profile
                        </button>
                        <button type="button" class="btn bg-black text-white d-flex justify-content-end" data-bs-toggle="modal" data-bs-target="#UpdateImage">
                            Add image
                        </button>
                        <!-- <button class="btn btn-primary d-flex justify-content-end">Edit </button> -->
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                       
                        <?php if (!empty(trim($row['image_path']))){?>
                            <img src="<?=$row['image_path']?>" height="200px" class="img-fluid rounded-circle w-25 h-auto" alt="hi Avatar"> 
                        
                        <?php }else { ?>

                            <img src="https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=200&t=st=1691487656~exp=1691488256~hmac=39ab94c0d8c11f76175c1b1ee22a85c5f6159b30ab055b825a16b9847adf7675" height="200px" class="img-fluid rounded-circle" alt="User Avatar">
                          <?php } ?>
                        </div>
                        <div class="bio d-flex justify-content-center">
                            <a href="" data-bs-toggle="modal" data-bs-target="#addBio">
                                <?php if (!empty(trim($row['bio'])))  {
                                ?>
                                    <h3 class="text-black text-decoration-none"><?= $row['bio']; ?></h3>
                                <?php } else { ?>
                                    <h3>Add bio</h3>
                                <?php } ?>
                            </a>
                        </div>
                        <h5 class="card-title mt-3"><?= $row['username'] ?></h5>
                        <p class="card-text"><?= $row['email'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Profile</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="updateProfile">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label "><b>Username</b></label>
                            <input type="text" class="form-control" value="<?= $row['username'] ?>" name="username" aria-describedby="emailHelp">
                            <input type="hidden" class="form-control" name="user_id" value=<?= $user_id ?> aria-describedby="emailHelp">
                            <div class="text-danger" id="username-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Email address</b></label>
                            <input type="email" class="form-control" value="<?= $row['email'] ?>" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div class="text-danger" id="email-error"></div> <!-- Error message container -->
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Bio</b></label>
                            <input type="text" class="form-control" name="bio" id="exampleInputEmail1" value="<?= $row['bio'] ?>" aria-describedby="emailHelp">
                            <div class="text-danger" id="email-error"></div> <!-- Error message container -->
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-black text-white">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <!--Image Modal -->
    <div class="modal fade" id="UpdateImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add profile</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="image" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"><b>Update Image</b></label>
                        <input type="file" class="form-control" name="profile_pic" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <input type="hidden" class="form-control" name="user_id" value=<?= $user_id ?> aria-describedby="emailHelp">
                        <div class="text-danger" id="email-error"></div> <!-- Error message container -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-black text-white">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!--Add Bio -->
    <div class="modal fade" id="addBio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bio</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bio">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Bio</b></label>
                            <input type="text" class="form-control" name="bio" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <input type="hidden" class="form-control" name="user_id" value="<?= $user_id ?>" aria-describedby="emailHelp">
                            <div class="text-danger" id="email-error"></div> <!-- Error message container -->
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-black text-white">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
<!-- Include jQuery library -->


<!-- Ajax script -->
<script>
    $(document).ready(function() {
        // Listen for form submission
        $("#bio").submit(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Send the Ajax request
            $.ajax({
                type: "POST",
                url: "action/add_bio.php", // Replace with the URL of your server-side script to handle form submission
                data: formData,
                dataType: "json",
                success: function(response) {
                    // Handle the response from the server
                    $("#myToast .toast-body").text(response.message);

                    // Show the toast
                    $("#myToast").toast('show');

                    var user_id = response.user_id;
                    console.log(response.user_id);

                    console.log(response.response);

                    if (response.response === 'y') {


                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }



                    // You can do something with the response, like displaying a success message
                },
                error: function(error) {
                    // Handle any errors that occurred during the Ajax request
                    // console.log("Error: " + error.responseText);

                }
            });
        });
    });



    $(document).ready(function() {
        // Listen for form submission
        $("#updateProfile").submit(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Send the Ajax request
            $.ajax({
                type: "POST",
                url: "action/update_profile.php", // Replace with the URL of your server-side script to handle form submission
                data: formData,
                dataType: "json",
                success: function(response) {
                    // Handle the response from the server
                    $("#myToast .toast-body").text(response.message);

                    // Show the toast
                    $("#myToast").toast('show');

                    var user_id = response.user_id;
                    console.log(response.user_id);

                    console.log(response.response);

                    if (response.response === 'y') {


                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }



                    // You can do something with the response, like displaying a success message
                },
                error: function(error) {
                    // Handle any errors that occurred during the Ajax request
                    // console.log("Error: " + error.responseText);

                }
            });
        });
    });


    $(document).ready(function() {
    // Listen for form submission
    $("#image").submit(function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Create a FormData object
        var formData = new FormData(this);

        // Send the Ajax request
        $.ajax({
            type: "POST",
            url: "action/upload_image.php", // Replace with the URL of your server-side script to handle form submission
            data: formData,
            processData: false,  // Important: prevent jQuery from processing the data
            contentType: false,  // Important: prevent jQuery from setting contentType
            dataType: "json",
            success: function(response) {
                // Handle the response from the server
                $("#myToast .toast-body").text(response.message);

                // Show the toast
                $("#myToast").toast('show');

                var user_id = response.user_id;
                console.log(response.user_id);

                console.log(response.response);

                if (response.response === 'y') {
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                }

                // You can do something with the response, like displaying a success message
            },
            error: function(error) {
                // Handle any errors that occurred during the Ajax request
                // console.log("Error: " + error.responseText);
            }
        });
    });
});

</script>

</html>