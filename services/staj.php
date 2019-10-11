<?php
  header('Access-Control-Allow-Origin: *');
  header("Access-Control-Allow-Credentials: true");
  header('Access-Control-Allow-Headers: X-Requested-With');
  header('Access-Control-Allow-Headers: Content-Type');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
  include("databaseCon.php");
  $gelen_data ->username ="gkand";
  $gelen_data ->password_user ="123";
  $service_type = "login_user";
  switch($service_type){
    case register_user:
      register_user($pdo, $gelen_data);
      break;
    case login_user:
      login_user($pdo,$gelen_data);
      break;
    case get_products:
      get_products($pdo,$gelen_data);
      break;
    default:
    echo $service_type." HATA";
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

  function login_user($pdo, $gelen_data){
    $username = $gelen_data->username;
    $password_user =$gelen_data->password_user;
    $stmt = $pdo->prepare("SELECT user_id,name_user, username,school,email_address,phone_number,user_id
    from user where username=:username and password_user=:password_user");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password_user', $password_user, PDO::PARAM_STR);
    $stmt->execute(); //de
 		$gelenuser = $stmt->fetchAll(PDO::FETCH_ASSOC); //tüm gelenleri atıyor
		$json_data=json_encode($gelenuser,JSON_UNESCAPED_UNICODE); //json'a döüştürüyor
    if($gelenuser){
      print $json_data;
    }else{
      return "HATA";
    }
  }

  function register_user($pdo,$gelen_data){
    $name_user = $gelen_data->name_user;
    $username = $gelen_data->username;
    $password_user = $gelen_data->password_user;
    $school= $gelen_data->school;
    $email_address= $gelen_data->email_address;
    $phone_number= $gelen_data->phone_number;
    $company_id= $gelen_data->company_id;
    if( $pdo->exec('INSERT INTO user ( name_user, username,
    password_user,school,email_address,phone_number,company_id)
    VALUES ("'.$name_user.'","'.$username.'","'.$password_user.'","'
    .$school.'","'.$email_address.'","'.$phone_number.'","'.$company_id.'")'))
    {echo "kayıt eklendi";}else{echo "Hata oluştu"}
  }
  function load_home($pdo,$gelen_data){ //Gelen kullanıcının tükettiği ürünleri ve sayısını yazıyor
    $user_id = $gelen_data->user_id;

    $stmt = $pdo->prepare('SELECT consumption.product_id, consumption.count FROM consumption, product WHERE
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
  function get_productsKampanyali($pdo,$gelen_data){ //Kampanyali ürünleri yazıyor.
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


?>
