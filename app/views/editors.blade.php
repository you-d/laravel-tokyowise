@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/home">Home</a>
		>
		<a href="/editors">Editor&#39;s Eyes</a>
	</nav>
</section>
<!-- editors contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('editors-first-col')
	<!-- 2nd Column -->
	@include('editors-second-col')
</article>
@stop