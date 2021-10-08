<?php
// include ('./config.php');

// session_start();
$BrowTitle = "Advance Search";
include_once ('./header.php');

if (isset($_SESSION['user']))
{
    echo "<div class='container-fluid py-3 bg-info' style='padding: 50px; margin-bottom: 20px;'>
        <form method='GET' class='row row-cols-lg-auto g-3 align-items-center' action=''>
          <div class='col-12'>
        <select class='form-select' name='FilterTable' style='font-size:2em;'>
            <option value='travelpost' name='FilterTable' >Post</option>
            <option value='travelimage' name='FilterTable'>Images</option>
            <option value='geocountries' name='FilterTable'>Country</option>
        </select>
        </div>
        <div class='col-12' >
        <input class='form-control' type='search' name='searchValue' style='font-size:2em;'></div>
        <div class='col-12'>
        <input class='btn btn-primary' type='submit' name='search' value='Search' style='font-size:2em;' required> </div>
    </form></div>";

    if (isset($_GET['search']))
    {
        $search_query = $_GET['searchValue'];
        $tableFilter = $_GET['FilterTable'];
        if ($tableFilter == 'geocountries')
        {
            $sqlQuery = "SELECT * FROM `geocountries` WHERE `CountryName` LIKE '%$search_query%'";
            $checkingdb = mysqli_query($conn, $sqlQuery);
            $check = mysqli_num_rows($checkingdb);
            $rowCountry = mysqli_fetch_assoc($checkingdb);

            if ($check == 0)
            {
                // echo ("No Result Found.");
                echo ("<h1 class='bg-danger p-3' style='text-align:center; color:white;'>No Result Found.</h1>.");
            }

            else
            {
                // echo ($check . " Result Found With The Search " . $search_query);
                echo ("<h2 class='bg-success p-3' style='color:white; border-radius:5px; text-align:center'> Result Found With The Search $search_query </h2>");
                echo ("<br />");
                include("./horizontal_ad.php");
                echo "<div class='container py-5'>
                  <div class='row'>
                    <div class='col'>
                      <table class='table table-hover'>
                  <thead>
                    <tr>
                      <th scope='col'>Title</th>
                      <th scope='col'>Information</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope='row'>Country: </th>
                      <td>" . $rowCountry['CountryName'] . "</td>
                    </tr>
                     <tr>
                      <th scope='row'>Capital City: </th>
                      <td>" . $rowCountry['Capital'] . "</td>
                    </tr>
                    <tr>
                      <th scope='row'>Population: </th>
                      <td>" . $rowCountry['Population'] . "</td>
                    </tr>
                    <tr>
                      <th scope='row'>Currency: </th>
                      <td>" . $rowCountry['CurrencyCode'] . "</td>
                    </tr>
                  </tbody>
                </table>
                    </div>
                    <div class='col'>
                    <h5>Country Flag</h5>
                      <img src='https://flagcdn.com/w2560/" . strtolower($rowCountry['ISO']) . ".png' class='img-fluid' width='300' />
                    </div>
                  </div>
                  </div>
                </div>
                </div>";
            }
        }

        else if ($tableFilter == 'travelpost')
        {
            $sqlQuery = "SELECT * FROM `travelpost` WHERE `Title` LIKE '%$search_query%' OR `Message` LIKE '%$search_query%'";
            $checkingdb = mysqli_query($conn, $sqlQuery);
            $debug = mysqli_fetch_array($checkingdb, MYSQLI_ASSOC);
            $check = mysqli_num_rows($checkingdb);

            if ($check == 0)
            {
                // echo ("No Result Found.");
                echo ("<h1 class='bg-danger p-3' style='text-align:center; color:white;'>No Result Found.</h1>.");
            }

            else
            {
                // echo ($check . "Result Found With The Search " . $search_query);
                echo ("<h2 class='container bg-success p-3' style='color:white; border-radius:5px; text-align:center'> Result Found With The Search $search_query </h2>");
                echo ("<br />");
                include("./horizontal_ad.php");
                echo ("<div class='container-fluid'><div class='row'><div class='col-md-9'><div class='row'>");
                while ($row = mysqli_fetch_assoc($checkingdb))
                {
                    $PID = $row['PostID'];
                    $FevQuery = "SELECT * FROM travelpost WHERE PostID = '$PID' LIMIT $check";
                    $checkdab = mysqli_query($conn, $FevQuery);
                    $checkPosts = mysqli_num_rows($checkdab);
                    while ($rowsFev = mysqli_fetch_assoc($checkdab))
                    {
                        $PostsIDS = $rowsFev['PostID'];
                        $TravelPostImages = "SELECT * FROM travelpostimages WHERE PostID = '$PostsIDS' LIMIT $check";
                        $checkdbb = mysqli_query($conn, $TravelPostImages);
                        $checkingPosts = mysqli_num_rows($checkdbb);
                        while ($rowsFevs = mysqli_fetch_assoc($checkdbb))
                        {
                            $ImageFevID = $rowsFevs['ImageID'];
                            $ImageQuery = "SELECT * FROM travelimage WHERE ImageID = '$ImageFevID' LIMIT $check";
                            $checkdcb = mysqli_query($conn, $ImageQuery);
                            $checkImagesPosts = mysqli_num_rows($checkdcb);
                            while ($finalfev = mysqli_fetch_assoc($checkdcb))
                            {
                                echo "<div class='col-md-4'>
                                          <div class='card m-4'>
                                              <div class='bg-image hover-overlay ripple' data-mdb-ripple-color='light'>
                                                <img
                                                  src='./travel-images/large/" . $finalfev['Path'] . "' 
                                                  class='img-fluid p-2'
                                                />
                                                <a href='#!'>
                                                  <div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
                                                </a>
                                              </div>
                                              <div class='card-body'>
                                                <h5 class='card-title'>" . $rowsFev["Title"] . "</h5>
                                                <p class='card-text'>
                                                  " . substr($rowsFev["Message"], 0, 100) . "
                                                </p>
                                                <a href='./single.php?IDNumber=" . $PID . "'class='btn btn-primary' style='font-size:1.3em;'>Read More</a>
                                              </div>
                                         </div>
                                      </div> ";
                            }
                        }
                    }

                }
                echo("</div></div>
                <div class='col-md-3'>");include('vertical_ad.php');echo("</div>
                </div></div>");
            }
        }

        else if ($tableFilter == 'travelimage')
        {

            echo "
            
            <div class='container-fluid'><div class='row'><div class='col-md-9'><div class='row'>
      <!-- Gallery item -->";
            $imageSQL = "SELECT * FROM travelimagedetails WHERE `Title` LIKE '%$search_query%' OR `Description` LIKE '%$search_query%'";
            $checkdbs = mysqli_query($conn, $imageSQL);
            $check = mysqli_num_rows($checkdbs);
            if ($check == 0)
            {
                // echo ("No Result Found.");
                echo ("<h1 class='bg-danger p-3' style='text-align:center; color:white;'>No Result Found.</h1>.");
            }

            else
            {
              echo ("<h2 class='container bg-success p-3' style='color:white; border-radius:5px; text-align:center'> Result Found With The Search $search_query </h2>");  
              // echo ($check . " Result Found With The Search " . $search_query);
                echo ("<br />");
                include("./horizontal_ad.php");

                while ($ImageDetails = mysqli_fetch_assoc($checkdbs))
                {
                    $ImageIDS = $ImageDetails['ImageID'];
                    $Queryes = "SELECT * FROM travelimage WHERE ImageID = '$ImageIDS'";
                    $checkalldb = mysqli_query($conn, $Queryes);
                    $CheckNum = mysqli_num_rows($checkalldb);

                    while ($ListALL = mysqli_fetch_assoc($checkalldb))
                    {

                        echo "
                            <div class='bg-white col-md-4 rounded shadow-sm'><img src='./travel-images/large/" . $ListALL['Path'] . "' alt='' class='img-fluid card-img-top'>
                              <div class='p-4'>
                                  <h5> <a href='#'' class='text-dark' style='font-size:2em'>" . $ImageDetails['Title'] . "</a></h5>
                                  <p class='small text-muted mb-0' style='margin-bottom: 20px !important; font-size:14px;'>" . $ImageDetails['Description'] . "</p>
                                  <a href='./imagesingle.php?imageid=" . $ImageIDS . "'class='btn btn-primary' style='font-size:1.3em'>View</a>
                              </div>
                            </div>";
                    }
                }
            };
            echo("</div></div>
                <div class='col-md-3'>");include('vertical_ad.php');echo("</div>
                </div></div>");
        }
    }

   
?>
<?php
}
else
{
  header('Location:./login.php');
}
?>
<?php
    include_once ('./footer.php');
?>