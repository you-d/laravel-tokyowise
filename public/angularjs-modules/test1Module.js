/* Test 1 Module */
var test1Module = angular.module('test1Module', ['homeModule'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
});

/* Test 1 Module - Controllers */
test1Module.controller('test1Controller', function($scope) {
    var employees = ['Catherine Grant', 'Monica Grant',
                     'Christopher Grant', 'Jennifer Grant'
                    ];
    $scope.ourEmployees = employees;

    // Hide colours by default
    $scope.isHiddenFlag = true;
    // A function, placed into the scope, which can toggle the value of the
    // isHiddenFlag variable
    $scope.showHideColours = function() {
        $scope.isHiddenFlag = !$scope.isHiddenFlag;
    }
});
test1Module.controller('test1bController', function($scope) {
    $scope.coloursArray = ['red', 'green', 'blue', 'purple', 'olive']
});
test1Module.controller('test1cController', function($scope, $window, $location, $document) {
    $scope.url = $location.absUrl();
    $scope.protocol = $location.protocol();
    $scope.host = $location.host();
    $scope.port = $location.port();
    $scope.docTitle = $document[0].title;
    $scope.winWidth = $window.innerWidth;
});
test1Module.controller('test1dController', function($scope, Test1DateTimeService){
    $scope.theDate = Test1DateTimeService.getDate();
    $scope.theTime = Test1DateTimeService.getTime();
});

/* Test 1 Module - Custom Directives */
test1Module.directive("customColourList1Directive", function() {
    return {
        restrict: 'AE', // A : <span test1-colour-list></span> , E : <test1-colour-list></test1-colour-list>
        template: "<button data:ng-click='showHideColours()' type='button'>" +
                  "<% isHiddenFlag ? 'Show Available Colours' : 'Hide Available Colours' %>" +
                  "</button>" +
                  "<div ng-hide='isHiddenFlag' id='colourContainer'></div>",
        link: function($scope, $element) {
          // Hide colours by default
          $scope.isHiddenFlag = true;
          // A function, placed into the scope, which can toggle the value of the
          // isHiddenFlag variable
          $scope.showHideColours = function() {
              $scope.isHiddenFlag = !$scope.isHiddenFlag;
          }
          // DOM Manipulation
          var colourContainer = $element.find("div#colourContainer");
          angular.forEach($scope.coloursArray, function (availColour) {
              var appendString = "<div>" + availColour + "</div>";
              colourContainer.append(appendString);
          });
        }
    };
});

/* Test 1 Module - Services */
test1Module.factory('Test1DateTimeService', function() {
    var dateTimeSvc = {};
    dateTimeSvc.getDate = function () {
        return new Date().toDateString();
    }
    dateTimeSvc.getTime = function () {
        return new Date().toTimeString();
    }
    return dateTimeSvc;
});

/* Test 1 Module - Bootstrap this module to enable a single page to have multiple ng-app */
angular.bootstrap(document.getElementById("test-1-container"),["test1Module"]);
