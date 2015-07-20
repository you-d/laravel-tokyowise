/* Home Module */
var homeModule = angular.module('homeModule', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');

        // Default state.
        $("#test-2-container").css("display", "none");
});

/* Home Module - Controllers */
homeModule.controller('homeModuleController', function($scope) {
  $scope.selectTest1 = function() {
      $(".test1-nav-btn").addClass("active");
      $(".test2-nav-btn").removeClass("active");

      $("#test-1-container").css("display", "block");
      $("#test-2-container").css("display", "none");
  }
  $scope.selectTest2 = function() {
      $(".test1-nav-btn").removeClass("active");
      $(".test2-nav-btn").addClass("active");

      $("#test-1-container").css("display", "none");
      $("#test-2-container").css("display", "block");
  }
});
