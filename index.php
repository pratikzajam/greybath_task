<!doctype html>
<html lang="en">

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
                <strong class="me-auto">Notifications</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">

            </div>
        </div>
    </div>

    <section class="d-flex align-items-center">
        <div class="container my-6">
            <div class="row d-flex justify-content-center ">
                <div class="col-lg-6"> <!-- Add col-lg-6 class here -->
                    <div class="text-center">
                        <h1>Register User</h1>
                    </div>
                    <form class="border border-md bg-light rounded border-black p-4" id="register">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label "><b>Username</b></label>
                            <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
                            <div class="text-danger" id="username-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><b>Email address</b></label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div class="text-danger" id="email-error"></div> <!-- Error message container -->
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"><b>Password</b></label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                            <div class="text-danger" id="password-error"></div> <!-- Error message container -->
                        </div>

                        <!-- link for login page -->
                        <div class="text-start mb-2">
                            <a href="login.php" class="text-decoration-none text-black">Already have an account?</a>
                            </div>



                        <button type="submit" class="btn bg-black text-white">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
<!-- Include jQuery library -->


<!-- Ajax script -->
<script>
    $(document).ready(function() {
        // Listen for form submission
        $("#register").submit(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Send the Ajax request
            $.ajax({
                type: "POST",
                url: "action/register.php", // Replace with the URL of your server-side script to handle form submission
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

                        console.log("Redirecting...");
                        setTimeout(function() {
                            window.location.href = "verify_otp.php?user_id=" + user_id
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