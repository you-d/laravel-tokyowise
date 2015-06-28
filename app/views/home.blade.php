@extends('layout')
@section('content')
<article role="main" id="main">
	<div id="main-body">
		<!-- Headline Header Image - PC Only -->
		<a href="/features">
			<div id="headline-header-image"> 
				{{ HTML::image('images/home/' . $wideHeaderImg) }}
			</div>
		</a>
		<!-- 1st column -->
		@include('home-first-col')
		<!-- 2nd column -->
		@include('home-second-col')
	</div>
	<!-- 3rd column -->	
	@include('module-gadgets')
</article>
@stop