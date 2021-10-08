<?php 
// starting the sse
$BrowTitle = "Delete Image";
include('header.php');
$request_url = apache_getenv("HTTP_HOST") . apache_getenv("REQUEST_URI");
//echo $request_url;
$query = parse_url($request_url, PHP_URL_QUERY);
parse_str($query, $params);
$test = $params['IDNumber'];
// echo $test;
$sql = "DELETE FROM travelimage WHERE ImageID=$test";
$checkdb = mysqli_query($conn, $sql);
 echo" <h1 class='bg-danger text-center my-5 container py-3'  > Image Deleted</h1>";
include('footer.php');
?>

