<?php
include ('./config.php');

session_start();
$BrowTitle = "Advance Search";
include_once ('./header.php');


     if (isset($_GET['search']))
    {
        $search_query = $_GET['search'];
        $tableFilter = $_GET['FilterTable'];
       
        if ($tableFilter == 'travelimage')
        {

            echo "<div class='col-md-4 mx-auto' style='margin-top: 20px;'>
    <div class='row'>
      <!-- Gallery item -->";
            $imageSQL = "SELECT * FROM travelimagedetails WHERE `Title` LIKE '%$search_query%' OR `Description` LIKE '%$search_query%'";
            $checkdbs = mysqli_query($conn, $imageSQL);
            $check = mysqli_num_rows($checkdbs);
            if ($check == 0)
            {
                echo ("<h1 class='bg-danger p-3' style='text-align:center; color:white;'>No Result Found.</h1>.");
            }

            else
            {
                echo ("<h2 class='bg-success p-3' style='color:white; border-radius:5px; text-align:center'>  $check  Result Found With The Search $search_query </h2>");
                echo ("<br />");

                while ($ImageDetails = mysqli_fetch_assoc($checkdbs))
                {
                    $ImageIDS = $ImageDetails['ImageID'];
                    $Queryes = "SELECT * FROM travelimage WHERE ImageID = '$ImageIDS'";
                    $checkalldb = mysqli_query($conn, $Queryes);
                    $CheckNum = mysqli_num_rows($checkalldb);

                    while ($ListALL = mysqli_fetch_assoc($checkalldb))
                    {

                        echo "
        <div class='bg-white rounded shadow-sm'><img src='./travel-images/large/" . $ListALL['Path'] . "' alt='' class='img-fluid card-img-top'>
          <div class='p-4'>
            <h5> <a href='#'' class='text-dark' style='font-size:3em;'>" . $ImageDetails['Title'] . "</a></h5>
            <p class='small text-muted mb-0' style='margin-bottom: 20px !important; font-size:14px;'>" . $ImageDetails['Description'] . "</p>
            <a href='./imagesingle.php?imageid=" . $ImageIDS . "'class='btn btn-primary' style='font-size:1.5em;'>View</a>
          </div>
      </div>

    ";
                    }
                }
            };
            echo "
  </div></div>
</div>";
        }
    }

   
?>
<?php
    include_once ('./footer.php');
// }
// else
// {
//   header('Location: ./login.php');
// }
?>
