@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="{{ url() }}/home">Home</a>
		>
		<a href="{{ url() }}/rensai">Ren-Sai</a>
		>
		<a href="{{ url() }}/{{ $rensaiCategory->id }}">{{ $rensaiCategory->category_name }}</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('rensai-category-first-col')
	<!-- 2nd Column -->
	@include('rensai-second-col')
</article>
@stop
