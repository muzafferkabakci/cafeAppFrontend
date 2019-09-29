<?php
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Credentials: true");
  header('Access-Control-Allow-Headers: X-Requested-With');
  header('Access-Control-Allow-Headers: Content-Type');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT'); // http://stackoverflow.com/a/7605119/578667
// header('Access-Control-Max-Age: 86400');
 include("databaseCon.php");
 include("class.phpmailer.php");
 include("class.smtp.php");

//   $jsonDeneme ->username ="gkand";
//   $jsonDeneme ->password_user ="123";
//  $jsonDeneme ->service_type ="login_user";
//$gelen_json = json_encode($jsonDeneme);

$gelen_json = file_get_contents("php://input");
$gelen_data = json_decode($gelen_json);
$service_type = $gelen_data->service_type;


?>
