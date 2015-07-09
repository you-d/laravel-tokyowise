@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="{{ url() }}/home">Home</a>
		>
		<a href="{{ url() }}/rensai">Ren-Sai</a>
		>
		<a href="{{ url() }}/rensai/{{ $rensaiPost->category_id }}">{{ $rensaiPost->category_name }}</a>
		>
		<a href="{{ url() }}/rensai/{{ $rensaiPost->category_id }}/{{ $rensaiPost->post_id }}">
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
