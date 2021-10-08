<?php
$BrowTitle = "Update User Details";
include_once ("./header.php");
// error_reporting 0 so that no error is shown in tha page
error_reporting(0);
//starting the session
session_start();
$email = $_SESSION["user"];

$request_url = apache_getenv("HTTP_HOST") . apache_getenv("REQUEST_URI");
//echo $request_url;
$query = parse_url($request_url, PHP_URL_QUERY);
parse_str($query, $params);
$test = $params['UserDetailID'];

$sqlUser = "SELECT * FROM traveluserdetails WHERE UID = '$test'";
$checkUserdb = mysqli_query($conn, $sqlUser);
$currentUser = mysqli_fetch_array($checkUserdb, MYSQLI_ASSOC);
// query to check if the email is in the database or not
// $sqlNew = "SELECT * FROM traveluserdetails WHERE Email = '$email'";
// $checkdb = mysqli_query($conn, $sqlNew);
// $check = mysqli_num_rows($checkdb);

    // if the user submits the information in the form
    if (isset($_POST["submit"]))
    {
        // assigning all the values in variables so that it can be stored in the database
        $sql = "SELECT * FROM traveluser WHERE UID = '$test'";
        $checkdb = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($checkdb, MYSQLI_ASSOC);
        $first = $_POST["fname"];
        $last = $_POST["lname"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $region = $_POST["region"];
        $country = $_POST["country"];
        $postal = $_POST["postal"];
        $phone = $_POST["phone"];
        $privacy = 1;
        $ID = $row['UID'];
		
		$sql = "UPDATE traveluserdetails SET FirstName='$first',LastName='$last',Address='$address',City='$city',Region='$region',Country='$country',Postal='$postal',Phone='$phone',Privacy='$privacy' WHERE UID='$test'";
        $checkdb = mysqli_query($conn, $sql);
        // if(mysqli_query($conn, $sql)){
		// 	echo "Records were updated successfully.";
		// } else {
		// 	echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		// }
    }
?>
<!--  main post_signup body of the page -->
<div class="container-fluid bg-primary" style="padding: 50px; margin-bottom: 20px;">
        <h1 style="color: #fff !important; text-align: center !important;">Update Profile by Admin</h1>
    </div>

    <!-- <div class="container-fluid"> -->
        <!-- <div class="row"> -->
    <!-- <div class="col-md-4"> -->

    <!-- </div> -->
    <!-- <div class="col-md-8"> -->
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
								<h1 class='text-center'>Update Details.</h1>
								<div class="log-body">
								<div class="form-group myr-top">
                <?php echo $errorMessage; ?>
                 <form method="post">
								<label>First Name</label>
									<input value=<?php echo"$currentUser[FirstName]" ?> type="text" name="fname" id="form6Example1" required class="form-control custom" placeholder="First Name" style="font-size:18px;">
								</div>
								<div class="form-group myr-top">
								<label>Last Name</label>
                
									<input value=<?php echo"$currentUser[LastName]" ?> type="text" required id="form6Example2" name="lname"  class="form-control custom" placeholder="Last Name" style="font-size:18px;">
								</div>

                <div class="form-group myr-top">
								<label>Address</label>
              
									<input value=<?php echo"$currentUser[Address]" ?> type="text" id="form2Example2" id="form6Example3" name="address" class="form-control custom" placeholder="Address" style="font-size:18px;">
								</div>

                <div class="form-group myr-top">
								<label>City</label>
               
									<input value=<?php echo"$currentUser[City]" ?> type="text" id="form6Example4"  id="form6Example3" name="city" class="form-control custom" placeholder="City" style="font-size:18px;">
								</div>

                <div class="form-group myr-top">
								<label>Region</label>
                
									<input value=<?php echo"$currentUser[Region]" ?>  id="form6Example5" type="text" name="region" class="form-control custom" placeholder="Region" style="font-size:18px;">
								</div>

                <div class="form-group myr-top">
								<label>Country</label>

									<input value=<?php echo"$currentUser[Country]" ?> id="form6Example5" type="text"  name="country" class="form-control custom" placeholder="Country" style="font-size:18px;">
								</div>


                <div class="form-group myr-top">
								<label>Post Code</label>
               
									<input value=<?php echo"$currentUser[Postal]" ?> id="form6Example5" type="number" id="form6Example3" name="postal" class="form-control custom" placeholder="Postal Code" style="font-size:18px;">
								</div>


                <div class="form-group myr-top">
								<label>Phone</label>
                
									<input value=<?php echo"$currentUser[Phone]" ?> type="number" id="form2Example2" type="text" id="form6Example3" name="phone" class="form-control custom" placeholder="Phone" style="font-size:18px;">
								</div>

								<div class="log-btn text-center">
									<button type="submit" name="submit" class="btn btn-theme1">Update</button>
								</div>
                </form>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

    <!-- </div>
    
</div></div> -->


    <!-- end -->
<?php
    // including the footer of the page
    include_once ("./footer.php");
// }

// if the user has already filled up the post signup form then the user is redirected to the main page

?>
