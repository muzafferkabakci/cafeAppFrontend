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

              console.log("Gelen Data User:"+$scope.userbilgi);


                //-ac-//console.log("n-10 gonderiliyor ..: " +  JSON.stringify(user));
               //-ac-//console.log("Token stored, device is successfully subscribed to receive push notifications.");
            })
            .error(function (data, status) {
               console.log("Hata Data"+data);
               //-ac-//console.log("Error storing device token." + data + " " + status)
                  //-ac-//console.log("n-11");
            });

};


  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //$scope.$on('$ionicView.enter', function(e) {
  //});

  //ileri seviye proje
  // Form data for the login modal
  // Form data for the login modal
  $scope.loginData = {};

  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });
  $scope.sifremiUnuttumAc = function(){
    console.log('deneme');
  }
  // Triggered in the login modal to close it
  $scope.closeLogin = function() {
    $scope.modal.hide();
  };

  // Open the login modal
  $scope.login = function() {
    $scope.modal.show();
  };

  // Perform the login action when the user submits the login form
  $scope.doLogin = function() {

$scope.loginData.service_type="login_user";

$scope.postService('userbilgi',$scope.loginData);

/*

    $http.post("http://gokhanbirkin.net/services2.php?service_type=login_user&username="+$scope.loginData.username+"&password_user="+$scope.loginData.password)
    .success(function(data){
      $rootScope.gelenUser = data[0];
      console.log(data);

    })
*/
    console.log("LoginData : "+$scope.loginData.username);
    console.log("PasswordData : "+$scope.loginData.password);


    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
  };
})

.controller('PlaylistsCtrl', function($scope,$rootScope, $http) {
  $scope.playlists = [
    { title: 'Elmalı Turta 14tl', resim:'https://i.pinimg.com/originals/e0/da/6e/e0da6e2493abf2817b524a8c1ec423e5.jpg',sayi:'2', id: 1 },
    { title: 'Çikolatalı Pasta',resim:'https://cdn03.ciceksepeti.com/cicek/kc522590-1/XL/cikolatali-cilekli-rulokat-pasta-kc522590-1-1.jpg',sayi:'1', id: 2 },
    { title:'Orman Meyveli Pasta',resim:'https://www.livashop.com/Uploads/UrunResimleri/buyuk/orman-meyveli-pasta-b18b.jpg',sayi:'3', id: 3 },
    { title:'Köstebek Pasta',resim:'http://i2.hurimg.com/i/hurriyet/75/1500x844/5c05137f0f25441c904134c7.jpg',sayi:'3', id: 4 },
    { title:'Meyveli Pasta',resim:'https://cdn.yemek.com/mnresize/940/940/uploads/2017/02/meyveli-pasta.jpg',sayi:'2', id: 5 },
    {  title:'Elmas Kurabiye',resim:'https://cdn.yemek.com/mncrop/313/280/uploads/2018/12/elmas-kurabiye-yemekcom.jpg',sayi:'1', id: 6 },

  ];

  $scope.kahveler = [
  { kahve:'3', id: 1 }
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

.controller('SearchCtrl',function($scope, $http){


});
