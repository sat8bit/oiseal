'use strict';

// init
var oisealApp = angular.module('oisealApp', [
    'ngRoute',
    'ngFacebook',
    'ngYolp',
    'oisealControllers'
]);

oisealApp
.config(function($routeProvider) {
    $routeProvider.
      when("/login", {
        templateUrl: "/partials/login.html",
        controller: "LoginCtrl" 
      }).
      when("/history", {
        templateUrl: "/partials/history.html",
        controller: "HistoryCtrl" 
      }).
      when("/", {
        templateUrl: "/partials/index.html",
        controller: "IndexCtrl" 
      }).
      otherwise({redirectTo: '/'});
})
.config(function($facebookProvider) {
  $facebookProvider.setAppId(_facebookAppId);
  $facebookProvider.setPermissions('public_profile');
  $facebookProvider.setCustomInit({
    xfbml      : true,
    version    : 'v2.1'
  });
})
.config(function($yolpProvider) {
  $yolpProvider.setAppId(_yjdnAppId);
})
.run(function($rootScope) {
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
});

oisealApp.factory("Login", ['$facebook', '$location', 'Global',
  function($facebook, $location, Global) {
    return {
      login : function(whenIn) {
        $facebook.login().then(
          function(response) {
            if (response.status == 'connected') {
              Global.auth = response.authResponse;
              $facebook.api("/me").then( 
                function(response) {
                  Global.me = response;
                }
              );
              $location.url(whenIn);
            }
          },
          function(error) {
          }
        )
      },
      check: function(callback) {
        $facebook.getLoginStatus().then(
          function(response) {
            if (response.status != 'connected') {
              $location.url('login');
            }

            Global.auth = response.authResponse;
            $facebook.api("/me").then( 
              function(response) {
                Global.me = response;
                if (callback) {
                  callback();
                }
              }
            );
          },
          function(error) {
            $location.url('login');
          }
        )
      }
    }
  }
]);

oisealApp.factory("Global", function() {
  return {};
});
