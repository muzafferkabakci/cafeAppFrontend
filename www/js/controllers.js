angular.module('starter.controllers', [])

.controller('AppCtrl', function($parse,$scope, $ionicModal, $timeout, $http, $rootScope) {


$scope.dinamikScope= function(name,data){
  var the_string = name;
  var modelScope = $parse(the_string);
  modelScope.assign($rootScope, data);

};

$scope.serviceLink="http://projeapp.site/cafe/services.php";


$scope.postService = function(scopeName,veri){

  $http.post($scope.serviceLink, veri)
  .success(function (data, status) {
    console.log("Gelen Data"+data);
    $scope.dinamikScope(scopeName,data);

    // if(scopeName == 'userbilgi'){
    //   localStorage.setItem("userInfo",data[0]);
    // }

    //console.log("Gelen Data User:"+$scope.userbilgi[0].name_user);

      //-ac-//console.log("n-10 gonderiliyor ..: " +  JSON.stringify(user));
      //-ac-//console.log("Token stored, device is successfully subscribed to receive push notifications.");

  })
  .error(function (data, status) {
      console.log("Hata Data"+data);
      //-ac-//console.log("Error storing device token." + data + " " + status)
        //-ac-//console.log("n-11");

  });

};




  //ileri seviye proje
  // Form data for the login modal
  $scope.loginData = {};

  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.loginModal = modal;
  });

  // Triggered in the login modal to close it
  $scope.closeLogin = function() {
    $scope.loginModal.hide();
  };

  // Open the login modal
  $scope.login = function() {
    $scope.loginModal.show();
  };

  // Perform the login action when the user submits the login form
  $scope.doLogin = function() {

    $scope.loginDataJson = {
      service_type : 'login_user',
      username : $scope.loginData.username,
      password_user : $scope.loginData.password
    };

    $scope.postService('userbilgi',$scope.loginDataJson)
    // var de = localStorage.getItem("userInfo");
    // console.log(de[0]);
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
  };
////////////////////////////////////////// forgot password ////////////////////////////
$ionicModal.fromTemplateUrl('templates/forgot.html', { //Sifremi unuttum sayfasını oluştruman gerek
  scope: $scope
}).then(function(modal) {
  $scope.forgotModal = modal; // moda
});
$scope.sifremiUnuttumAc = function(){ // burda o sayfayı açıyoruz
  console.log('deneme');
  $scope.forgotModal.show(); // Burda ekranda gösteriyoruz fakat kapatma olayını yazmadın aşağıdaki ile aynı
}// bir tane kapatma butonu ekleyeceksin oluşturduğun sayfaya sonra sifremiUnuttumKapa diye fonksiyon yazacaksın
// $scope.forgotModal.hide() çalıştıracaksın eğer o butona tıklanırsa diye

// Triggered in the login modal to close it
$scope.sifremiUnuttumKapa = function() {
  $scope.forgotModal.hide();
};
$scope.doForgot = function(){
  console.log($scope.loginData.phoneNumber);
  $scope.sifremiUnuttumKapa();
}//Uygulamada çalışmıyor
//////////////////////////////////////////  Register Start       ///////////////////////////////////////////////////////////////////////

// Create the register modal that we will use later
$ionicModal.fromTemplateUrl('templates/register.html', {
  scope: $scope
}).then(function(modal) {
  $scope.registerModal = modal;
});

// Triggered in the register modal to close it
$scope.closeRegister = function() {
  $scope.registerModal.hide();

};

// Open the register modal
$scope.register = function() {
  $scope.loginModal.hide();
  $scope.registerData = {};
  $scope.registerModal.show();
};

