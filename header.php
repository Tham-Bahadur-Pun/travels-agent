<!-- Header section of the page -->
<!DOCTYPE html>
<html lang="en">
<?php $BrowTitles = $BrowTitle; ?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?php echo $BrowTitles; ?> - My Website</title>
    <!-- MDB icon -->
    <link rel="icon" href="./img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="./css/mdb.min.css" />
    <link rel="stylesheet" href="./css/ratings.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/custom.css">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fs-3">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto p-3">
            <li class="nav-item travel-nav px-2">
                <a class="nav-link" href="./index.php">Home</a>
            </li>
            
            <li class="nav-item travel-nav px-2">
                <a class="nav-link" href="./aboutus.php">About Us</a>
            </li>

            <li class="nav-item travel-nav px-2">
                <a class="nav-link " href="./search.php">Advance Search</a>
            </li>
          
            <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle travel-nav" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Browse
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item travel-nav bg-dark text-white" href="./browsepost.php">Posts</a>
                    <a class="dropdown-item travel-nav bg-dark  text-white" href="./browseimage.php">Images</a>
                    
                    </div>
      </li>
        </ul>
    </div>


    
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="#"><img src="./travel-images/logo/logo.png" width = "100px"alt="logo"
                    loading="lazy" style="margin-top: -1px;" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>


    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">

        <ul class="navbar-nav ml-auto">

        <?php 
        require('./config.php');
        session_start();
        // echo($_SESSION['user']);
        $IsAdmin = 0;
        
        if (isset($_SESSION['user']))
        {
            
            $email = $_SESSION["user"];
            $sqlNew = "SELECT * FROM traveluserdetails WHERE Email = '$email'";
            $checkdb = mysqli_query($conn, $sqlNew);
            $GreetName = mysqli_fetch_array($checkdb, MYSQLI_ASSOC);
            $check = mysqli_num_rows($checkdb);

            $sqlUser = "SELECT * FROM traveluser WHERE UserName = '$email'";
            $checkUserdb = mysqli_query($conn, $sqlUser);
            $currentUser = mysqli_fetch_array($checkUserdb, MYSQLI_ASSOC);
            $check = mysqli_num_rows($checkUserdb);

            $IsAdmin = "$currentUser[isAdmin]";
            // echo($IsAdmin);
            
            // echo("$currentUser[isAdmin]");
            // echo("$GreetName[FirstName]");

        }
        
        if (isset($_SESSION['user'])){
            if($IsAdmin != 0){
                echo"
                    <li class='nav-item travel-nav px-2'>
                    <a class='nav-link' href='./admin.php'>
                            Admin
                        </a>
                </li>";
            }
            echo"
                
                <li class='nav-item travel-nav px-2'>
                 <a class='nav-link' href='./favourite.php'>
                         Favourites
                     </a>
             </li>

            <li class='nav-item dropdown px-2'>
                    <a class='nav-link dropdown-toggle travel-nav' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    My Account
                    </a>
                    <div class='dropdown-menu bg-dark ' aria-labelledby='navbarDropdown'>
                    <a class='dropdown-item travel-nav bg-dark text-white' href='./profile.php' style='text-transform:uppercase;'>
                        $GreetName[FirstName] $GreetName[LastName]
                    </a>
                    </div>
         </li>

    
             <li class='nav-item travel-nav px-2'>
                 <a class='nav-link' href='./logout.php'>
                         Logout
                     </a>
             </li>

             

        

        "?>
      <?php  }
        else{
            echo" <li class='nav-item travel-nav px-2'>
            <a class='nav-link ' href='./login.php'>
                    LogIn
                </a>
        </li>
        <li class='nav-item travel-nav px-2'>
            <a class='nav-link ' href='./signup.php'>
                    SignUp
                </a>
        </li> 

       " ?>
       <?php }?>


           
        </ul>
    </div>
</nav>





<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>