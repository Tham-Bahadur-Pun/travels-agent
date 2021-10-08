<?php

// connection with database
//require ("./config.php");
$BrowTitle = "Complete Your Account Details";
include_once ("./header.php");
// error_reporting 0 so that no error is shown in tha page
error_reporting(0);
//starting the session
session_start();
$email = $_SESSION["user"];
if($email){
    if($IsAdmin == 0){
        header("location:./index.php");
    }
}else {
    header("location:./login.php");
}
// query to check if the email is in the database or not
    $sqlQuery = "SELECT * FROM traveluserdetails";
    $checkdb = mysqli_query($conn, $sqlQuery);
    $check = mysqli_num_rows($checkdb);
    $GetRows = mysqli_query($conn, $sqlQuery);
    if($check > 0){
        echo"
        <div class='container-fluid p-5'>
            <div class='row'>
                <table class='table table-data table-responsive'>
                    <thead>
                        <tr>
                            <th scope='col'>UID</th>
                            <th scope='col'>Email</th>
                            <th scope='col'>First Name</th>
                            <th scope='col'>Last Name</th>
                            <th scope='col'>Address</th>
                            <th scope='col'>Country</th>
                            <th scope='col'>City</th>
                            <th scope='col'>Postal Code</th>
                            <th scope='col'>Phone</th>
                            <th scope='col'>Update</th>
                            <th scope='col'>Delete</th>
                        </tr>
                    </thead>
                    <tbody>";
                    while ($ListUserDetail = mysqli_fetch_assoc($GetRows))
                        {
                            echo"<tr>
                                    <th scope='row'>{$ListUserDetail['UID']}</th>
                                    <td>{$ListUserDetail['Email']}</td>
                                    <td>{$ListUserDetail['FirstName']}</td>
                                    <td>{$ListUserDetail['LastName']}</td>
                                    <td>{$ListUserDetail['Address']}</td>
                                    <td>{$ListUserDetail['Country']}</td>
                                    <td>{$ListUserDetail['City']}</td>
                                    <td>{$ListUserDetail['Postal']}</td>
                                    <td>{$ListUserDetail['Phone']}</td>
                                    <td><a href='./userdetail_update.php?UserDetailID=" . "{$ListUserDetail['UID']}" . "'class='btn btn-warning btn-sm'>Update</a></td>
                                    <td><a href='./userdetail_delete.php?UserDetailID=" . "{$ListUserDetail['UID']}" . "'class='btn btn-danger btn-sm'>Delete</a></td>
                                </tr>";
                        }
                    echo";
                    </tbody>
                </table>
            </div>
        </div>
        ";
    }
?>

<?php
    // including the footer of the page
    include_once ("./footer.php");
// }

// if the user has already filled up the post signup form then the user is redirected to the main page

?>
