'use strict';

angular.module('ngOiseal', [], function($provide) {
    $provide.factory('$oiseal', function($http) {
        return  {
            'post': function(access_token, place_id, success, error) {
                $http.post(
                    '/apis/v1/seals',
                    {
                        access_token: access_token,
                        place_id: place_id
                    }
                )
                .success(success)
                .error(error);
            },
            'get': function(access_token, success, error) {
                $http.get(
                    '/apis/v1/seals',
                    {
                        params : {
                            access_token: access_token
                        }
                    }
                )
                .success(success)
                .error(error);
            }
        };
    });
});
