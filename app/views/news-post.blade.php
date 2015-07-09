@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="{{ url() }}/home">Home</a>
		>
		<a href="{{ url() }}/news">News</a>
		>
		<a href="{{ url() }}/news/{{ $newsPost->id }}">{{ $newsPost->post_title }}</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('news-post-first-col')
	<!-- 2nd Column -->
	@include('news-second-col')
</article>
@stop
