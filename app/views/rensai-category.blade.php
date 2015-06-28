@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/home">Home</a>
		>
		<a href="/rensai">Ren-Sai</a>
		>
		<a href="/{{ $rensaiCategory->id }}">{{ $rensaiCategory->category_name }}</a>
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