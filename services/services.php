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


// echo $myJson;
//login_user($pdo,$myJson);
//-----------------------------------------------------------------
switch($service_type){
  case register_user:
    // echo "registera girdi. DEneme".'</br> --- </br>';
    register_user($pdo, $gelen_data);
    break;
  case user_varMi:
    user_varMi($pdo,$gelen_data);
    break;
  case mail_varMi:
    mail_varMi($pdo,$gelen_data);
    break;
  case tel_varMi:
    tel_varMi($pdo,$gelen_data);
    break;
  case login_user:
    //echo "logine girdik.".'</br> --- </br>';
    login_user($pdo,$gelen_data);
    break;
  case forgot_password:
    // echo "forgot_password girdi".'</br> --- </br>';
    forgot_password($pdo,$gelen_data);
    break;
  case if_exist:
	  // echo "if_exit girdi".'</br> --- </br>';
	  if_exist($pdo,$gelen_data);
    break;
  case load_home:
    // echo "load_home girdi".'</br> --- </br>';
    load_home($pdo,$gelen_data);
    break;
  case buton_click:
    // echo "buton_click girdi".'</br> --- </br>';
    buton_click($pdo,$gelen_data);
    break;
  case get_branches:
    //echo "get_branches girdi".'</br> --- </br>';
    get_branches($pdo,$gelen_data);
    break;
  case get_products:
    //echo "get_products girdi". </br> --- </br>;
    get_products($pdo,$gelen_data);
    break;
  case contact;
    // echo "contact girdi";
    contact($pdo,$gelen_data);
    break;
  case get_productsKampanyali:
    get_productsKampanyali($pdo, $gelen_data);
    break;
  case urundenKactane:
    urundenKactane($pdo,$gelen_data);
    break;
  case kayitMail:
    kayitMail($gelen_data);
    break;

  //-----KASA İŞLEMLERİ ----//

  case update_barcode:
    // echo "update_barcode girdi".'</br> --- </br>';
    update_barcode($pdo,$gelen_data);
    break;
  case depleted_products:
    // echo "depleted_products girdi".'</br> --- </br>';
    depleted_products($pdo,$gelen_data);
    break;
  default:
    echo $service_type."Switch 0";
}


// function register_user($pdo,$gelen_data){

//   $name_user = $gelen_data->name_user;
//   $username = $gelen_data->username;
//   $password_user = $gelen_data->password_user;
//   $school= $gelen_data->school;
//   $email_address= $gelen_data->email_address;
//   $phone_number= $gelen_data->phone_number;
//   $company_id= $gelen_data->company_id;
//   //gokhanbirkin.net/services.php?service_type=register&name_user=batuhan&username=batuerdemir&password_user=1234&school=sabancı üniversitesi&email_address=batuerdemir@gmail.com&phone_number=564123651&company_id=1
//   //id+1
//   if( $pdo->exec('INSERT INTO user ( name_user, username,password_user,school,email_address,phone_number,company_id)
//   VALUES ("'.$name_user.'","'.$username.'","'.$password_user.'","'.$school.'","'.$email_address.'","'.$phone_number.'","'.$company_id.'")')){
//     echo "kayıt eklendi";
//   }
//   // if($pdo->exec('SELECT username FROM user WHERE username=:username') == null &&
//   // $pdo->exec('SELECT email_address FROM user WHERE name_user=:email_address') == null &&
//   // $pdo->exec('SELECT phone_number FROM user WHERE name_user=:phone_number') == null){
//   //   $pdo -> $pdo->exec('INSERT INTO user ( name_user, username,password_user,school,email_address,phone_number,company_id)
//   //   VALUES ("'.$name_user.'","'.$username.'","'.$password_user.'","'.$school.'","'.$email_address.'","'.$phone_number.'","'.$company_id.'")');
//   //   echo "EKLENDİ";
//   // }else{
//   //   echo "Eklenemedi";
//   // }
//   // // if( $pdo->exec('INSERT INTO user ( name_user, username,password_user,school,email_address,phone_number,company_id)
//   // // VALUES ("'.$name_user.'","'.$username.'","'.$password_user.'","'.$school.'","'.$email_address.'","'.$phone_number.'","'.$company_id.'")')){
//   // //   echo "kayıt eklendi";
//   // // }
// }

