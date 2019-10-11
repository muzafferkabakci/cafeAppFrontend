angular.module('starter.controllers', [])

  .controller('AppCtrl', function ($parse, $scope, $ionicModal, $timeout, $http, $rootScope, $ionicLoading, $state, $ionicHistory) {


    $scope.dinamikScope = function (name, data) { //2 parametre alıyor
      var modelScope = $parse(name); // name ismi parse ediliyor.
      modelScope.assign($rootScope, data);

    };

    $scope.serviceLink = "http://projeapp.site/cafe/services.php";

    $scope.postService = function (scopeName, sentData) {

      return $http.post($scope.serviceLink, sentData)
        .then(function (response) {
          var data = response.data;
          console.log("Fetched data: " + data);
          $scope.dinamikScope(scopeName, data);
          return response.data;
        })
        .catch(function (response) {
          var errData = response.data;
          console.log("Error: " + errData);
          throw response;
        });
    };
    $scope.loginData = {};
    $ionicModal.fromTemplateUrl('templates/login.html', {
      scope: $scope
    }).then(function (modal) {
      $scope.loginModal = modal;
    });
    $scope.closeLogin = function () {
      $scope.loginModal.hide();
    };
    $scope.login = function () {
      $scope.loginModal.show();
    };
    $scope.doLogin = function () {
      $scope.loginDataJson = {
        service_type: 'login_user',
        username: $scope.loginData.username,
        password_user: $scope.loginData.password};
      var promise = $scope.postService("userInfo", $scope.loginDataJson);
      promise.then(function (data) {
        console.log("Ne geliyor ?", data);
        if ($rootScope.userInfo[0].name_user !== undefined) {
          console.log("ROOT SCOPE" + $rootScope.userInfo[0].name_user);
          localStorage.setItem('kullaniciBilgi', JSON.stringify($rootScope.userInfo[0]));
          //Localden çekilcek diğer sayfalardan yönlendireceğiz.
          $timeout(function () {
            $ionicHistory.nextViewOptions({
              disableBack: true
            });
            $state.go('app.playlists');
          }, 1000);
        } else {
          console.log("NUll GELDİ");
        }

      });

      $timeout(function () {
        $scope.closeLogin();
      }, 1000);
    };
////////////////////////////////////////// forgot password ////////////////////////////
    $ionicModal.fromTemplateUrl('templates/forgot.html', { //Sifremi unuttum sayfasını oluştruman gerek
      scope: $scope
    }).then(function (modal) {
      $scope.forgotModal = modal; // moda
    });
    $scope.sifremiUnuttumAc = function () { // burda o sayfayı açıyoruz
      console.log('deneme');
      $scope.forgotModal.show(); // Burda ekranda gösteriyoruz fakat kapatma olayını yazmadın aşağıdaki ile aynı
    };// bir tane kapatma butonu ekleyeceksin oluşturduğun sayfaya sonra sifremiUnuttumKapa diye fonksiyon yazacaksın
// $scope.forgotModal.hide() çalıştıracaksın eğer o butona tıklanırsa diye

// Triggered in the login modal to close it
    $scope.sifremiUnuttumKapa = function () {
      $scope.forgotModal.hide();
    };
    $scope.doForgot = function () {
      //console.log($scope.loginData.phoneNumber);
      // $scope.girdilerForgot = {
      //   service_type : 'forgot_password',
      //   phone_number : $scope.loginData.phoneNumber
      // }
      $scope.girdilerForgot = {};
      $scope.girdilerForgot.service_type = "forgot_password";
      $scope.girdilerForgot.phone_number = $scope.loginData.phoneNumber;
      console.log($scope.girdilerForgot);
      console.log("Promise oncesi");
      var promise = $scope.postService('forgotTel', $scope.girdilerForgot);
      console.log("Promise sonrası");
      promise.then(function (data) {
        console.log("data : ", data);

      });

      $scope.sifremiUnuttumKapa();
    };//Uygulamada çalışmıyor
//////////////////////////////////////////  Register Başlangıç       ///////////////////////////////////////////////////////////////////////

// Register modali oluşturuyoruz
    $ionicModal.fromTemplateUrl('templates/register.html', {
      scope: $scope
    }).then(function (modal) {
      $scope.registerModal = modal;
    });

//Tetiklendiğinde register modalini kapıyor
    $scope.closeRegister = function () {
      $scope.registerModal.hide();

    };

// Tetiklendiğinde register modalini açıyor
    $scope.register = function () {
      $scope.loginModal.hide();
      $scope.registerData = {};
      $scope.registerModal.show();
      $scope.dogrula = 0;
    };
    $scope.checkUser = function () {
      $scope.user = {};
      $scope.user.service_type = "user_varMi";
      $scope.user.username = $scope.registerData.username;
      var promise = $scope.postService('usernameKontrol', $scope.user);
      promise.then(function (data) {
        console.log($scope.usernameKontrol[0]);
        if($scope.usernameKontrol[0] =! 0 ){
          $scope.dogrula++;
          console.log("Doğrulama : ",$scope.dogrula);
        }
      });
    };
    $scope.checkMail = function () {
      $scope.user = {};
      $scope.user.service_type = "mail_varMi";
      $scope.user.email_address = $scope.registerData.email_address;
      var promise = $scope.postService('mailKontrol', $scope.user);
      promise.then(function (data) {
        console.log("data : ", data);
        console.log($scope.usernameKontrol[0]);
      });
    };
    $scope.checkPhone = function () {
      $scope.user = {};
      $scope.user.service_type = "tel_varMi";
      $scope.user.phone_number = $scope.registerData.phone_number;
      var promise = $scope.postService('telKontrol', $scope.user);
      promise.then(function (data) {
        //console.log("data : ",data);
        //console.log($scope.usernameKontrol[0]);
        if ($scope.usernameKontrol[0] === 1) {
          console.log("Telefon no var");
        }
      });
    };
    $scope.doRegister = function () {
      $scope.registerDataJson = {
        service_type: 'register_user',
        username: $scope.registerData.username,
        password_user: $scope.registerData.password_user,
        name_user: $scope.registerData.name_user,
        school: $scope.registerData.school,
        email_address: $scope.registerData.email_address,
        phone_number: $scope.registerData.phone_number,
        company_id: $scope.registerData.company_id
      };
      $scope.kayitMail = {
        service_type : 'kayitMail',
        email_address : $scope.registerData.email_address
      }
      $scope.postService('onayMail',$scope.kayitMail);
      $scope.postService('registerBilgi', $scope.registerDataJson);

      $timeout(function () {
        $scope.closeRegister();
      }, 2000);
    };


//////////////////////////////////////// Register End ////////////////////////////////////////////////////////////
    /**
     * Kayıt olunduktan sonra ekrana bir modal açılacak.
     * Eğer kayıt başarılıysa modalin fonksiyonuna ekrana yazılacak yazı , timeout süresi gönderilecek
     * Kayıt başarılı değil ise ekrana yazılacak yazı, timeout süresi=10000, butona basılınca çalışacak fonksiyonun adı gönderilecek
     *
     */

    $rootScope.showBarcode = function (productId) {
      //console.log('uyarı alanına geldi');
      $scope.productId = productId;
      $ionicLoading.show({
        templateUrl: 'templates/barkod.html'
      });
      $scope.gelenler = localStorage.getItem('kullaniciBilgi'); //LocalStorage'a attığımız bilgileri String olarak aldık
      $scope.tmp = angular.fromJson($scope.gelenler);

      $timeout(function () {
        $scope.barcodeText = "product_id: " + $scope.productId + "/user_id: " + $scope.tmp.user_id;
        $scope.a = new QRCode(document.getElementById("qrcode"), {
          text: $scope.barcodeText,
          width: 200,
          height: 200,
          colorDark: "#000000",
          colorLight: "#ffffff",
          correctLevel: QRCode.CorrectLevel.H
        });
        console.log($scope.barcodeText);
      }, 100);

    }; //$rootScope.showBarcode = function(productId) {

    $rootScope.hideBarcode = function () {
      $ionicLoading.hide();
    };

    $ionicModal.fromTemplateUrl('templates/bildiri.html', {
      scope: $scope
    }).then(function (modal) {
      $scope.bildiriModal = modal;
    });
    $scope.bildiriModalOpen = function (yazi, sure, fonk) {
      console.log("GİRDİ Mİ ?");
      $scope.yazi = yazi;//modal sayfasında kullanılacak yazı
      //console.log($scope.yazi);
      $scope.bildiriModal.show();
      if (fonk != null) {
        $scope.gelenFonk = fonk; //fonksiyonun ismini alıyoruz

        $scope.gelenFonk();
      }


      $timeout(function () {
        $scope.bildiriModalClose();
      }, sure);
    };
    $scope.bildiriModalClose = function () {
      $scope.bildiriModal.hide();

    }
  })


  .controller('PlaylistsCtrl', function ($scope, $rootScope, $state, $http) {

    if(localStorage.getItem('kulaniciBilgi') != null){ //Mantık yanlış gibi :D Ama böyle çalışıyor :D
      $state.go('app.homepage');
    }
    $scope.gelenler = localStorage.getItem('kullaniciBilgi'); //LocalStorage'a attığımız bilgileri String olarak aldık
    $scope.tmp = angular.fromJson($scope.gelenler);//String olan bilgileri JSON objesine dönüştürdük
    //console.log($scope.tmp);
    $scope.veriAl = {
      service_type: 'load_home',
      user_id: $scope.tmp.user_id
    };
    var promise = $scope.postService('tuketilenSayilar', $scope.veriAl);
    promise.then(function (data) {
      console.log("data : ", data);
      $rootScope.tutketilmeUzunluk = $rootScope.tuketilenSayilar.length;
      //console.log($scope.tuketilenSayilar[0].product_id +" : "+$scope.tuketilenSayilar[0].count%4);
    });



    function harmanla(urunler, tuketilmeler, playlistUzunluk, tutketilmeUzunluk) {
      // $rootScope.yeniArray = urunler.find(s=> s.product_id==2);
      // $rootScope.yeniArray.sayi = 5;
      // console.log($rootScope.yeniArray);
      console.log("Ürünlerin miktari", playlistUzunluk);
      console.log("Uzunluk = ", tutketilmeUzunluk);

      for (var j = 0; j < playlistUzunluk; j++) {
        for (var i = 0; i < tutketilmeUzunluk; i++) {
          if (urunler.find(s => s.product_id == tuketilmeler[i].product_id)) {
            $rootScope.yeniArray = urunler.find(s => s.product_id == tuketilmeler[i].product_id);
            if (tuketilmeler[i].count % 4 == 0 && tuketilmeler[i].count != 0) {
              $rootScope.yeniArray.sayi = 4;
            } else {
              $rootScope.yeniArray.sayi = tuketilmeler[i].count % 4;
            }

            console.log("Deneme : ", i, "\n ", $rootScope.yeniArray);
          } else {
            console.log("Eşit değil devam");
          }
        }


      }
    }

    $scope.playlistD = {
      service_type: 'get_productsKampanyali',
      branch_id: '1'
    };

    var promise = $scope.postService('playlists', $scope.playlistD);
    promise.then(function (data) {
      //console.log("2.data : ",data);
      //Bir fonksiyon tanımlanacak ve fonksiyon playlists'i ve tuketilenSayilar'ı alacak. Bunları product id'leri eşit olanlarla eşitleyip yeni JSON objesi oluşturacak.
      // $scope.yeniArray = $rootScope.playlists.find(s=> s.product_id==2);
      // $scope.yeniArray.sayi = 5;
      // //$rootScope.playlists.find(s=> s.product_id==2) = $scope.yeniArray;
      // console.log($scope.yeniArray);
      var playlistUzunluk = $rootScope.playlists.length;
      localStorage.setItem('kampanyaliUrunler', JSON.stringify($rootScope.playlists));
      $scope.gelenSayilar = localStorage.getItem('kampanyaliUrunler');
      console.log("Kampanyali ürünler",$scope.gelenSayilar);
      harmanla($rootScope.playlists, $rootScope.tuketilenSayilar, playlistUzunluk, $rootScope.tutketilmeUzunluk);
      //console.log("JSON'ın ilk elamanı ",$rootScope.playlists[0]);


      //console.log($rootScope.playlists.product_id);

    });

    $scope.kahveler = [
      {kahve: '3', id: 1}
    ];


  })

  .controller('PlaylistCtrl', function ($scope, $stateParams, $rootScope) {
  })

  .controller('SearchCtrl', function ($scope, $http, $rootScope) {
    $scope.playlistProduct = {
      service_type: 'get_products',
      branch_id: '1'
    };

    var promise = $scope.postService('urunler', $scope.playlistProduct);

    promise.then(function (data) {
      console.log(data);
      console.log($rootScope.urunler[0]);
      $scope.products = $rootScope.urunler[0];
    });
  })
  .controller('homepageCtrl', function ($scope, $http, $rootScope) {
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

    $scope.playlistProduct = {
      service_type: 'get_products',
      branch_id: '1'
    };

    var promise = $scope.postService('urunler', $scope.playlistProduct);

    promise.then(function (data) {
      console.log(data);
      console.log($rootScope.urunler[0]);
      $scope.products = $rootScope.urunler[0];
    });

  })
  .controller('profilCtrl', function ($scope, $state, $timeout,$ionicHistory,$rootScope) {
    $scope.user = JSON.parse(localStorage.getItem('kullaniciBilgi'));
    //urundenKactane
    console.log("Kullanıcı Bilgileri : ",$scope.user.username);

    $scope.urunSayisi = {
      service_type: 'urundenKactane',
      user_id: $scope.user.user_id
    };
    var promise = $scope.postService('urunler', $scope.urunSayisi);

    promise.then(function (data) {
      console.log(data);
      console.log($rootScope.urunler[0]);

    });
    if ($scope.user === null){
      $state.go('app.playlists');
    }
    $scope.doLogout = function(){
      localStorage.clear();
      $timeout(function () {

        $ionicHistory.nextViewOptions({
          disableBack: true
        });
        $state.go('app.homepage');
      }, 1000);
    };
  })
  .controller('SubeCtrl', function ($scope, $rootScope) {
    $scope.subeScope = {
      service_type: 'get_branches',
      company_id: '1'
    };

    var promise = $scope.postService('subeler', $scope.subeScope);

    promise.then(function (data) {
      console.log(data);
    });
  });

