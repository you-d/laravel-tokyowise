/* References : */
// Passing access token -> https://stackoverflow.com/questions/23303118/extracting-data-from-angularjs-resource
// promise? -> http://andyshora.com/promises-angularjs-explained-as-cartoon.html
// dealing with isArray = false -> https://groups.google.com/forum/#!topic/angular/PxL4bfrQKqM
// $resource returns promise & unresolved -> https://stackoverflow.com/questions/20008244/angularjs-using-resource-service-promise-is-not-resolved-by-get-request
// response error interceptors -> https://github.com/angular/angular.js/issues/4013

/* Test 2 Module */
var test2Module = angular.module('test2Module', ['ngResource']);

/* Test 2 Module - Config */
test2Module.config(function ($interpolateProvider, $httpProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

    $httpProvider.interceptors.push('GlobalErrorInterceptorService')
});

/* Test 2 Module - Constants */
test2Module.constant("BASE_API_URL", "http://localhost:8888/laravel-15/laravel-tokyowise/public/api/");
test2Module.constant("API_VERSION", "v1");
test2Module.constant("OAUTH_URL", "oauth2");

/* Test 2 Module - Controllers */
test2Module.controller('TokyowiseRensaiPageResourceController', function($rootScope, $scope, TokyowiseRensaiPageWebService) {
    // Request access token
    if (typeof $rootScope.access_token === 'undefined') {
        var promisedData = TokyowiseRensaiPageWebService.requestTokenClientCredentialGrant();
        promisedData.then(function(data) {
                            // promise fulfilled
                            $rootScope.access_token = data.data.access_token; // with $http, not $resource.

                            // Now, lets fetch the data...
                            // 1. All Rensai Category record
                            promisedData = TokyowiseRensaiPageWebService.getAllCategories(data.data.access_token);
                            promisedData.$promise.then(function(data) {
                                                        // promise fulfilled
                                                        $scope.rensaiCategories = data.thedata;
                                                        $scope.rensaiCategoriesIsAvailable = true;
                                                    }, function(error) {
                                                        // promise rejected
                                                        $scope.rensaiCategoriesIsAvailable = false;
                                                    });
                            // 2. All Rensai Post record
                            promisedData = TokyowiseRensaiPageWebService.getAllPosts(data.data.access_token);
                            promisedData.$promise.then(function(data) {
                                                        // promise fulfilled
                                                        $scope.rensaiPosts = data.thedata;
                                                        $scope.rensaiPostsIsAvailable = true;
                                                    }, function(error) {
                                                        // promise rejected
                                                        $scope.rensaiPostsIsAvailable = false;
                                                    });
                            // 3. A Single Category record
                            promisedData = TokyowiseRensaiPageWebService.getSingleCategory(data.data.access_token, 3);
                            promisedData.$promise.then(function(data) {
                                                        // promise fulfilled
                                                        if (data.thedata != null) {
                                                            $scope.aRensaiCategoryIsAvailable = true;
                                                            $scope.aRensaiCategory = data.thedata;
                                                        } else {
                                                            $scope.aRensaiCategoryIsAvailable = false;
                                                        }
                                                    }, function(error) {
                                                        // promise rejected
                                                        $scope.aRensaiCategoryIsAvailable = false;
                                                    });
                        }, function(error) {
                            // promise rejected
                            $scope.rensaiCategoriesIsAvailable = false;
                            $scope.rensaiPostsIsAvailable = false;
                            $scope.aRensaiCategoryIsAvailable = false;
                        });
    }
    /*
    // All Rensai Category record
    promisedData = TokyowiseRensaiPageWebService.getAllCategories($rootScope.access_token);
    promisedData.$promise.then(function(data) {
                                // promise fulfilled
                                $scope.rensaiCategories = data.thedata;
                                $scope.rensaiCategoriesIsAvailable = true;
                            }, function(error) {
                                // promise rejected
                                $scope.rensaiCategoriesIsAvailable = false;
                            });
    // All Rensai Post record
    promisedData = TokyowiseRensaiPageWebService.getAllPosts($rootScope.access_token);
    promisedData.$promise.then(function(data) {
                                // promise fulfilled
                                $scope.rensaiPosts = data.thedata;
                                $scope.rensaiPostsIsAvailable = true;
                            }, function(error) {
                                // promise rejected
                                $scope.rensaiPostsIsAvailable = false;
                            });
    // A Single Category record
    promisedData = TokyowiseRensaiPageWebService.getSingleCategory($rootScope.access_token, 3);
    promisedData.$promise.then(function(data) {
                                // promise fulfilled
                                if (data.category != null) {
                                    $scope.aRensaiCategoryIsAvailable = true;
                                    $scope.aRensaiCategory = data.thedata;
                                } else {
                                    $scope.aRensaiCategoryIsAvailable = false;
                                }
                            }, function(error) {
                                // promise rejected
                                $scope.aRensaiCategoryIsAvailable = false;
                            }); */
});

