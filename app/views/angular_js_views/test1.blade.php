<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <title>AngularJS Test 1 App</title>
	{{ HTML::style('css/reset.css'); }}
	{{ HTML::style('css/style-angularjs.css'); }}
	<link href='http://fonts.googleapis.com/css?family=Anonymous+Pro:700,400&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>
	<!-- 1st Test Module -->
	<div id="test-1-container" ng-app="test1Module">
		  <div data:ng-controller="test1Controller">
					Hello, World! <% 5 + 3 %>
					<p>Number of Employees: <% ourEmployees.length %></p>
					<span data:ng-bind="ourEmployees.length"></span>
					<hr>
					<button data:ng-click="showHideColours()" type="button">
							<% isHiddenFlag ? 'Show Available Colours' : 'Hide Available Colours' %>
					</button>
					<div id="red" data:ng-hide="isHiddenFlag">Red</div>
					<div id="green" data:ng-hide="isHiddenFlag">Green</div>
					<div id="blue" data:ng-hide="isHiddenFlag">Blue</div>
			</div>
			<hr>
			<div data:ng-controller="test1bController">
					<span data:custom-colour-list-1-directive></span>
			</div>
			<hr>
			<div data:ng-controller="test1cController">
					<p>The URL is: <% url %></p>
					<ul>
							<li data:ng-cloak><% protocol %></li>
							<li data:ng-cloak><% host %></li>
							<li data:ng-cloak><% port %></li>
							<li data:ng-cloak><% docTitle %></li>
							<li data:ng-cloak><% winWidth %></li>
					</ul>
			</div>
			<hr>
			<div data:ng-controller="test1dController">
					<p data:ng-cloak><% theDate %></p>
					<p data:ng-cloak><% theTime %></p>
			</div>
			<hr>
			<div data:ng-repeat="city in ['Liverpool','Perth','Sydney','Dublin','Paris']">
				<% $index %> . <% city %>
				<% $first ? '(This is the first row)' : '' %>
				<% $last ? '(This is the last row)' : '' %>
			</div>
	</div>
	{{ HTML::script('js/jquery-2.1.4.min.js'); }}
	{{ HTML::script('js/angular.min.js'); }}
	{{ HTML::script('angularjs-modules/test1Module.js'); }}
</body>
</html>
