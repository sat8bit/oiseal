'use strict';

var oisealControllers = angular.module('oisealControllers', ['ngYolp', 'ngOiseal']);

oisealControllers.controller('HeaderCtrl', ['$scope', 'Global',
  function($scope, Global) {
    $scope.global = Global;
  }
]);

oisealControllers.controller('LoginCtrl', ['$scope', 'Login',
  function($scope, Login) {
    $scope.login = function() {
      Login.login('/');
    }
  }
]);


oisealControllers.controller('IndexCtrl', ['$scope', 'Login', 'Global', '$yolp', '$oiseal',
  function($scope, Login, Global, $yolp, $oiseal) {
    $scope.init = function() {
        Login.check();
    }

    $scope.modal = function(place) {
        var coords = place.Geometry.Coordinates.split(',');
console.log(place);
        $yolp.drawMap('ymap', parseFloat(coords[1]), parseFloat(coords[0]));
        $scope.currentPlace = place;
    }

    $scope.postSeal = function() {
        $oiseal.post(Global.auth.accessToken, $scope.currentPlace.Property.Uid,
        function(data) {
            alert('Good !');
        },
        function(data, status) {
            console.log('error:' + status);
            console.log(data);
        });
    }

    $scope.searchPlaceByGeo = function() {
      navigator.geolocation.getCurrentPosition(
        // success
        function(position) {
          $yolp.localSearchByGeo(
            position.coords.latitude,
            position.coords.longitude,
            0,
            function(data) {
              $scope.places = data.Feature;
            },
            function(data, status) {
              console.log('error:' + status);
            }
          );
        },
        // error
        function(error) {
          console.log(error);
        }
      );
    }
  }
]);

oisealControllers.controller('HistoryCtrl', ['$scope', 'Login', 'Global', '$oiseal', '$yolp',
  function($scope, Login, Global, $oiseal, $yolp) {
    $scope.init = function() {
        Login.check($scope.load);
    }

    $scope.load = function() {
      $oiseal.get(Global.auth.accessToken,
        function(data) {
          $scope.seals = data;
        },
        function(data, status) {
          console.log('error:' + status);
          console.log(data);
        }
      );
    }

    $scope.modal = function(seal) {
        $yolp.drawMap('ymap', parseFloat(seal.latitude), parseFloat(seal.longitude));
        $scope.currentSeal = seal;
    }
  }
]);
