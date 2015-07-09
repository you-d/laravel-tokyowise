@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="{{ url() }}/home">Home</a>
		>
		<a href="{{ url() }}/features">Features</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('features-first-col')
	<!-- 2nd Column -->
	@include('features-second-col')
</article>
@stop