$scope.checkUser = function(){

    $scope.user = {};
    $scope.user.service_type = "user_varMi";
    $scope.user.username = $scope.registerData.username;
    var x=100;//timeout için değişken ataması. DB'deki user sayısına göre değişebilir.
    $scope.postService('usernameKontrol', $scope.user);

    $timeout(function(){
      console.log($scope.usernameKontrol);
      if($scope.usernameKontrol==1){
        document.getElementById("username").style.color ="red";
      }else{
        document.getElementById("username").style.color ="white";
      }
      $scope.$apply();
    },x);

}
$scope.checkMail = function(){

  $scope.user = {};
  $scope.user.service_type = "mail_varMi";
  $scope.user.email_address = $scope.registerData.email_address;
  var x=100;//timeout için değişken ataması. DB'deki user sayısına göre değişebilir.
  $scope.postService('mailKontrol', $scope.user);

  $timeout(function(){
    console.log($scope.mailKontrol);
    if($scope.mailKontrol==1){
      document.getElementById("mail").style.color ="red";
    }else{
      document.getElementById("mail").style.color ="white";
    }
    $scope.$apply();
  },x);

}
$scope.checkPhone = function(){

  $scope.user = {};
  $scope.user.service_type = "tel_varMi";
  $scope.user.phone_number = $scope.registerData.phone_number;
  var x=100;//timeout için değişken ataması. DB'deki user sayısına göre değişebilir.
  $scope.postService('telKontrol', $scope.user);

  $timeout(function(){
    console.log($scope.telKontrol);
    if($scope.telKontrol==1){
      document.getElementById("tel").style.color ="red";
    }else{
      document.getElementById("tel").style.color ="white";
    }
    $scope.$apply();
  },x);

}
$scope.doRegister = function(){
  $scope.registerDataJson = {
    service_type : 'register_user',
    username : $scope.registerData.username,
    password_user : $scope.registerData.password_user,
    name_user : $scope.registerData.name_user,
    school : $scope.registerData.school,
    email_address : $scope.registerData.email_address,
    phone_number :  $scope.registerData.phone_number,
    company_id : $scope.registerData.company_id
  };
  $scope.postService('registerBilgi',$scope.registerDataJson)
    // var de = localStorage.getItem("userInfo");
    // console.log(de[0]);
    $timeout(function() {
      $scope.closeRegister();
    }, 1000);
}
//////////////////////////////////////// Register End ////////////////////////////////////////////////////////////
//////////////////////////////////////// Karekod  /////////////////////////////////
$ionicModal.fromTemplateUrl('templates/barkod.html', {
  scope: $scope
}).then(function(modal) {
  $scope.barkodModal = modal;
});
$scope.barkodModalOpen = function(barkod){
  $scope.bilgi = barkod;
  $scope.barkodModal.show();
  $scope.degisken = "product_id: "+$scope.bilgi+"/user_id: ";
  console.log($scope.degisken);
  $scope.a = new QRCode(document.getElementById("qrcode"), {
    text: $scope.degisken,
    width: 200,
    height: 200,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
  });
}
$scope.tusId = function(degisken2){
  $scope.tusunId = degisken2;
  console.log($scope.tusunId);
}
$scope.barkodModalClose = function () {

  document.getElementById("qrcode").innerHTML = "";
  $scope.barkodModal.hide();

}
})

.controller('PlaylistsCtrl', function($scope,$rootScope, $http) {
  $scope.playlists = [
    { title: 'Elmalı Turta 14tl', resim:'https://i.pinimg.com/originals/e0/da/6e/e0da6e2493abf2817b524a8c1ec423e5.jpg',sayi:'2', id: 1 },
    { title: 'Çikolatalı Pasta',resim:'https://cdn03.ciceksepeti.com/cicek/kc522590-1/XL/cikolatali-cilekli-rulokat-pasta-kc522590-1-1.jpg',sayi:'1', id: 2 },
    { title
      :'Orman Meyveli Pasta',resim:'https://www.livashop.com/Uploads/UrunResimleri/buyuk/orman-meyveli-pasta-b18b.jpg',sayi:'3', id: 3 },
    { title:'Köstebek Pasta',resim:'http://i2.hurimg.com/i/hurriyet/75/1500x844/5c05137f0f25441c904134c7.jpg',sayi:'3', id: 4 },
    { title:'Meyveli Pasta',resim:'https://cdn.yemek.com/mnresize/940/940/uploads/2017/02/meyveli-pasta.jpg',sayi:'2', id: 5 },
    {  title:'Elmas Kurabiye',resim:'https://cdn.yemek.com/mncrop/313/280/uploads/2018/12/elmas-kurabiye-yemekcom.jpg',sayi:'1', id: 6 }
  ];

  $scope.kahveler = [
  { kahve:'2', id: 1 }
  ];

  $http.get("http://gokhanbirkin.net/services2.php?service_type=get_branches&company_id=1").
  success(function(data){
    $rootScope.subeler = data;
  });

  $http.get("http://gokhanbirkin.net/services2.php?service_type=get_products&branch_id=1")
  .success(function(data){
    $rootScope.products = data;
  });

})

.controller('PlaylistCtrl', function($scope, $stateParams) {
})

.controller('RegisterCtrl', function($scope, $http, $rootScope){

})

.controller('SearchCtrl',function($scope, $http){


});
