angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $timeout) {

  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //$scope.$on('$ionicView.enter', function(e) {
  //});

  // Form data for the login modal
  // Form data for the login modal
  $scope.loginData = {};

  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });

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
    console.log('Doing login', $scope.loginData);

    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
  };
})


.controller('PlaylistsCtrl', function($scope,$rootScope) {
  $scope.playlists = [
    { kahve:'2',title: 'Elmalı Turta 14tl', resim:'https://i.pinimg.com/originals/e0/da/6e/e0da6e2493abf2817b524a8c1ec423e5.jpg',sayi:'2', id: 1 },
    {  title: 'Çikolatalı Pasta',resim:'https://cdn03.ciceksepeti.com/cicek/kc522590-1/XL/cikolatali-cilekli-rulokat-pasta-kc522590-1-1.jpg',sayi:'1', id: 2 },
    { title:'Orman Meyveli Pasta',resim:'https://www.livashop.com/Uploads/UrunResimleri/buyuk/orman-meyveli-pasta-b18b.jpg',sayi:'3', id: 3 },
    { title:'Köstebek Pasta',resim:'http://i2.hurimg.com/i/hurriyet/75/1500x844/5c05137f0f25441c904134c7.jpg',sayi:'3', id: 4 },
    { title:'Meyveli Pasta',resim:'https://cdn.yemek.com/mnresize/940/940/uploads/2017/02/meyveli-pasta.jpg',sayi:'2', id: 5 },
    {  title:'Elmas Kurabiye',resim:'https://cdn.yemek.com/mncrop/313/280/uploads/2018/12/elmas-kurabiye-yemekcom.jpg',sayi:'1', id: 6 },
    
  ];

    $scope.kahveler = [
    { kahve:'3', id: 1 },
    
  ];

  $scope.subeler = [
    { title: 'Cevizlibağ Şubesi', resim:'http://www.cafelalinna.com/wp-content/uploads/2018/12/linna-bina07.jpg', id: 1 },
    { title: 'Bakırköy Şubesi', resim:'https://media-cdn.tripadvisor.com/media/photo-s/0c/0e/61/91/cafe-amore.jpg', id: 2 },
    { title: 'Taksim Şubesi', resim:'https://www.neyiyelim.com/UploadedGallary/NY_1206869259.jpg', id: 3},  
    { title: 'Üsküdar Şubesi', resim:'http://www.turkuazhaber.net/wp-content/uploads/2017/04/DSC_0934.jpg', id: 4 },

   
    
  ];





})

.controller('PlaylistCtrl', function($scope, $stateParams) {
});
