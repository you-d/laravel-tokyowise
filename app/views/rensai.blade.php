@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/home">Home</a>
		>
		<a href="/rensai">Ren-Sai</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('rensai-first-col')
	<!-- 2nd Column -->
	@include('rensai-second-col')
</article>
@stop