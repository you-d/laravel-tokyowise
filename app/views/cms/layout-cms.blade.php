<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="_token" content="{{ csrf_token() }}"/>
	<title>[CMS] TOKYOWISE - Yudiman's Laravel Demo</title>
	{{ HTML::style('css/reset.css'); }}
	{{ HTML::style('css/style.css'); }}
	{{ HTML::style('jquery-bxslider/jquery.bxslider.css'); }}
	{{ HTML::style('jquery-ui-1114/jquery-ui.min.css'); }}
	{{ HTML::script('jwplayer/jwplayer.js'); }}
	<script type="text/javascript">jwplayer.key="jsV0xZdfwdvabHVZAuCcS5ZwuBE2+tpVCGC4Ww==";</script>
</head>
<body>
	<div id="container">
		<!-- header -->
		<header id="header">
			<div id="logout-link-box">
				<a href="">Logout</a>
			</div>
			<h1>
				<a href="{{ url() }}/cms">
					{{ HTML::image('images/logo.png', 'TOKYOWISE') }}
				</a>
			</h1>
		</header>
		<!-- main nav -->
		@include('cms/menu-cms')
		<!-- contents -->
		@yield('content-cms')
		<!-- footer -->
		<footer id="footer">
			<section>
				<h1>
					<a href="{{ url() }}/cms">
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
					<li><a href="{{ url() }}/cms">HOME</a></li>
					<li><a href="{{ url() }}/cms/about_tokyowise">ABOUT TOKYOWISE</a></li>
					<li><a href="{{ url() }}/cms/howto">HOW TO</a></li>
					<li><a href="{{ url() }}/cms/site_policy">SITE POLICY</a></li>
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
	{{ HTML::script('jquery-ui-1114/jquery-ui.min.js'); }}
	{{ HTML::script('jquery-bxslider/jquery.bxslider.min.js'); }}
	{{ HTML::script('js/dropzone.js'); }}
	{{ HTML::script('js/base.js'); }}
	{{ HTML::script('js/cms.js'); }}
</body>
</html>
