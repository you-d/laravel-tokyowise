<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TOKYOWISE - Yudiman's Laravel Demo</title>
	{{ HTML::style('css/reset.css'); }}
	{{ HTML::style('css/common.css'); }}
	{{ HTML::style('css/menu.css'); }}
	{{ HTML::style('css/styles.css'); }}
	{{ HTML::style('css/modules.css'); }}
	{{ HTML::style('jquery-bxslider/jquery.bxslider.css'); }}
</head>
<body>
	<div id="container">
		<!-- header -->
		<header id="header">
			@if (Sentry::check())
			<div id="logout-link-box">
				<a href="">Logout</a>
			</div>
			@else
			<div id="login-link-box">
				<a href="login">CMS Login</a>
			</div>
			@endif
			<h1>
				<a href="{{ url() }}">
					{{ HTML::image('images/logo.png', 'TOKYOWISE') }}
				</a>
			</h1>
		</header>
		<!-- main nav -->
		@include('menu')
		<!-- contents -->
		@yield('content')
		<!-- footer -->
		<footer id="footer">
			<section>
				<h1>
					<a href="{{ url() }}">
						{{ HTML::image('images/logo.png', 'TOKYOWISE') }}
					</a>
				</h1>
				<div id="sns_block">
					<a href="#" target="_blank">
						{{ HTML::image('images/sns_t.png', 'twitter') }}
					</a>
					&nbsp;&nbsp;
					<a href="#" target="_blank">
						{{ HTML::image('images/sns_f.png', 'facebook') }}
					</a>
				</div>
				<ul>
					<li><a href="{{ url() }}">HOME</a></li>
					<li><a href="/about_tokyowise">ABOUT TOKYOWISE</a></li>
					<li><a href="/site_policy">SITE POLICY</a></li>
				</ul>
				<p><small>&#64;PARAGRAPH. ALL RIGHTS RESERVED</small></p>
			</section>
		</footer>
		<!-- Top Page Button -->
		<p id="top-page-btn">
			<a href="">
				{{ HTML::image('images/pagetop.png', 'Page Top Btn') }}
			</a>
		</p>
	</div>
	{{ HTML::script('js/jquery-2.1.4.min.js'); }}
	{{ HTML::script('jquery-bxslider/jquery.bxslider.min.js'); }}
	{{ HTML::script('js/base.js'); }}
</body>
</html>
