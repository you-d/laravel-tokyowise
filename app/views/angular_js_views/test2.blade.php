<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <title>AngularJS Test 2 App</title>
	{{ HTML::style('css/reset.css'); }}
	{{ HTML::style('css/style-angularjs.css'); }}
	<link href='http://fonts.googleapis.com/css?family=Anonymous+Pro:700,400&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>
  <!-- 2nd Test Module -->
	<div id="test-2-container" ng-app="test2Module">
      <div data:ng-controller="TokyowiseRensaiPageResourceController">
          <h1>All Rensai Category Record</h1>
					<br>
          <div data:ng-repeat="rensaiCategory in rensaiCategories" data:ng-show="rensaiCategoriesIsAvailable">
              <div>
                  <span data:ng-bind="rensaiCategory.id"></span>
                  &nbsp;=>&nbsp;
                  <span data:ng-bind="rensaiCategory.group_desc"></span>
              </div>
          </div>
					<div data:ng-hide="rensaiCategoriesIsAvailable">
							N/A
					</div>
          <hr>
          <h1>All Rensai Post Record</h1>
					<br>
          <div data:ng-repeat="rensaiPost in rensaiPosts" data:ng-show="rensaiPostsIsAvailable">
              <div>
                  <span data:ng-bind="rensaiPost.id"></span>
                  &nbsp;=>&nbsp;
                  <span data:ng-bind="rensaiPost.post_title"></span>
              </div>
          </div>
					<div data:ng-hide="rensaiPostsIsAvailable">
							N/A
					</div>
          <hr>
          <h1>A Category Record</h1>
					<br>
					<div data:ng-show="aRensaiCategoryIsAvailable">
          		<span data:ng-bind="aRensaiCategory.id"></span>
							&nbsp;=>&nbsp;
							<span data:ng-bind="aRensaiCategory.group_desc"></span>
					</div>
					<div data:ng-hide="aRensaiCategoryIsAvailable">
							N/A
					</div>
			</div>
	</div>
  {{ HTML::script('js/jquery-2.1.4.min.js'); }}
  {{ HTML::script('js/angular.min.js'); }}
  {{ HTML::script('js/angular-resource.min.js'); }}
  {{ HTML::script('angularjs-modules/test2Module.js'); }}
</body>
</html>
