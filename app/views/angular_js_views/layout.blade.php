<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AngularJS Test App</title>
	{{ HTML::style('css/reset.css'); }}
	{{ HTML::style('css/bootstrap.min.css'); }}
	{{ HTML::style('http://fonts.googleapis.com/css?family=Anonymous+Pro:700,400&subset=latin,latin-ext'); }}
	{{ HTML::style('css/style-angularjs.css'); }}
</head>
<body>
	<!-- https://laracasts.com/discuss/channels/general-discussion/which-way-to-integrate-with-laravel-and-angularjs -->
	<!-- https://scotch.io/tutorials/single-page-apps-with-angularjs-routing-and-templating -->
  <div id="main">
      <section ng-app="homeModule" data:ng-controller="homeModuleController">
					<!-- fixed navbar (which is hidden until users scroll down the page) -->
					<nav id="angularjs-test-fixed-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation">
							<div class="container">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
											<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
											</button>
											<a class="navbar-brand" href="#">AngularJS - Demo #1</a>
									</div>
									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="navbar-collapse collapse">
											<ul class="nav navbar-nav">
													<li class="test1-nav-btn active">
		                          <a data:ng-click="selectTest1()">[Test #1]</a>
		                      </li>
													<li class="test2-nav-btn">
		                          <a data:ng-click="selectTest2()">[Test #2]</a>
		                      </li>
											</ul>
									</div>
							</div>
					</nav>
					<div class="container">
						<div class="masthead">
								<h3 class="text-muted">AngularJS - Demo #1</h3>
								<!-- justified navbar -->
								<nav>
										<ul class="nav nav-justified">
												<li class="test1-nav-btn active">
														<a data:ng-click="selectTest1()">[Test #1]</a>
												</li>
												<li class="test2-nav-btn">
														<a data:ng-click="selectTest2()">[Test #2]</a>
												</li>
										</ul>
								</nav>
						</div>
					</div>
			</section>
			<div class="container">
					<br><br>
          <!--
            A simple jQuery trick will capture the position of the div element
            below to trigger the showing of the fixed navbar.
          -->
          <div class="show-fixed-navbar-marker"></div>
          <!-- CONTENTS -->
          @yield('content-angularjs-test')
          </div>
    	</div>
    	{{ HTML::script('js/jquery-2.1.4.min.js'); }}
    	{{ HTML::script('js/angular.min.js'); }}
      {{ HTML::script('js/angular-resource.min.js'); }}
    	{{ HTML::script('js/bootstrap.min.js'); }}
    	{{ HTML::script('js/style-angularjs.js'); }}
			{{ HTML::script('angularjs-modules/homeModule.js'); }}
      {{ HTML::script('angularjs-modules/test1Module.js'); }}
      {{ HTML::script('angularjs-modules/test2Module.js'); }}
</body>
</html>
