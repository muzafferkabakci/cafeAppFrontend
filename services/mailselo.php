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
  $content = '<div class="gmail_quote"><br><br>
    
    
    
  
  
    <table border="0" cellpadding="0" cellspacing="0" class="m_-7122673421951135143m_1790322432680396537body" style="border-collapse:separate;background-color:#f6f6f6;background-image:url(https://ci5.googleusercontent.com/proxy/DbYaX2yV8PZiUqzFp5SttQgikNDG4EEJzsDtBmM9gBIp3FTPHbVETCt-YIOEK8we3vx07VIIQ_yNcFalwVbHZYBsh1job2TXYh2vG1C38A=s0-d-e1-ft#https://static2.cdn.ubi.com/email/images/grey-background.png);background-repeat:repeat;width:100%">
      <tbody><tr>
        <td style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top">&nbsp;</td>
        <td class="m_-7122673421951135143m_1790322432680396537container" style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top;display:block;max-width:750px;padding:10px;width:750px;Margin:0 auto!important;width:auto!important">
          <div class="m_-7122673421951135143m_1790322432680396537content" style="box-sizing:border-box;display:block;Margin:0 auto;max-width:750px;padding:10px">
            
            <table class="m_-7122673421951135143m_1790322432680396537header" width="100%" style="border-collapse:separate;background:#fff;border-radius:0px;border-spacing:0px;width:100%">
              
              <tbody><tr>
                <td class="m_-7122673421951135143m_1790322432680396537no-wrapper" width="100%" style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top;box-sizing:border-box;padding:0px">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" class="m_-7122673421951135143m_1790322432680396537logo" style="border-collapse:separate;width:100%;border-top:5px solid #696969;border-bottom:9px solid #696969">
                    <tbody><tr>
                      <td style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top">
                        <a  style="color:#3498db;text-decoration:underline;display:block;width:100%" target="_blank" data-saferedirecturl="WhatsApp Image 2019-09-29 at 18.44.38.jpeg" width="180" height="64" style="border:none;max-width:100%;margin-top:10px;margin-bottom:5px"></a>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              
            </tbody></table>
            <table class="m_-7122673421951135143m_1790322432680396537main" style="border-collapse:separate;background:#fff;border-radius:0px;width:100%;margin-bottom:30px">
              
              <tbody><tr>
                <td class="m_-7122673421951135143m_1790322432680396537wrapper" style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top;box-sizing:border-box;padding:20px">
                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate;width:100%">
                    <tbody><tr>
                      <td style="vertical-align:top">
                        <p style="font-family:Verdana,sans-serif;font-size:14px;font-weight:normal;margin:0px 0px 15px;list-style-type:disc">Hi,</p>

                        <p style="font-family:Verdana,sans-serif;font-size:14px;font-weight:normal;margin:0px 0px 15px;list-style-type:disc"> AŞAĞIYA BAK </p><p style="font-family:Verdana,sans-serif;font-size:14px;font-weight:normal;margin:0px 0px 15px;list-style-type:disc">Kullanıcı Adınız: $username Şifreniz:$pass</p>
                        <p style="font-family:Verdana,sans-serif;font-size:14px;font-weight:normal;margin:0;Margin-bottom:15px;list-style-type:disc;font-weight:bold">If this wasnt you:</p>
                        <p style="margin:0px 0px 15px;list-style-type:disc">Your Ubisoft account may have been compromised and you should take a few steps to make sure it is secure. To start, reset your password now. After that, we recommend you to  <a href="https://account-uplay.ubi.com/en-US/security-settings" link="" style="font-family:Verdana,sans-serif;font-size:14px;font-weight:normal;color:rgb(52,152,219);text-decoration:underline" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://account-uplay.ubi.com/en-US/security-settings&amp;source=gmail&amp;ust=1569855869681000&amp;usg=AFQjCNGDyjF-MailUY25ZKX2fsjz98_Qdw"><strong>activate the 2-Step Verification</strong></a> to enhance the security of your account.</p>

                        <p style="font-family:Verdana,sans-serif;font-size:14px;font-weight:normal;margin:0px 0px 15px;list-style-type:disc">Ubisoft</p>
                      </td>
                    </tr>
                  </tbody></table>
                </td>
              </tr>
              
            </tbody></table>
            
            <div class="m_-7122673421951135143m_1790322432680396537footer" style="clear:both;padding-top:10px;text-align:center;width:100%">
              <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate;width:100%">
                <tbody><tr>
                  <td class="m_-7122673421951135143m_1790322432680396537content-block" style="vertical-align:top;text-align:center">
                    <p style="color:rgb(153,153,153);font-family:Verdana,sans-serif;font-size:12px;font-weight:normal;margin:0px 0px 15px;list-style-type:disc;text-align:center"> “©2019 Ubisoft Entertainment. All rights reserved. Ubisoft and the Ubisoft logo are trademarks of Ubisoft Entertainment in the U.S. and/or other countries.</p><p style="color:rgb(153,153,153);font-family:Verdana,sans-serif;font-size:12px;font-weight:normal;margin:0px 0px 15px;list-style-type:disc;text-align:center">UBISOFT ENTERTAINMENT S.A., a société anonyme incorporated under the laws of France having its registered office at 107 Avenue Henri Freville, BP 1070, 35207 Rennes, France”</p>
                  </td>
                </tr>
              </tbody></table>
            </div>
            
            
          </div>
        </td>
        <td style="font-family:Verdana,sans-serif;font-size:14px;vertical-align:top">&nbsp;</td>
      </tr>
    </tbody></table></div>
  
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
