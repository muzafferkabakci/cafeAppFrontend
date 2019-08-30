<?php
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Credentials: true");
  header('Access-Control-Allow-Headers: X-Requested-With');
  header('Access-Control-Allow-Headers: Content-Type');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT'); // http://stackoverflow.com/a/7605119/578667
// header('Access-Control-Max-Age: 86400');
 include("databaseCon.php");

 $jsonDeneme ->username ="gkandth";
 $jsonDeneme ->password_user ="123";
 $jsonDeneme ->phone_number ="0537878276012";
 $jsonDeneme ->email_address = "asd";
 $jsonDeneme ->service_type ="register_user";
 $jsonDeneme ->name_user = "ads";
 $jsonDeneme ->school="asd";
 $jsonDeneme ->company_id="12";

 $gelen_json = json_encode($jsonDeneme);

//  $gelen_json = file_get_contents("php://input");
 $gelen_data = json_decode($gelen_json);
$service_type = $gelen_data->service_type;


// echo $myJson;
//login_user($pdo,$myJson);
//-----------------------------------------------------------------
switch($service_type){
  case register_user:
    // echo "registera girdi. DEneme".'</br> --- </br>';
    //echo "deneme";
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
    forgat_password($pdo,$gelen_data);
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
    echo "SwitchCase hata";
}


//Login
function login_user($pdo, $gelen_data){

    $username = $gelen_data->username;
    $password_user =$gelen_data->password_user;

    $stmt = $pdo->prepare("SELECT name_user, username,school,email_address,phone_number,company_id
    from user where username=:username and password_user=:password_user");
    //Localstorage -> name_user, username,school,email_address,phone_number,company_id
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password_user', $password_user, PDO::PARAM_STR);
    $stmt->execute();

 		$gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
		$json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
    if($gelenuser){
      // $jsonArray = json_decode($json_data,true);
      // return $jsonArray;
      print $json_data;
    }else{
      echo $gelenuser;
      return false;
    }
}
//Kayıt
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
	return $stmt->rowCount()==0;
}
function mail_varMi($pdo,$gelen_data){
  $email_address =$gelen_data->email_address;

	$stmt = $pdo->prepare("SELECT * FROM user WHERE email_address=:email_address");
	$stmt->bindParam(':email_address', $email_address, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->rowCount()==0;
}
function tel_varMi($pdo,$gelen_data){
  $phone_number =$gelen_data->phone_number;

	$stmt = $pdo->prepare("SELECT * FROM user WHERE phone_number=:phone_number");
	$stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->rowCount()==0;
}
//SMS MAİL <---
function forgot_password($pdo,$gelen_data){
  $username = $gelen_data->username;
  $stmt = $pdo->prepare("SELECT phone_number,email_address FROM user WHERE username=:username");
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->execute();

  $gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
  $json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
  if($gelenuser){
    print $json_data;
  }else{
    echo "0";
  }
}


//Veritabanından sorgu bekleniyor..
function load_home($pdo,$gelen_data){
  $user_id = $gelen_data->user_id;
  //$product_id = $_GET['product_id'];
  $stmt = $pdo->prepare('SELECT consumption.product_id, consumption.count FROM consumption WHERE consumption.user_id =:user_id');
  //SELECT(JOIN)(Product Name,Product ID,Product Image,Campaign Code ID, (campaign)Product ID)
  //Localstorage -> name_user, school
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
  //$stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
  $stmt->execute();

  $gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
  $json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
  if($gelenuser){
    return $json_data;
  }else{
    echo "0";
  }
}

//front-end'den buton_id gelcek


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

function get_products($pdo,$gelen_data){
  $branch_id = $gelen_data->branch_id;
  $stmt = $pdo->prepare("SELECT product.product_id, product.name_product, product.price, product.image, product.stock FROM product WHERE product.branch_id =:branch_id");
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

function buton_click($pdo,$gelen_data){ // gelen_data'nın içinde button diye bir değişken alıyoruz.
  $user_id = $gelen_data->user_id;
  $product_id = $gelen_data->product_id;
  $free = $gelen_data->free;

  if($free == false){ // bu değişken true geliyorsa bedava kullanım yoktur. Tüketim artacak.
    //Yeni ürün tüketiminde burası çalışır.
    //Oluşturulan kodda user_id ve product_id olacak
    //Kasa bu servisi çalıştıracak.

    //$user_exist = if_exist_func($pdo,$user_id,"user_id","consumption");
    // if($user_exist==false){ //gerek yok
    //   echo "Kullanıcı yok".'</br> --- </br>';
    //   $stmt = $pdo->prepare('INSERT INTO consumption (user_id,product_id,count) VALUES ('.$user_id.','.$product_id.', 1)');
    //   $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
    //   $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
    //   $stmt->execute();
    // }else{    //$pdo,$value,$fieldName,$tableName,$value2,$fieldName2
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
  else{ //false geliyorsa bedava için kod üreteceğiz
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
// function update_barcode($pdo,$gelen_data){ //Yeni ürün tüketiminde burası çalışır.
//   //Oluşturulan kodda user_id ve product_id olacak
//   //Kasa bu servisi çalıştıracak.
//   $user_id = $gelen_data->user_id;
//   $product_id = $gelen_data->product_id;
//   $user_exist = if_exist_func($pdo,$user_id,"user_id","consumption");
//   if($user_exist==false){
//     echo "Kullanıcı yok".'</br> --- </br>';
//     $stmt = $pdo->prepare('INSERT INTO consumption (user_id,product_id,count) VALUES ('.$user_id.','.$product_id.', 1)');
//     $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
//     $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
//     $stmt->execute();
//   }else{
//     $product_exist = if_exist_func_two($pdo,$product_id,"product_id","consumption",$user_id,"user_id");
//     if($product_exist==false){
//       echo "Kullanıcı var tüketim yok";
//       $stmt = $pdo->prepare('INSERT INTO consumption (user_id,product_id,count) VALUES ('.$user_id.','.$product_id.', 1) ');
//       $stmt->bindParam(':user_id',$user_id,PDO::PARAM_STR);
//       $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
//       $stmt->execute();

//     }else{
//       echo "Kullanıcı ve tüketim var";
//       $stmt = $pdo->prepare('UPDATE  consumption SET  consumption.count=consumption.count+1
//       WHERE  consumption.user_id =:user_id and consumption.product_id=:product_id');
//       $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
//       $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
//       $stmt->execute();
//     }
//   }


// }

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
