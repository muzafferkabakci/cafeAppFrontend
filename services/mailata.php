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



  $phone_number = $_GET['tel'];



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
    @media (max-width: 500px) {

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
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #48363D;">
<!--[if IE]><div class="ie-browser"><![endif]-->
<table bgcolor="#48363D" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #48363D; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#48363D"><![endif]-->
<div style="background-image:url("images/bg_hero_coffee.gif");background-position:top center;background-repeat:no-repeat;background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 480px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image:url("images/bg_hero_coffee.gif");background-position:top center;background-repeat:no-repeat;background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:480px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="480" style="background-color:transparent;width:480px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:30px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 480px; display: table-cell; vertical-align: top; width: 480px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:30px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div align="center" class="img-container center fixedwidth" style="padding-right: 20px;padding-left: 20px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 20px;padding-left: 20px;" align="center"><![endif]-->
<div style="font-size:1px;line-height:20px"> </div><img align="center" alt="Image" border="0" class="center fixedwidth" src="images/logo_coffbex.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 288px; display: block;" title="Image" width="288"/>
<div style="font-size:1px;line-height:20px"> </div>
<!--[if mso]></td></tr></table><![endif]-->
</div>
<div align="center" class="img-container center fullwidthOnMobile fixedwidth" style="padding-right: 0px;padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center fullwidthOnMobile fixedwidth" src="images/Coffee_center.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: nullpx; display: block;" title="Image"/>
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 0px; font-family: Arial, sans-serif"><![endif]-->
<div style="color:#EA6647;font-family:Arial, "Helvetica Neue", Helvetica, sans-serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
<div style="font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.2; color: #EA6647; mso-line-height-alt: 14px;">
<p style="font-size: 64px; line-height: 1.2; text-align: center; mso-line-height-alt: 77px; margin: 0;"><span style="background-color: #fcebd4; font-size: 64px;"><strong><span style="background-color: #fcebd4; font-size: 64px;"> 50% OFF </span></strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#555555;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; font-size: 12px; line-height: 1.2; color: #555555; mso-line-height-alt: 14px;">
<p style="font-size: 22px; line-height: 1.2; text-align: center; mso-line-height-alt: 26px; margin: 0;"><span style="font-size: 22px; background-color: #fcebd4;"> Mauris eu lorem sed diam <strong>viverra pulvinar</strong>. </span></p>
<p style="font-size: 22px; line-height: 1.2; text-align: center; mso-line-height-alt: 26px; margin: 0;"><span style="font-size: 22px; background-color: #fcebd4;">Aenean aliquam, nibh dapibus sagittis. </span></p>
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
<div style="background-image:url("images/bg_center.png");background-position:top center;background-repeat:repeat;background-color:#66292d;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 480px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image:url("images/bg_center.png");background-position:top center;background-repeat:repeat;background-color:#66292d;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:480px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="480" style="background-color:transparent;width:480px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:50px; padding-bottom:50px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 480px; display: table-cell; vertical-align: top; width: 480px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:50px; padding-bottom:50px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div class="mobile_hide">
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="35" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 35px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="35" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
<div class="mobile_hide">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 0px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#FFFFFF;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; font-size: 12px; line-height: 1.2; color: #FFFFFF; mso-line-height-alt: 14px;">
<p style="font-size: 38px; line-height: 1.2; text-align: center; mso-line-height-alt: 46px; margin: 0;"><span style="font-size: 38px;">kullanıcı adınız:</span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if !mso]><!-->
<div class="desktop_hide" style="mso-hide: all; display: none; max-height: 0px; overflow: hidden;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 0px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#FFFFFF;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; font-size: 12px; line-height: 1.2; color: #FFFFFF; mso-line-height-alt: 14px;">
<p style="font-size: 24px; line-height: 1.2; text-align: center; mso-line-height-alt: 29px; margin: 0;"><span style="font-size: 24px;">kullanıcı adınız:</span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 25px; padding-bottom: 25px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#555555;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:25px;padding-right:10px;padding-bottom:25px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; line-height: 1.2; font-size: 12px; color: #555555; mso-line-height-alt: 14px;">
<p style="line-height: 1.2; text-align: center; font-size: 28px; mso-line-height-alt: 34px; margin: 0;"><span style="font-size: 28px; background-color: #ffffff;"><strong><span style="background-color: #ffffff; font-size: 28px;">'.$username.' </span></strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
<div style="color:#FFFFFF;font-family:Arial, "Helvetica Neue", Helvetica, sans-serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.2; color: #FFFFFF; mso-line-height-alt: 14px;">
<p style="font-size: 14px; line-height: 1.2; text-align: center; mso-line-height-alt: 17px; margin: 0;">Valid on 12 lorem t ultricies consectetuonvallis mauris.</p>
<p style="font-size: 14px; line-height: 1.2; text-align: center; mso-line-height-alt: 17px; margin: 0;">Aenean commodo iaculis dolor sed vehicula.</p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<div class="mobile_hide">
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="50" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 50px; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td height="50" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
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
<div style="background-color:#FFFFFF;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 480px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#FFFFFF;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:480px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="480" style="background-color:transparent;width:480px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:25px; padding-bottom:25px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 480px; display: table-cell; vertical-align: top; width: 480px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:25px; padding-bottom:25px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 0px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#EA6647;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; line-height: 1.2; font-size: 12px; color: #EA6647; mso-line-height-alt: 14px;">
<p style="line-height: 1.2; text-align: center; font-size: 12px; mso-line-height-alt: 14px; margin: 0;"><strong><span style="font-size: 38px;">LOREM IPSUM:</span></strong></p>
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
<div style="background-color:#FFFFFF;">
<div class="block-grid three-up" style="Margin: 0 auto; min-width: 320px; max-width: 480px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#FFFFFF;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:480px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="160" style="background-color:transparent;width:160px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 15px; padding-left: 15px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 160px; display: table-cell; vertical-align: top; width: 160px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 15px; padding-left: 15px;">
<!--<![endif]-->
<div align="center" class="img-container center fullwidthOnMobile fixedwidth" style="padding-right: 0px;padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center fullwidthOnMobile fixedwidth" src="images/celtic.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: nullpx; display: block;" title="Image"/>
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 5px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#66292d;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:5px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; font-size: 12px; line-height: 1.2; color: #66292d; mso-line-height-alt: 14px;">
<p style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px; margin: 0;"><strong><span style="font-size: 18px;">CELTIC CAFE</span></strong></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
<div style="color:#FFFFFF;font-family:Arial, "Helvetica Neue", Helvetica, sans-serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.2; color: #FFFFFF; mso-line-height-alt: 14px;">
<p style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px; margin: 0;"><span style="color: #808080; font-size: 14px;">Ultricies consectetur suspendisse a convallis mauris</span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="160" style="background-color:transparent;width:160px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 15px; padding-left: 15px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 160px; display: table-cell; vertical-align: top; width: 160px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 15px; padding-left: 15px;">
<!--<![endif]-->
<div align="center" class="img-container center autowidth fullwidth" style="padding-right: 0px;padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center autowidth fullwidth" src="images/Italian.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 130px; display: block;" title="Image" width="130"/>
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 5px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#66292d;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:5px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; font-size: 12px; line-height: 1.2; color: #66292d; mso-line-height-alt: 14px;">
<p style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px; margin: 0;"><strong><span style="font-size: 18px;">ITALIAN ESPRESSO</span></strong></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
<div style="color:#FFFFFF;font-family:Arial, "Helvetica Neue", Helvetica, sans-serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.2; color: #FFFFFF; mso-line-height-alt: 14px;">
<p style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px; margin: 0;"><span style="color: #808080; font-size: 14px;">Ultricies consectetur suspendisse a convallis mauris</span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="160" style="background-color:transparent;width:160px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 15px; padding-left: 15px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num4" style="max-width: 320px; min-width: 160px; display: table-cell; vertical-align: top; width: 160px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 15px; padding-left: 15px;">
<!--<![endif]-->
<div align="center" class="img-container center autowidth fullwidth" style="padding-right: 0px;padding-left: 0px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center autowidth fullwidth" src="images/aztec.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 130px; display: block;" title="Image" width="130"/>
<!--[if mso]></td></tr></table><![endif]-->
</div>
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 5px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#66292d;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:5px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; font-size: 12px; line-height: 1.2; color: #66292d; mso-line-height-alt: 14px;">
<p style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px; margin: 0;"><strong><span style="font-size: 18px;">AZTEC CAPPUCCINO</span></strong></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
<div style="color:#FFFFFF;font-family:Arial, "Helvetica Neue", Helvetica, sans-serif;line-height:1.2;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.2; color: #FFFFFF; mso-line-height-alt: 14px;">
<p style="font-size: 14px; line-height: 1.2; text-align: left; mso-line-height-alt: 17px; margin: 0;"><span style="color: #808080; font-size: 14px;">Ultricies consectetur Suspendisse a convallis mauris</span></p>
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
<div style="background-color:#FFFFFF;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 480px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#FFFFFF;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:480px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="480" style="background-color:transparent;width:480px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:30px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 480px; display: table-cell; vertical-align: top; width: 480px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:30px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:40.5pt; width:274.5pt; v-text-anchor:middle;" arcsize="0%" stroke="false" fillcolor="#66292d"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:"Times New Roman", Georgia, serif; font-size:22px"><![endif]-->
<div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#66292d;border-radius:0px;-webkit-border-radius:0px;-moz-border-radius:0px;width:auto; width:auto;;border-top:1px solid #66292d;border-right:1px solid #66292d;border-bottom:1px solid #66292d;border-left:1px solid #66292d;padding-top:5px;padding-bottom:5px;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:40px;padding-right:40px;font-size:22px;display:inline-block;">
<span style="font-size: 16px; line-height: 2; mso-line-height-alt: 32px;"><span style="font-size: 22px; line-height: 44px;"><strong>COME TO OUR STORES ↬</strong></span></span>
</span></div>
<!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
</div>
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
<div style="background-color:#FFFFFF;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 480px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#FFFFFF;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:480px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="480" style="background-color:transparent;width:480px; border-top: 1px solid #DBDBDB; border-left: 0px solid #CECECE; border-bottom: 0px solid #CECECE; border-right: 0px solid #CECECE;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
<div class="col num12" style="min-width: 320px; max-width: 480px; display: table-cell; vertical-align: top; width: 480px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:1px solid #DBDBDB; border-left:0px solid #CECECE; border-bottom:0px solid #CECECE; border-right:0px solid #CECECE; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#555555;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; font-size: 12px; line-height: 1.2; color: #555555; mso-line-height-alt: 14px;">
<p style="font-size: 14px; line-height: 1.2; text-align: center; mso-line-height-alt: 17px; margin: 0;"><strong><a href="#" rel="noopener" style="text-decoration: none; color: #404040;" target="_blank">ABOUT US</a>  |  <a href="#" rel="noopener" style="text-decoration: none; color: #404040;" target="_blank">OUR STORES</a>   |  <a href="#" rel="noopener" style="text-decoration: none; color: #404040;" target="_blank">DOWNLOAD APP </a></strong></p>
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
<div style="background-color:#22bca2;">
<div class="block-grid mixed-two-up" style="Margin: 0 auto; min-width: 320px; max-width: 480px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#22bca2;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:480px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
<!--[if (mso)|(IE)]><td align="center" width="160" style="background-color:transparent;width:160px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 15px; padding-left: 15px; padding-top:20px; padding-bottom:20px;"><![endif]-->
<div class="col num4" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 160px; width: 160px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:20px; padding-bottom:20px; padding-right: 15px; padding-left: 15px;">
<!--<![endif]-->
<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 0px; font-family: "Times New Roman", Georgia, serif"><![endif]-->
<div style="color:#FFFFFF;font-family:TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:0px;padding-left:10px;">
<div style="font-family: TimesNewRoman, "Times New Roman", Times, Beskerville, Georgia, serif; font-size: 12px; line-height: 1.2; color: #FFFFFF; mso-line-height-alt: 14px;">
<p style="font-size: 24px; line-height: 1.2; text-align: center; mso-line-height-alt: 29px; margin: 0;"><span style="font-size: 24px;"><strong><span style="font-size: 24px;">C0FFBEE</span></strong></span></p>
</div>
</div>
<!--[if mso]></td></tr></table><![endif]-->
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
<!--[if (mso)|(IE)]></td><td align="center" width="320" style="background-color:transparent;width:320px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 15px; padding-left: 0px; padding-top:20px; padding-bottom:20px;"><![endif]-->
<div class="col num8" style="display: table-cell; vertical-align: top; min-width: 320px; max-width: 320px; width: 320px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:20px; padding-bottom:20px; padding-right: 15px; padding-left: 0px;">
<!--<![endif]-->
<table cellpadding="0" cellspacing="0" class="social_icons" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
<table activate="activate" align="right" alignment="alignment" cellpadding="0" cellspacing="0" class="social_table" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: undefined; mso-table-tspace: 0; mso-table-rspace: 0; mso-table-bspace: 0; mso-table-lspace: 0;" to="to" valign="top">
<tbody>
<tr align="right" style="vertical-align: top; display: inline-block; text-align: right;" valign="top">
<td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 0px; padding-left: 15px;" valign="top"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="images/facebook@2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Facebook" width="32"/></a></td>
<td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 0px; padding-left: 15px;" valign="top"><a href="https://twitter.com/" target="_blank"><img alt="Twitter" height="32" src="images/twitter@2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Twitter" width="32"/></a></td>
<td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 0px; padding-left: 15px;" valign="top"><a href="https://instagram.com/" target="_blank"><img alt="Instagram" height="32" src="images/instagram@2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="Instagram" width="32"/></a></td>
<td style="word-break: break-word; vertical-align: top; padding-bottom: 5px; padding-right: 0px; padding-left: 15px;" valign="top"><a href="https://www.linkedin.com/" target="_blank"><img alt="LinkedIn" height="32" src="images/linkedin@2x.png" style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: none; display: block;" title="LinkedIn" width="32"/></a></td>
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
</html>
  ';
  $mail->MsgHTML($content);
  $mail->Send();
  //echo $gelen_data->phone_number;
  if($mail->Send()) {
     return true;
  } else {
      return false;
  }


?>
