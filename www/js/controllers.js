angular.module('starter.controllers', [])

.controller('AppCtrl', function($parse,$scope, $ionicModal, $timeout, $http, $rootScope) {


$scope.dinamikScope= function(name,data){
  var the_string = name;
  var modelScope = $parse(the_string);
  modelScope.assign($rootScope, data);

};

$scope.serviceLink="http://projeapp.site/cafe/services.php";

$scope.postService = function(scopeName, sentData){

  return $http.post($scope.serviceLink, sentData)
          .then(function (response) {
            var data = response.data;
            console.log("Fetched data: " + data);
            $scope.dinamikScope(scopeName, data);
            return response.data;
          })
          .catch(function (response) {
             var errData = response.data;
             console.log("Error: "+errData);
             throw response;
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

    var promise = $scope.postService("userInfo", $scope.loginDataJson);

    promise.then(function(data) {
        console.log(data);
        console.log("ROOT SCOPE"+$rootScope.userInfo[0].name_user);

        localStorage.setItem('kullaniciBilgi',JSON.stringify($rootScope.userInfo[0])); //Localden çekilcek diğer sayfalardan
    });

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
//////////////////////////////////////////  Register Başlangıç       ///////////////////////////////////////////////////////////////////////

// Register modali oluşturuyoruz
$ionicModal.fromTemplateUrl('templates/register.html', {
  scope: $scope
}).then(function(modal) {
  $scope.registerModal = modal;
});

//Tetiklendiğinde register modalini kapıyor
$scope.closeRegister = function() {
  $scope.registerModal.hide();

};

// Tetiklendiğinde register modalini açıyor
$scope.register = function() {
  $scope.loginModal.hide();
  $scope.registerData = {};
  $scope.registerModal.show();
  $scope.dogrula = 0;
};
/**var promise = $scope.postService("userInfo", $scope.loginDataJson);

    promise.then(function(data) {
        console.log(data);
        console.log($scope.userInfo[0].name_user);
        //console.log($scope.userInfo[0]);

        localStorage.setItem('kullaniciBilgi',JSON.stringify($scope.userInfo[0])); //Localden çekilcek diğer sayfalardan
    }); */
$scope.checkUser = function(){

    $scope.user = {};
    $scope.user.service_type = "user_varMi";
    $scope.user.username = $scope.registerData.username;

    var promise = $scope.postService('usernameKontrol', $scope.user);
    promise.then(function(data){
      console.log("data : ",data);
      console.log($scope.usernameKontrol[0]);
    })
}
$scope.checkMail = function(){

  $scope.user = {};
  $scope.user.service_type = "mail_varMi";
  $scope.user.email_address = $scope.registerData.email_address;

  var promise =$scope.postService('mailKontrol', $scope.user);
  promise.then(function(data){
    console.log("data : ",data);
    console.log($scope.usernameKontrol[0]);
  })

}
$scope.checkPhone = function(){

  $scope.user = {};
  $scope.user.service_type = "tel_varMi";
  $scope.user.phone_number = $scope.registerData.phone_number;

  var promise = $scope.postService('telKontrol', $scope.user);

  promise.then(function(data){
    //console.log("data : ",data);
    //console.log($scope.usernameKontrol[0]);
    if($scope.usernameKontrol[0]==1){
      console.log("Telefon no var");
    }
  })
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
    $scope.postService('registerBilgi',$scope.registerDataJson);
  }




//////////////////////////////////////// Register End ////////////////////////////////////////////////////////////
/**
 * Kayıt olunduktan sonra ekrana bir modal açılacak.
 * Eğer kayıt başarılıysa modalin fonksiyonuna ekrana yazılacak yazı , timeout süresi gönderilecek
 * Kayıt başarılı değil ise ekrana yazılacak yazı, timeout süresi=10000, butona basılınca çalışacak fonksiyonun adı gönderilecek
 *
 */



//////////////////////////////////////// Karekod  /////////////////////////////////
$ionicModal.fromTemplateUrl('templates/barkod.html', {
  scope: $scope
}).then(function(modal) {
  $scope.barkodModal = modal;
});
$scope.barkodModalOpen = function(barkod){
  $scope.gelenler = localStorage.getItem('kullaniciBilgi'); //LocalStorage'a attığımız bilgileri String olarak aldık
  $scope.tmp = angular.fromJson($scope.gelenler);

  $scope.bilgi = barkod;
  $scope.barkodModal.show();
  $scope.degisken = "product_id: "+$scope.bilgi+"/user_id: "+$scope.tmp.user_id;
  console.log($scope.degisken);
  $scope.a = new QRCode(document.getElementById("qrcode"), {
    text: $scope.degisken+$scope.tmp.user_id,
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
/**
 * / Uyarı ekran
    $rootScope.loadData = function(bilgi,icon) {
    //console.log('uyarı alanına geldi');
    $scope.loadingIndicator = $ionicLoading.show({
            template: ' <p><i class="icon '+icon +' uyari_icon"></i></p> '+bilgi
        });

    $timeout(function() {

      $ionicLoading.hide();
    }, 3000);
  }; //Uyarı
 */

$ionicModal.fromTemplateUrl('templates/bildiri.html',{
  scope:$scope
}).then(function(modal){
  $scope.bildiriModal = modal;
});
$scope.bildiriModalOpen = function(yazi,sure,fonk){
  console.log("GİRDİ Mİ ?");
  $scope.yazi = yazi;//modal sayfasında kullanılacak yazı
  //console.log($scope.yazi);
  $scope.bildiriModal.show();
  if(fonk!=null){
    $scope.gelenFonk = fonk; //fonksiyonun ismini alıyoruz

    $scope.gelenFonk();
  }


  $timeout(function(){
    $scope.bildiriModalClose();
  },sure);
}
$scope.bildiriModalClose =function(){
  $scope.bildiriModal.hide();

}
})


.controller('PlaylistsCtrl', function($scope,$rootScope, $http) {
  $scope.gelenler = localStorage.getItem('kullaniciBilgi'); //LocalStorage'a attığımız bilgileri String olarak aldık
  $scope.tmp = angular.fromJson($scope.gelenler);//String olan bilgileri JSON objesine dönüştürdük
  console.log($scope.tmp);
  $scope.veriAl = {
    service_type : 'load_home',
    user_id : $scope.tmp.user_id
  };
  var promise =$scope.postService('tuketilenSayilar', $scope.veriAl);
  promise.then(function(data){
    console.log("data : ",data);
    console.log($scope.tuketilenSayilar[0].product_id +" : "+$scope.tuketilenSayilar[0].count%4);
  })



  $scope.playlistD = {
    service_type : 'get_productsKampanyali',
    branch_id : '1'
  };
  var promise =$scope.postService('playlists', $scope.playlistD);
  promise.then(function(data){
    //console.log("data : ",data);
    localStorage.setItem('kampanyaliUrunler',JSON.stringify($rootScope.playlists));
    console.log($rootScope.playlists[0]);
    $scope.gelenSayilar = localStorage.getItem('kampanyaliUrunler')

  })


  // $scope.playlists = [
  //   { title: 'Elmalı Turta 14tl', resim:'https://i.pinimg.com/originals/e0/da/6e/e0da6e2493abf2817b524a8c1ec423e5.jpg',sayi:'10', id: 1 },
  //   { title: 'Çikolatalı Pasta',resim:'https://cdn03.ciceksepeti.com/cicek/kc522590-1/XL/cikolatali-cilekli-rulokat-pasta-kc522590-1-1.jpg',sayi:'1', id: 2 },
  //   { title
  //     :'Orman Meyveli Pasta',resim:'https://www.livashop.com/Uploads/UrunResimleri/buyuk/orman-meyveli-pasta-b18b.jpg',sayi:'3', id: 3 },
  //   { title:'Köstebek Pasta',resim:'http://i2.hurimg.com/i/hurriyet/75/1500x844/5c05137f0f25441c904134c7.jpg',sayi:'3', id: 4 },
  //   { title:'Meyveli Pasta',resim:'https://cdn.yemek.com/mnresize/940/940/uploads/2017/02/meyveli-pasta.jpg',sayi:'2', id: 5 },
  //   {  title:'Elmas Kurabiye',resim:'https://cdn.yemek.com/mncrop/313/280/uploads/2018/12/elmas-kurabiye-yemekcom.jpg',sayi:'1', id: 6 }
  // ];


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


})
.controller('homepageCtrl', function($scope, $http, $rootScope){
  $scope.quotes = [
    {
        value: " Ne kadar çok kahve içersen o kadar çok kazanırsın. Üye ol bence."
    },
    {
        value: " merhaba,hediye kahve kazanmak için üye olun"
    }
  ];
  $scope.randomQuote = Math.floor(Math.random() * $scope.quotes.length);
  console.log($scope.randomQuote);
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
.controller ('profilCtrl', function($scope){

})
;

