@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/home">Home</a>
		>
		<a href="/features">Features</a>
		>
		<a href="/features/{{ $featurePost->post_id }}">{{ $featureCategory->category_name }} > {{ $featurePost->post_title }}</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('features-post-first-col')
	<!-- 2nd Column -->
	@include('features-second-col')
</article>
@stop