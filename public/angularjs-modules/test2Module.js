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
test2Module.constant("BASE_API_URL", "http://localhost:8888/laravel-15/laravel-tokyowise/public/api/v1");

/* Test 2 Module - Controllers */
test2Module.controller('TokyowiseRensaiPageResourceController', function($scope, TokyowiseRensaiPageWebService) {
    // All Rensai Category record
    var promisedData = TokyowiseRensaiPageWebService.getAllCategories();
    promisedData.$promise.then(function(data) {
                                // promise fulfilled
                                $scope.rensaiCategories = data.categories;
                                $scope.rensaiCategoriesIsAvailable = true;
                            }, function(error) {
                                // promise rejected
                                $scope.rensaiCategoriesIsAvailable = false;
                            });
    // All Rensai Post record
    promisedData = TokyowiseRensaiPageWebService.getAllPosts();
    promisedData.$promise.then(function(data) {
                                // promise fulfilled
                                $scope.rensaiPosts = data.posts;
                                $scope.rensaiPostsIsAvailable = true;
                            }, function(error) {
                                // promise rejected
                                $scope.rensaiPostsIsAvailable = false;
                            });
    // A Single Category record
    promisedData = TokyowiseRensaiPageWebService.getSingleCategory(3);
    promisedData.$promise.then(function(data) {
                                // promise fulfilled
                                if (data.category != null) {
                                    $scope.aRensaiCategoryIsAvailable = true;
                                    $scope.aRensaiCategory = data.category;
                                } else {
                                    $scope.aRensaiCategoryIsAvailable = false;
                                }
                            }, function(error) {
                                // promise rejected
                                $scope.aRensaiCategoryIsAvailable = false;
                            });
});

/* Test 2 Module - Services */
test2Module.factory('TokyowiseRensaiPageWebService', ['$resource', 'BASE_API_URL', 'LocalErrorInterceptorService',
                    function($resource, BASE_API_URL, LocalErrorInterceptorService) {
    var rensaiPageSvc = {};

    rensaiPageSvc.getAllCategories = function() {
        var allCategoriesEndpoint = BASE_API_URL + "/rensai/categories";
        var RensaiCategories = $resource(allCategoriesEndpoint, {}, {
                                  'query': {method: "GET", interceptor: LocalErrorInterceptorService, isArray: false}
                               });
        return RensaiCategories.query();
    }
    rensaiPageSvc.getAllPosts = function() {
        var allPostsEndpoint = BASE_API_URL + "/rensai/posts";
        var RensaiPosts = $resource(allPostsEndpoint, {}, {
                              'query': {method: "GET", interceptor: LocalErrorInterceptorService, isArray: false}
                          });
        return RensaiPosts.query();
    }
    rensaiPageSvc.getSingleCategory = function($categoryId) {
        var singleCategoryEndpoint = BASE_API_URL + "/rensai/categories/:categoryId";
        var RensaiCategory = $resource(singleCategoryEndpoint, {categoryId: $categoryId}, {
                                'query': {method: "GET", interceptor: LocalErrorInterceptorService, isArray: false}
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
