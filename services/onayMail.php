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

 echo "Hesabınız Onaylanmıştır";
  $email_address = $_GET['mail'];
  $stmt = $pdo->prepare("UPDATE user SET onaylanmisHesap=1 WHERE email_address=:email_address");
  $stmt->bindParam(':email_address', $email_address, PDO::PARAM_STR);
  $stmt->execute();


?>