/* Test 2 Module - Services */
// https://stackoverflow.com/questions/27124071/invalid-request-in-angularjs-with-laravel-oauth
test2Module.factory('TokyowiseRensaiPageWebService',
                    ['$resource', '$http', '$rootScope', 'BASE_API_URL', 'API_VERSION', 'OAUTH_URL',
                     'Base64Service', 'LocalErrorInterceptorService',
                    function($resource, $http, $rootScope, BASE_API_URL, API_VERSION, OAUTH_URL,
                             Base64Service, LocalErrorInterceptorService) {
    var rensaiPageSvc = {};
    rensaiPageSvc.requestTokenClientCredentialGrant = function() {
        // Note : The main reason why we shouldn't use angularJS to do API endpoint authorisation.
        // Its Javascript!
        var oAuthUrl = BASE_API_URL + OAUTH_URL;
        var consumerKey = encodeURIComponent('1');
        var consumerSecret = encodeURIComponent('ssshdonttellanybody');
        var credentials = Base64Service.base64Encode(consumerKey + ':' + consumerSecret);

        // Tokyowise OAuth service endpoint
        return $http.post(oAuthUrl,
                          "grant_type=client_credentials",
                          { headers: {'Authorization': 'Basic ' + credentials,
                                      'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'}
                          }
        );
    }
    rensaiPageSvc.getAllCategories = function($accessToken) {
        var allCategoriesEndpoint = BASE_API_URL + API_VERSION + "/rensai/categories";
        var RensaiCategories = $resource(allCategoriesEndpoint, {}, {
                                  'query': { method: "GET",
                                             headers: {'Authorization': 'Bearer ' + $accessToken },
                                             interceptor: LocalErrorInterceptorService,
                                             isArray: false }
                               });
        return RensaiCategories.query();
    }
    rensaiPageSvc.getAllPosts = function($accessToken) {
        var allPostsEndpoint = BASE_API_URL + API_VERSION + "/rensai/posts";
        var RensaiPosts = $resource(allPostsEndpoint, {}, {
                              'query': { method: "GET",
                                         headers: {'Authorization': 'Bearer ' + $accessToken },
                                         interceptor: LocalErrorInterceptorService,
                                         isArray: false}
                          });
        return RensaiPosts.query();
    }
    rensaiPageSvc.getSingleCategory = function($accessToken, $categoryId) {
        var singleCategoryEndpoint = BASE_API_URL + API_VERSION + "/rensai/categories/:categoryId";
        var RensaiCategory = $resource(singleCategoryEndpoint, {categoryId: $categoryId}, {
                                'query': { method: "GET",
                                           headers: {'Authorization': 'Bearer ' + $accessToken },
                                           interceptor: LocalErrorInterceptorService,
                                           isArray: false}
                             });
        return RensaiCategory.query();
    }

    return rensaiPageSvc;
}]);

/* Test 2 Module - Defining 2 response error interceptors */
// Global
test2Module.factory("GlobalErrorInterceptorService", function($q) {
    return {
        'responseError': function(r) {
            console.log("global error interceptor " + r.status);
            return $q.reject(r);
        }
    }
});
// Local
test2Module.factory("LocalErrorInterceptorService", function($q) {
    return {
        'responseError': function(r) {
            console.log("local error interceptor " + r.status);
            return $q.reject(r);
        }
    }
});

/* Test 2 Module - Util functions */
test2Module.factory("Base64Service", function() {
    // Create Base64 Object
    // Ref : https://stackoverflow.com/questions/3774622/how-to-base64-encode-inside-of-javascript
    var Base64 = {
        // private property
        _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

        // public method for encoding
        encode : function (input) {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;
            input = Base64._utf8_encode(input);
            while (i < input.length) {
                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);
                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;
                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }
                output = output +
                         this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                         this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
            }
            return output;
        },
        // public method for decoding
        decode : function (input) {
            var output = "";
            var chr1, chr2, chr3;
            var enc1, enc2, enc3, enc4;
            var i = 0;
            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
            while (i < input.length) {
                enc1 = this._keyStr.indexOf(input.charAt(i++));
                enc2 = this._keyStr.indexOf(input.charAt(i++));
                enc3 = this._keyStr.indexOf(input.charAt(i++));
                enc4 = this._keyStr.indexOf(input.charAt(i++));
                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;
                output = output + String.fromCharCode(chr1);
                if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                }
            }
            output = Base64._utf8_decode(output);
            return output;
        },
        // private method for UTF-8 encoding
        _utf8_encode : function (string) {
            string = string.replace(/\r\n/g,"\n");
            var utftext = "";
            for (var n = 0; n < string.length; n++) {
                var c = string.charCodeAt(n);
                if (c < 128) {
                    utftext += String.fromCharCode(c);
                }
                else if((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
                else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
            }
            return utftext;
        },
        // private method for UTF-8 decoding
        _utf8_decode : function (utftext) {
            var string = "";
            var i = 0;
            var c = c1 = c2 = 0;
            while ( i < utftext.length ) {
                c = utftext.charCodeAt(i);
                if (c < 128) {
                    string += String.fromCharCode(c);
                    i++;
                }
                else if((c > 191) && (c < 224)) {
                    c2 = utftext.charCodeAt(i+1);
                    string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                    i += 2;
                }
                else {
                    c2 = utftext.charCodeAt(i+1);
                    c3 = utftext.charCodeAt(i+2);
                    string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    i += 3;
                }
            }
            return string;
        }
    }
    // The Service
    var base64Svc = {};
    base64Svc.base64Encode = function(input) {
        return Base64.encode(input);
    }
    base64Svc.base64Decode = function(input) {
        return Base64.decode(input);
    }

    return base64Svc;
});
