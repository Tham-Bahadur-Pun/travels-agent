<?php

// checking the connection of database
require ("./config.php");
$BrowTitle = "Login To Your Account";
// error report so that it error is not shown
error_reporting(0);
//initializng the session
session_start();

// if the user has already logged in then it redirects to the main page
if ($_SESSION['user'])
{
    header("location: ./index.php");
}

else
{
    // if the user submits the login information
    if (isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM traveluser WHERE UserName = '$email' AND Pass = '$password'";
        $checkdb = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($checkdb, MYSQLI_ASSOC);
        $check = mysqli_num_rows($checkdb);

        // if the user name and password matches that of in database table
        if ($check == 1)
        {
            // making a session for the user
            $_SESSION['user'] = $row['UserName'];
            // redirecting it to post signup
            header("Location: ./post_signup.php");
        }

        else
        {
            $alert = "<div class='alert alert-danger d-flex align-items-center' role='alert'>
  <div>
    You have entered either wrong email or password
  </div>
</div>";
        }
    }

}

// for the header of the page
require ("./header.php");

?>
<!-- main login page body -->
<div class="login-page">
	<div class="container">
    <?php echo $alert; ?>
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
								<h1>LOGIN </h1>
								<div class="log-body">
								<div class="form-group myr-top">
                                <form method="post">
								<label>Email</label>
									<input type="email" name="email" id="form2Example1" class="form-control custom" placeholder="Email Address" style="font-size:18px;">
								</div>
								<div class="form-group myr-top">
								<label>Password</label>
									<input type="password" id="form2Example2" name="password"  class="form-control custom" placeholder="Password" style="font-size:18px;">
								</div>
								<div class="log-btn text-center">
									<button type="submit" name="submit" class="btn btn-theme1">Login</button>
								</div>
                                </form>
								<div class="log-bottom-cotent">
								<p style="font-size:16px;">Creat an account &nbsp; &nbsp; &nbsp;<a href="./signup.php">Sign Up</a>
								
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

<?php
// for the footer of the page
require ("./footer.php");

?>

