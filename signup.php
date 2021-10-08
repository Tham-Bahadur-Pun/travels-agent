<?php

// creating a connection with the database
require ("./config.php");
$BrowTitle = "Create A New Account";
error_reporting(0);
session_start();

// if any account is already logged in then it return to the home page
if ($_SESSION['user'])
{
    header("location: ./index.php");
}

// if no user is logged in
else
{
    // if the user sumbits the detail through form
    if (isset($_POST["submit"]))
    {
        // assigning all the info gathered from the user in variables
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['repassword'];
        $state = 1;
        $date = date('Y/m/d h:i:s');
        $out = NAN;

        // if the password is same with confirm password
        if ($password == $confirm)
        {
            //query to check is the email already exists in the database or not
            $sql = "SELECT * FROM traveluser WHERE UserName = '$email'";

            $checkdb = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($checkdb, MYSQLI_ASSOC);
            $check = mysqli_num_rows($checkdb);

            // if the email already exists then it throws an error
            if ($check == 1)
            {
                $out = "MainError";
            }

            // if the email in fresh then
            else
            {
                // sql query to insert all the user information in the database
                $sql = "INSERT INTO `traveluser`(`UserName`,`Pass`,`State`,`DateJoined`,`DateLastModified`) VALUES ('$email', '$password', '$state','$date','$date')";

                // if the information are all inserted into the database then it shows it was a success
                if (mysqli_query($conn, $sql))
                {
                    $out = "Success";
                }

                // if the information is not stored in the database then it throws an error
                else
                {
                    $out = "UnknownError";
                }
            }
        }

        // if the password does not matches the confirm password
        else
        {
            $out = "Error";
        }

    }

}

// including the header of the page
include_once ("./header.php");

// if the all the information are stored in the database then it shows your account has been created
if ($out == "Success")
{
    $errorMessage = "<div class='alert alert-success d-flex align-items-center' role='alert'>
  <div>
    Account has been created. <a href='./login.php'> Login Here </a>
  </div>
</div>";
}
// if any information fails to be recorded in the datbase then it throws error
if ($out == "UnknownError")
{
    $errorMessage = "<div class='alert alert-info d-flex align-items-center' role='alert'>
  <div>
    Opps! Something went wrong.
  </div>
</div>";
}
// throwing error if the email already exists
if ($out == "MainError")
{
    $errorMessage = "<div class='alert alert-info d-flex align-items-center' role='alert'>
  <div>
    You already have account:<a href='./login.php'> Login Here</a>
  </div>
</div>";
}

// throwing error if the password does not match the confirm password
if ($out == "Error")
{
    $errorMessage = "<div class='alert alert-danger d-flex align-items-center' role='alert'>
  <div>
    Please enter same password.
  </div>
</div>";
}

?>
<!-- main body of the siqnup page -->

<div class="login-page">
	<div class="container">
		<div class="row">
			<div class="col-md-8 m-auto col-sm-8 col-12">
				<div class="log-box">
					<div class="row">
						<div class="col-md-5 col-sm-5 col-12 pad-right-0">
							<div class="logo-back">
							</div>
						</div>
						<div class="col-md-7 col-sm-7 col-12 pad-left-0">
							<div class="log-content">
								<h1>SIGNUP </h1>
								<div class="log-body">
								<div class="form-group myr-top">
                <?php echo $errorMessage; ?>
                 <form method="post">
								<label>Email</label>
									<input type="email" name="email" id="form3Example3" required class="form-control custom" placeholder="Email Address" style="font-size:18px;">
								</div>
								<div class="form-group myr-top">
								<label>Password</label>
									<input type="password" required id="form3Example4" name="password"  class="form-control custom" placeholder="Password" style="font-size:18px;">
								</div>
                <div class="form-group myr-top">
								<label>Re-Password</label>
									<input type="password" id="form2Example2" name="repassword" id="form3Example5" class="form-control custom" placeholder="Re-Password" style="font-size:18px;">
								</div>
								<div class="log-btn text-center">
									<button type="submit" name="submit" class="btn btn-theme1">Sign Up</button>
								</div>
                                </form>
								<div class="log-bottom-cotent">
								<p style="font-size:16px;">Already have a account? &nbsp; &nbsp; &nbsp;<a href="./login.php">Log In</a>
								
								</p>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- end -->

   

            <?php
// including the footer of the page
include_once ("./footer.php");

?>
