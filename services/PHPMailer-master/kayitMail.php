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



  $email_address = $_GET['mail'];
  echo $email_address;


  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = 'smtp.gmail.com';
  $site = "http://projeapp.site/cafe/onayMail.php?mail=".$email_address;
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';

  $mail->Username = 'cafeapp34@gmail.com';
  $mail->Password = 'Gokhan12356.';
  $mail->SetFrom('cafeapp34@gmail.com', 'Cafe App');
  $mail->AddAddress($email_address );
  $mail->CharSet = 'UTF-8';
  $mail->Subject = 'E-POSTA KONUSU';
  /**Değiştirilmesi GEREKEN YER BURASI */
  $content = '<div style="background: #f1445f; padding: 10px; font-size: 20px">
  Kullanıcı Adınız : Ne ki ?<br/>
  Şifreniz :
    <a href="'.$site.'">Hesabınızı onaylamak için tıklayınız.</a>
  </div>';
  $mail->MsgHTML($content);

  //echo $gelen_data->phone_number;
  if($mail->Send()) {
     echo "Mail gönderildi";
  } else {
    echo "GÖNDERİLEMEDİ!!!!!!!!";
  }


?>
<div style="background: #f1445f; padding: 10px; font-size: 20px">
  Kullanıcı Adınız : Ne ki ?<br/>
  Şifreniz :
    <a href="'.$site.'">Hesabınızı onaylamak için tıklayınız.</a>
  </div>
