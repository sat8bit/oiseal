'use strict';

angular.module('ngYolp', [])
  .provider('$yolp', function() {
    var config = {
      appId:          null
    };

    this.setAppId = function(appId) {
      config.appId=appId;
      return this;
    };

    this.getAppId = function() {
      return config.appId;
    };

    this.$get = ['$q', '$http', function($q, $http) {
      var $yolp=$q.defer();

      $yolp.config = function(property) {
        return config[property];
      };

      $yolp.init = function() {
        if($yolp.config('appId')==null)
          throw "$yolpProvider: `appId` cannot be null";
      }

      $yolp.localSearchByGeo = function(lat, lon, start, success, error) {
        $http.jsonp(
          'http://search.olp.yahooapis.jp/OpenLocalPlatform/V1/localSearch',
          {
            params: {
              output  : 'json',
              callback: 'JSON_CALLBACK',
              appid   : $yolp.config('appId'),
              gc      : '01',
              lat     : lat,
              lon     : lon,
              sort    : 'geo',
              results : 20,
              start   : start
            }
          }
        )
        .success(success)
        .error(error);
      };

      $yolp.drawMap = function (id, lat, lon) {
        var ymap = new Y.Map(id);
        var p = new Y.LatLng(lat, lon);
        var marker = new Y.Marker(p);

        ymap.drawMap(p, 19, Y.LayerSetId.NORMAL);
        ymap.addFeature(marker);
      };

      return $yolp;
    }];
  })
  .run(['$yolp', function($yolp) {
    $yolp.init();
  }]);
;
