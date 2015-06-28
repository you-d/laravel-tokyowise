@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/home">Home</a>
		>
		<a href="/rensai">Ren-Sai</a>
		>
		<a href="/rensai/{{ $rensaiPost->category_id }}">{{ $rensaiPost->category_name }}</a>
		>
		<a href="/rensai/{{ $rensaiPost->category_id }}/{{ $rensaiPost->post_id }}">
			{{ $rensaiPost->post_title }}
		</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('rensai-post-first-col')
	<!-- 2nd Column -->
	@include('rensai-second-col')
</article>
@stop