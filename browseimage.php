<?php
// starting the session
// session_start();
$BrowTitle = "Browse Image";
// creating a connection with the database
// require ('./config.php');

// including the header file
include ('./header.php');

if (isset($_POST["AddFav"]))
{
    // all the post related data are assigned to the variable
    $favNum = $_POST["fav"];
    $postDBID = $_POST["PostID"];
    $UserDBID = $_POST["UserID"];

    //sql query to insert all the information about the favourite post in the database
    $sqlCheck = "INSERT INTO `userfav`(`UID`,`ImageID`, `isFavourite`) VALUES ('$UserDBID','$postDBID','$favNum')";

    // if the data has been successfully inserted
    if (mysqli_query($conn, $sqlCheck))
    {
        $URL = "./browsepost.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    };
}

// query for selecting all the travel images from the database
$sql = "SELECT * FROM travelimage";
$checkdb = mysqli_query($conn, $sql);
$check = mysqli_num_rows($checkdb);
include("./horizontal_ad.php");
echo "<div class='container-fluid' style='margin-top: 20px;'>
  <div class='px-lg-5'>
    <div class='row'>
      <!-- Gallery item -->";
// iterating through all the images
while ($rows = mysqli_fetch_assoc($checkdb))
{
    $CheckID = $rows['ImageID'];
    $CheckUID = $rows['UID'];
    $imageSQL = "SELECT * FROM travelimagedetails WHERE ImageID = '$CheckID' LIMIT 1";
    $checkdbs = mysqli_query($conn, $imageSQL);
    $check = mysqli_num_rows($checkdbs);
    while ($ImageDetails = mysqli_fetch_assoc($checkdbs))
    {
      $ImageIDFev = $ImageDetails['ImageID'];
        // printing the image details
        echo "
      <div class='col-xl-3 col-lg-4 col-md-6 mb-4'>
        <div class='bg-white rounded shadow-sm'><img src='./travel-images/large/" . $rows['Path'] . "' alt='' class='img-fluid card-img-top'>
          <div class='p-4'>
            <h5> <a href='#'' class='text-dark' >" . $ImageDetails['Title'] . "</a></h5>
            <p class='small text-muted mb-0' style='margin-bottom: 20px !important;'>" . $ImageDetails['Description'] . "</p>
            <a href='./imagesingle.php?imageid=" . $ImageDetails['ImageID'] . "'class='btn btn-primary'>View</a>";
            if (isset($_SESSION['user']))
            {
                
                $sqlMostQUERRY = "SELECT * FROM userfav WHERE UID = '$CheckUID' AND ImageID = '$ImageIDFev' LIMIT 1";
                $checkMostdb = mysqli_query($conn, $sqlMostQUERRY) or die(mysqli_error($conn));
                $rowMostFev = mysqli_fetch_array($checkMostdb, MYSQLI_ASSOC);
                $checkMostData = mysqli_num_rows($checkMostdb);
                if ($checkMostData >= 1)
                {
                    echo "<a class='btn btn-primary' href='./favourite.php' style='float: right !important; '>Go to favourite</a>";
                }
               
                else
                {
                    echo "
                        <form method='post' class='formfev'>
                        <input type='text' value='1' hidden name='fav'>
                        <input type='text' value='" . $ImageIDFev. "' hidden name='PostID'>
                        <input type='text' value='" . $CheckUID . "' hidden name='UserID'>
                        <button name='AddFav' class='btn btn-primary' style='float: right !important; ''>favourite</button>
                      </form>";

                }
                if($IsAdmin != 0){
                  echo "<a href='./image_delete.php?IDNumber=" . $ImageIDFev . "'class='btn btn-danger mx-2'>Delete</a>";
                }
            }
          echo "</div>
        </div>
      </div>
    ";
    }
};
echo "
  </div></div>
</div>";

// including the footer file
require ('./footer.php');
?>