function register_user($pdo,$gelen_data){

  $name_user = $gelen_data->name_user;
  $username = $gelen_data->username;
  $password_user = $gelen_data->password_user;
  $school= $gelen_data->school;
  $email_address= $gelen_data->email_address;
  $phone_number= $gelen_data->phone_number;
  $company_id= $gelen_data->company_id;

  if( $pdo->exec('INSERT INTO user ( name_user, username,password_user,school,email_address,phone_number,company_id)
  VALUES ("'.$name_user.'","'.$username.'","'.$password_user.'","'.$school.'","'.$email_address.'","'.$phone_number.'","'.$company_id.'")')){
    echo "kayıt eklendi";
  }

}
function user_varMi($pdo,$gelen_data){
  $username =$gelen_data->username;

	$stmt = $pdo->prepare("SELECT * FROM user WHERE username=:username");
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->execute();
	echo $stmt->rowCount();
}
function mail_varMi($pdo,$gelen_data){
  $email_address =$gelen_data->email_address;

	$stmt = $pdo->prepare("SELECT * FROM user WHERE email_address=:email_address");
	$stmt->bindParam(':email_address', $email_address, PDO::PARAM_STR);
	$stmt->execute();
	echo $stmt->rowCount();
}
function tel_varMi($pdo,$gelen_data){
  $phone_number =$gelen_data->phone_number;

	$stmt = $pdo->prepare("SELECT * FROM user WHERE phone_number=:phone_number");
	$stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
	$stmt->execute();
	echo $stmt->rowCount();
}

//localStorage->
function login_user($pdo, $gelen_data){

    $username = $gelen_data->username;
    $password_user =$gelen_data->password_user;

    $stmt = $pdo->prepare("SELECT user_id,name_user, username,school,email_address,phone_number,user_id
    from user where username=:username and password_user=:password_user");
    //Localstorage -> name_user, username,school,email_address,phone_number,company_id
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password_user', $password_user, PDO::PARAM_STR);
    $stmt->execute();

 		$gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
		$json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
    if($gelenuser){
      //  $jsonArray = json_decode($json_data,true);
      //  print $jsonArray;
      print $json_data;
    }else{
      echo $gelenuser;
      return false;
    }
}

//SMS MAİL <---
function forgot_password($pdo, $gelen_data){
  //echo "Fonksiyona girdi";
  $phone_number = $gelen_data->phone_number;

  $stmt = $pdo->prepare("SELECT name_user,password_user,email_address, username FROM user WHERE phone_number=:phone_number");
  $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $pass = $row['password_user'];
  $email_address = $row['email_address'];
  $username = $row['username'];
  $name_user = $row['name_user'];


  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = 'smtp.gmail.com';

  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';

  $mail->Username = 'cafeapp34@gmail.com';
  $mail->Password = 'Gokhan12356.';
  $mail->SetFrom('asd@asd.asd', 'Cafe App');
  $mail->AddAddress($email_address, $name_user);
  $mail->CharSet = 'UTF-8';
  $mail->Subject = 'E-POSTA KONUSU';
  $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
  <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
  <meta content="width=device-width" name="viewport"/>
  <!--[if !mso]><!-->
  <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
  <!--<![endif]-->
  <title></title>
  <!--[if !mso]><!-->
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"/>
  <!--<![endif]-->
  <style type="text/css">
      body {
        margin: 0;
        padding: 0;
      }

      table,
      td,
      tr {
        vertical-align: top;
        border-collapse: collapse;
      }

      * {
        line-height: inherit;
      }

      a[x-apple-data-detectors=true] {
        color: inherit !important;
        text-decoration: none !important;
      }
    </style>
  <style id="media-query" type="text/css">
      @media (max-width: 620px) {

        .block-grid,
        .col {
          min-width: 320px !important;
          max-width: 100% !important;
          display: block !important;
        }

        .block-grid {
          width: 100% !important;
        }

        .col {
          width: 100% !important;
        }

        .col>div {
          margin: 0 auto;
        }

        img.fullwidth,
        img.fullwidthOnMobile {
          max-width: 100% !important;
        }

        .no-stack .col {
          min-width: 0 !important;
          display: table-cell !important;
        }

        .no-stack.two-up .col {
          width: 50% !important;
        }

        .no-stack .col.num4 {
          width: 33% !important;
        }

        .no-stack .col.num8 {
          width: 66% !important;
        }

        .no-stack .col.num4 {
          width: 33% !important;
        }

        .no-stack .col.num3 {
          width: 25% !important;
        }

        .no-stack .col.num6 {
          width: 50% !important;
        }

        .no-stack .col.num9 {
          width: 75% !important;
        }

        .video-block {
          max-width: none !important;
        }

        .mobile_hide {
          min-height: 0px;
          max-height: 0px;
          max-width: 0px;
          display: none;
          overflow: hidden;
          font-size: 0px;
        }

        .desktop_hide {
          display: block !important;
          max-height: none !important;
        }
      }
    </style>
  </head>
  <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #222222;">
  <!--[if IE]><div class="ie-browser"><![endif]-->
  <table bgcolor="#222222" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #222222; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top;" valign="top">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#222222"><![endif]-->
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid three-up" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="200" style="background-color:transparent;width:200px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
  <div class="col num4" style="max-width: 320px; min-width: 200px; display: table-cell; vertical-align: top; width: 200px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <div></div>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td><td align="center" width="200" style="background-color:transparent;width:200px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
  <div class="col num4" style="max-width: 320px; min-width: 200px; display: table-cell; vertical-align: top; width: 200px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center autowidth" src="images/launch-template_logo.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 149px; display: block;" title="Image" width="149"/>
  <!--[if mso]></td></tr></table><![endif]-->
  </div>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td><td align="center" width="200" style="background-color:transparent;width:200px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
  <div class="col num4" style="max-width: 320px; min-width: 200px; display: table-cell; vertical-align: top; width: 200px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <div></div>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 15px; padding-right: 0px; padding-bottom: 15px; padding-left: 0px;" valign="top">
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 5px solid #A17C44; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top:5px; padding-bottom:5px;background-color:#FFFFFF;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="background-color:#FFFFFF;width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 10px; padding-left: 10px;">
  <!--<![endif]-->
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 30px; padding-bottom: 5px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
  <div style="color:#111111;font-family:"Roboto", Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:30px;padding-right:30px;padding-bottom:5px;padding-left:30px;">
  <div style="font-size: 12px; line-height: 1.2; font-family: "Roboto", Tahoma, Verdana, Segoe, sans-serif; color: #111111; mso-line-height-alt: 14px;">
  <p style="font-size: 14px; line-height: 1.2; mso-line-height-alt: 17px; margin: 0;"><strong><span style="font-size: 26px;">CafeAPP</span></strong></p>
  </div>
  </div>
  <!--[if mso]></td></tr></table><![endif]-->
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 5px; padding-bottom: 10px; font-family: Georgia, "Times New Roman", serif"><![endif]-->
  <div style="color:#888888;font-family:Georgia, Times, "Times New Roman", serif;line-height:1.8;padding-top:5px;padding-right:30px;padding-bottom:10px;padding-left:30px;">
  <div style="line-height: 1.8; font-family: Georgia, Times, "Times New Roman", serif; font-size: 12px; color: #888888; mso-line-height-alt: 22px;">
  <p style="line-height: 1.8; font-size: 14px; mso-line-height-alt: 25px; margin: 0;"><span style="font-size: 14px;">
  Kullanıcı adınız : '.$username.'</br>
  Şifreniz : '.$pass.'</span></p>
  </div>
  </div>
  <!--[if mso]></td></tr></table><![endif]-->
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table cellpadding="0" cellspacing="0" class="social_icons" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
  <table activate="activate" align="center" alignment="alignment" cellpadding="0" cellspacing="0" class="social_table" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: undefined; mso-table-tspace: 0; mso-table-rspace: 0; mso-table-bspace: 0; mso-table-lspace: 0;" to="to" valign="top">
  <tbody>
  <tr align="center" style="vertical-align: top; display: inline-block; text-align: center;" valign="top">
  <td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 8px; padding-left: 8px;" valign="top"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="images/facebook.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Facebook" width="32"/></a></td>
  <td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 8px; padding-left: 8px;" valign="top"><a href="http://twitter.com/" target="_blank"><img alt="Twitter" height="32" src="images/twitter.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Twitter" width="32"/></a></td>
  <td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 8px; padding-left: 8px;" valign="top"><a href="http://plus.google.com/" target="_blank"><img alt="Google+" height="32" src="images/googleplus.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Google+" width="32"/></a></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
  <div style="color:#888888;font-family:"Roboto", Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
  <div style="font-size: 12px; line-height: 1.2; font-family: "Roboto", Tahoma, Verdana, Segoe, sans-serif; color: #888888; mso-line-height-alt: 14px;">
  <p style="font-size: 12px; line-height: 1.2; text-align: center; mso-line-height-alt: 14px; margin: 0;"><span style="font-size: 12px;">Copyright © 2016 YourSite, All rights reserved. </span></p>
  <p style="font-size: 12px; line-height: 1.2; text-align: center; mso-line-height-alt: 14px; margin: 0;"><span style="font-size: 12px;">You subscribed to our newsletter via our website, <span style="color: #ffffff; font-size: 12px;"><a href="example.com" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank">example.com</a></span></span></p>
  <p style="font-size: 14px; line-height: 1.2; text-align: center; mso-line-height-alt: 17px; margin: 0;"> </p>
  <p style="font-size: 12px; line-height: 1.2; text-align: center; mso-line-height-alt: 14px; margin: 0;"><span style="font-size: 12px; color: #ffffff;"><a href="example.com" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank">Unsubscribe from this list</a></span></p>
  </div>
  </div>
  <!--[if mso]></td></tr></table><![endif]-->
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (IE)]></div><![endif]-->
  </body>
  </html>';
  $mail->MsgHTML($content);
  $mail->Send();
  //echo $gelen_data->phone_number;
  if($mail->Send()) {
     return true;
  } else {
      return false;
  }

}
function urundenKactane($pdo,$gelen_data){
  $user_id = $gelen_data->user_id;

  $stmt = $pdo->prepare('SELECT consumption.product_id, consumption.count,product.name_product FROM consumption, product WHERE
  product.product_id=consumption.product_id    and consumption.user_id =:user_id');
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
  $stmt->execute();

  $gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
  $json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
  if($gelenuser){
    echo $json_data;
  }else{
    echo "0";
  }
}


//Veritabanından sorgu bekleniyor..
function load_home($pdo,$gelen_data){
  $user_id = $gelen_data->user_id;
  //$product_id = $_GET['product_id'];
  $stmt = $pdo->prepare('SELECT consumption.product_id, consumption.count FROM consumption, product WHERE
  product.product_id=consumption.product_id    and consumption.user_id =:user_id');
  //SELECT(JOIN)(Product Name,Product ID,Product Image,Campaign Code ID, (campaign)Product ID)
  //Localstorage -> name_user, school
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
  //$stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
  $stmt->execute();

  $gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
  $json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
  if($gelenuser){
    echo $json_data;
  }else{
    echo "0";
  }
}

//front-end'den buton_id gelcek
function buton_click($pdo,$gelen_data){ // gelen_data'nın içinde button diye bir değişken alıyoruz.
  $user_id = $gelen_data->user_id;
  $product_id = $gelen_data->product_id;
  $free = $gelen_data->free;

  if($free == false){ // bu değişken true geliyorsa bedava kullanım vardır. Tüketim artacak.
    //Yeni ürün tüketiminde burası çalışır.
    //Oluşturulan kodda user_id ve product_id olacak
    //Kasa bu servisi çalıştıracak.
    $product_exist = if_exist_func_two($pdo,$product_id,"product_id","consumption",$user_id,"user_id");
    if($product_exist==false){
        echo "tüketim yok";
        $stmt = $pdo->prepare('INSERT INTO consumption (user_id,product_id,count,totalCount) VALUES ('.$user_id.','.$product_id.', 1,1) ');
        $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->execute();

    }else{
        echo "tüketim var";
        $stmt = $pdo->prepare('UPDATE  consumption SET  consumption.count=consumption.count+1, consumption.totalCount = consumption.totalCount+1
        WHERE  consumption.user_id =:user_id and consumption.product_id=:product_id');
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

      }
    }
  // }
  else{ //true geliyorsa bedava için kod üreteceğiz
    $product_id = $gelen_data->product_id;
    $user_id = $gelen_data->user_id;
    //düzenlenecek (update)
    $stmt = $pdo->prepare("SELECT campaign_id,campaign_code  FROM campaign
    WHERE campaign.product_id=:product_id AND  validation !=0 LIMIT 1");
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
    $stmt->execute();

    $gelendata = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
    $json_data=json_encode($gelendata,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
    //total count ve count düzenlenecek
    $stmt2 = $pdo->prepare('UPDATE  consumption SET  consumption.count=0 , consumption.totalCount = consumption.totalCount+1
    WHERE  consumption.user_id =:user_id and consumption.product_id=:product_id');
    $stmt2->bindParam(':product_id', $product_id, PDO::PARAM_STR);
    $stmt2->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $stmt2->execute();

    if($gelendata){
      print $json_data;
    }else{
      echo "0";
    }
  }
}

function contact($pdo,$gelen_data){
  $branch_id = $gelen_data->branch_id;

  $stmt = $pdo->prepare("SELECT branch.location, branch.phone_number, branch.image,company.name_company
  FROM company, branch
  WHERE branch.branch_id =:branch_id AND branch.company_id = company.company_id");
  $stmt->bindParam(':branch_id', $branch_id, PDO::PARAM_STR);
  $stmt->execute();
  $gelenData = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
	$json_data=json_encode($gelenData,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
	if($gelenData){
    print $json_data;
  }else{
    echo "0";
  }
}

function get_branches($pdo,$gelen_data){
  //local->company_id
  $company_id = $gelen_data->company_id;
  $stmt = $pdo->prepare("SELECT branch.branch_id, branch.location, branch.image  FROM branch WHERE branch.company_id =:company_id");
  $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
	$stmt->execute();
	$gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
	$json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
	if($gelenuser){
    print $json_data;
  }else{
    echo "0";
  }
}
function get_productsKampanyali($pdo,$gelen_data){ //Kampanyali olanları getirecek.
  $branch_id = $gelen_data->branch_id;
  $stmt = $pdo->prepare("SELECT product.product_id, product.name_product, product.price, product.image FROM product WHERE product.branch_id =:branch_id
  and product.kampanyali=1");
  $stmt->bindParam(':branch_id', $branch_id, PDO::PARAM_STR);
	$stmt->execute();
	$gelenProducts = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
	$json_data=json_encode($gelenProducts,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
	if($gelenProducts){
    print $json_data;
  }else{
    echo "hata verdi php";
  }
}


function get_products($pdo,$gelen_data){
  $branch_id = $gelen_data->branch_id;
  $stmt = $pdo->prepare("SELECT product.product_id, product.name_product, product.price, product.image FROM product WHERE product.branch_id =:branch_id");
  $stmt->bindParam(':branch_id', $branch_id, PDO::PARAM_STR);
	$stmt->execute();
	$gelenProducts = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
	$json_data=json_encode($gelenProducts,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
	if($gelenProducts){
    print $json_data;
  }else{
    echo "0";
  }
}
//KASA İŞLEMLERİ
//-----------------------------------------------------------------------------------------
function if_exist_func($pdo,$value,$fieldName,$tableName){

	$stmt = $pdo->prepare("SELECT * FROM ".$tableName." WHERE ".$fieldName."=:".$value);
	$stmt->bindParam(':'.$value, $value, PDO::PARAM_STR);
	$stmt->execute();
	$gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
  $json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
  $return_value = false;
	if($gelenuser){
    $return_value = true;
  }
  return $return_value;
}

function if_exist_func_two($pdo,$value,$fieldName,$tableName,$value2,$fieldName2){

	$stmt = $pdo->prepare("SELECT * FROM ".$tableName." WHERE ".$fieldName."=:".$value." and ".$fieldName2." = ".$value2);
	$stmt->bindParam(':'.$value, $value, PDO::PARAM_STR);
	$stmt->execute();
	$gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
  $json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
  $return_value = false;
	if($gelenuser){
    $return_value = true;
  }
  return $return_value;
}

// function update_barcode($pdo,$gelen_data){
//   $user_id = $gelen_data->user_id;
//   $product_id = $gelen_data->product_id;
//   $campaign_id = $gelen_data->campaign_id;
//   //$campaign_code = $_GET['campaign_code'];
//   //qrcode_service->oluşturulan_barcode(user_id,product_id,campaign_id,campaign_code)
//   //  $pdo->stmt('UPDATE campaign SET validation=0 WHERE campaign_id=:campaign_id ');
//   $user_exist = if_exist_func($pdo,$user_id,"user_id","consumption");
//   if($user_exist==false){
//     //echo "Kullanıcı yok".'</br> --- </br>';
//     $stmt = $pdo->prepare('INSERT INTO consumption (user_id,product_id,count) VALUES ('.$user_id.','.$product_id.', 1)');
//     $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
//     $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
//     $stmt->execute();
//     $stmt2 = $pdo->prepare('UPDATE  campaign SET campaign.validation=0, campaign.user_id =:user_id WHERE campaign.campaign_id=:campaign_id ');
//     $stmt2->bindParam(':campaign_id',$campaign_id,PDO::PARAM_STR);
//     $stmt2->bindParam(':user_id', $user_id, PDO::PARAM_STR);
//     $stmt2->execute();
//   }else{
//     $product_exist = if_exist_func_two($pdo,$product_id,"product_id","consumption",$user_id,"user_id");
//     // $stmt3 = $pdo-> prepare('SELECT campaign.validation FROM campaign WHERE  campaign_id =: campaign_id ');
//     // $stmt3->bindParam(':campaign_id',$campaign_id,PDO::PARAM_STR);
//     // $stmt3->execute();

//     // $gelendata = $stmt3->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
//     // echo $gelendata;
//     // json_encode($gelendata,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
//     // print $gelendata[id];
//     // echo '</br> --- </br>';
//     if($product_exist==false){
//       echo "Kullanıcı var ürün yok";
//       $stmt = $pdo->prepare('INSERT INTO consumption (user_id,product_id,count) VALUES ('.$user_id.','.$product_id.', 1) ');
//       $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
//       $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
//       $stmt->execute();

//     }else{
//         echo "Kullanıcı ve ürün var";
//         $stmt = $pdo->prepare('UPDATE campaign, consumption SET campaign.validation=0, consumption.count=consumption.count+1,
//         campaign.user_id =:user_id WHERE campaign.campaign_id=:campaign_id and consumption.user_id =:user_id and consumption.product_id=:product_id');
//         $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
//         $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
//         $stmt->bindParam(':campaign_id', $campaign_id, PDO::PARAM_STR);
//         // $stmt->bindParam(':campaign_code', $campaign_code, PDO::PARAM_STR);
//         $stmt->execute();
//         // UPDATE campaign, consumption SET campaign.validation=0, consumption.count=consumption.count+1,
//         // campaign.user_id =1 WHERE campaign.campaign_id=7 and consumption.user_id =1 and consumption.product_id = 3
//         $count = $stmt->rowCount();

//         if($count =='0'){
//             echo "Failed !";
//         }
//         else{
//             echo "Success !";
//         }
//     }
//   }


// }

function kayitMail($gelen_data){
  $email_address = $gelen_data->email_address;

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
  $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
  <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
  <meta content="width=device-width" name="viewport"/>
  <!--[if !mso]><!-->
  <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
  <!--<![endif]-->
  <title></title>
  <!--[if !mso]><!-->
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"/>
  <!--<![endif]-->
  <style type="text/css">
      body {
        margin: 0;
        padding: 0;
      }

      table,
      td,
      tr {
        vertical-align: top;
        border-collapse: collapse;
      }

      * {
        line-height: inherit;
      }

      a[x-apple-data-detectors=true] {
        color: inherit !important;
        text-decoration: none !important;
      }
    </style>
  <style id="media-query" type="text/css">
      @media (max-width: 620px) {

        .block-grid,
        .col {
          min-width: 320px !important;
          max-width: 100% !important;
          display: block !important;
        }

        .block-grid {
          width: 100% !important;
        }

        .col {
          width: 100% !important;
        }

        .col>div {
          margin: 0 auto;
        }

        img.fullwidth,
        img.fullwidthOnMobile {
          max-width: 100% !important;
        }

        .no-stack .col {
          min-width: 0 !important;
          display: table-cell !important;
        }

        .no-stack.two-up .col {
          width: 50% !important;
        }

        .no-stack .col.num4 {
          width: 33% !important;
        }

        .no-stack .col.num8 {
          width: 66% !important;
        }

        .no-stack .col.num4 {
          width: 33% !important;
        }

        .no-stack .col.num3 {
          width: 25% !important;
        }

        .no-stack .col.num6 {
          width: 50% !important;
        }

        .no-stack .col.num9 {
          width: 75% !important;
        }

        .video-block {
          max-width: none !important;
        }

        .mobile_hide {
          min-height: 0px;
          max-height: 0px;
          max-width: 0px;
          display: none;
          overflow: hidden;
          font-size: 0px;
        }

        .desktop_hide {
          display: block !important;
          max-height: none !important;
        }
      }
    </style>
  </head>
  <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #222222;">
  <!--[if IE]><div class="ie-browser"><![endif]-->
  <table bgcolor="#222222" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #222222; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top;" valign="top">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#222222"><![endif]-->
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid three-up" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="200" style="background-color:transparent;width:200px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
  <div class="col num4" style="max-width: 320px; min-width: 200px; display: table-cell; vertical-align: top; width: 200px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <div></div>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td><td align="center" width="200" style="background-color:transparent;width:200px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
  <div class="col num4" style="max-width: 320px; min-width: 200px; display: table-cell; vertical-align: top; width: 200px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center autowidth" src="images/launch-template_logo.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 149px; display: block;" title="Image" width="149"/>
  <!--[if mso]></td></tr></table><![endif]-->
  </div>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td><td align="center" width="200" style="background-color:transparent;width:200px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
  <div class="col num4" style="max-width: 320px; min-width: 200px; display: table-cell; vertical-align: top; width: 200px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <div></div>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 15px; padding-right: 0px; padding-bottom: 15px; padding-left: 0px;" valign="top">
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 5px solid #A17C44; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top:5px; padding-bottom:5px;background-color:#FFFFFF;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="background-color:#FFFFFF;width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 10px; padding-left: 10px;">
  <!--<![endif]-->
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 30px; padding-bottom: 5px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
  <div style="color:#111111;font-family:"Roboto", Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:30px;padding-right:30px;padding-bottom:5px;padding-left:30px;">
  <div style="font-size: 12px; line-height: 1.2; font-family: "Roboto", Tahoma, Verdana, Segoe, sans-serif; color: #111111; mso-line-height-alt: 14px;">
  <p style="font-size: 14px; line-height: 1.2; mso-line-height-alt: 17px; margin: 0;"><strong><span style="font-size: 26px;">CafeAPP</span></strong></p>
  </div>
  </div>
  <!--[if mso]></td></tr></table><![endif]-->
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 5px; padding-bottom: 10px; font-family: Georgia, "Times New Roman", serif"><![endif]-->
  <div style="color:#888888;font-family:Georgia, Times, "Times New Roman", serif;line-height:1.8;padding-top:5px;padding-right:30px;padding-bottom:10px;padding-left:30px;">
  <div style="line-height: 1.8; font-family: Georgia, Times, "Times New Roman", serif; font-size: 12px; color: #888888; mso-line-height-alt: 22px;">
  <p style="line-height: 1.8; font-size: 14px; mso-line-height-alt: 25px; margin: 0;"><span style="font-size: 14px;">Hesabınızı onaylamamız için lütfen <a href="'.$site.'">buraya</a> tıklayınız.</span></p>
  </div>
  </div>
  <!--[if mso]></td></tr></table><![endif]-->
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table cellpadding="0" cellspacing="0" class="social_icons" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
  <table activate="activate" align="center" alignment="alignment" cellpadding="0" cellspacing="0" class="social_table" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: undefined; mso-table-tspace: 0; mso-table-rspace: 0; mso-table-bspace: 0; mso-table-lspace: 0;" to="to" valign="top">
  <tbody>
  <tr align="center" style="vertical-align: top; display: inline-block; text-align: center;" valign="top">
  <td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 8px; padding-left: 8px;" valign="top"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="images/facebook.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Facebook" width="32"/></a></td>
  <td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 8px; padding-left: 8px;" valign="top"><a href="http://twitter.com/" target="_blank"><img alt="Twitter" height="32" src="images/twitter.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Twitter" width="32"/></a></td>
  <td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 8px; padding-left: 8px;" valign="top"><a href="http://plus.google.com/" target="_blank"><img alt="Google+" height="32" src="images/googleplus.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Google+" width="32"/></a></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
  <div style="color:#888888;font-family:"Roboto", Tahoma, Verdana, Segoe, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
  <div style="font-size: 12px; line-height: 1.2; font-family: "Roboto", Tahoma, Verdana, Segoe, sans-serif; color: #888888; mso-line-height-alt: 14px;">
  <p style="font-size: 12px; line-height: 1.2; text-align: center; mso-line-height-alt: 14px; margin: 0;"><span style="font-size: 12px;">Copyright © 2016 YourSite, All rights reserved. </span></p>
  <p style="font-size: 12px; line-height: 1.2; text-align: center; mso-line-height-alt: 14px; margin: 0;"><span style="font-size: 12px;">You subscribed to our newsletter via our website, <span style="color: #ffffff; font-size: 12px;"><a href="example.com" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank">example.com</a></span></span></p>
  <p style="font-size: 14px; line-height: 1.2; text-align: center; mso-line-height-alt: 17px; margin: 0;"> </p>
  <p style="font-size: 12px; line-height: 1.2; text-align: center; mso-line-height-alt: 14px; margin: 0;"><span style="font-size: 12px; color: #ffffff;"><a href="example.com" rel="noopener" style="text-decoration: underline; color: #ffffff;" target="_blank">Unsubscribe from this list</a></span></p>
  </div>
  </div>
  <!--[if mso]></td></tr></table><![endif]-->
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <div style="background-color:transparent;">
  <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 600px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
  <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
  <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
  <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color:transparent;width:600px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
  <div class="col num12" style="min-width: 320px; max-width: 600px; display: table-cell; vertical-align: top; width: 600px;">
  <div style="width:100% !important;">
  <!--[if (!mso)&(!IE)]><!-->
  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
  <!--<![endif]-->
  <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; width: 100%;" valign="top" width="100%">
  <tbody>
  <tr style="vertical-align: top;" valign="top">
  <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (!mso)&(!IE)]><!-->
  </div>
  <!--<![endif]-->
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
  </div>
  </div>
  </div>
  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  </td>
  </tr>
  </tbody>
  </table>
  <!--[if (IE)]></div><![endif]-->
  </body>
  </html>';
  $mail->MsgHTML($content);

  //echo $gelen_data->phone_number;
  if($mail->Send()) {
     echo "Mail gönderildi";
  } else {
    echo "GÖNDERİLEMEDİ!!!!!!!!";
  }
}


function depleted_products($pdo,$gelen_data){
  $product_id=$gelen_data->product_id;
  $user_id = $gelen_data->user_id;
  $branch_id =$gelen_data->branch_id;
  $company_id=$gelen_data->company_id;

  $stmt = $pdo->prepare('INSERT INTO  depleted_products(product_id,user_id,branch_id,company_id)
  VALUES('.$product_id.','.$user_id.','.$branch_id.','.$company_id.')');
  $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
  $stmt->bindParam(':branch_id', $branch_id, PDO::PARAM_STR);
  $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
  $stmt->execute();
}



function qrcode_generator($pdo){

}

?>
