<?php
  // DB bağlantısı PHP ile kurulacak
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Credentials: true");
  header('Access-Control-Allow-Headers: X-Requested-With');
  header('Access-Control-Allow-Headers: Content-Type');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT'); // http://stackoverflow.com/a/7605119/578667
// header('Access-Control-Max-Age: 86400');

  $host = 'mysql11.turhost.com';
  $user = 'cafeApp';
  $pass = 'Gokhan12356.';
  $data = 'app_db';
  $service_type = $_GET['service_type'];
  //echo $service_type;

  try {
      $pdo = new PDO('mysql:host='.$host.';dbname='.$data.';charset=utf8', $user, $pass);
     // print '</br> --- </br>'."Sunucuya bağlanıldı..".'</br> --- </br>';
     print "Bağlandı ".'</br>';
  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
  }


?>
