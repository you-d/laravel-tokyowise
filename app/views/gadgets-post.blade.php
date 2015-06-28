@extends('layout')
@section('content')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/home">Home</a>
		>
		<a href="/gadgets">Gadgets</a>
		>
		<a href="/gadgets/no{{ $gadgetPost->id }}">{{ str_replace("<br>"," ",$gadgetPost->post_title) }}</a>
	</nav>
</section>
<!-- editors contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('gadgets-post-first-col')
	<!-- 2nd Column -->
	@include('gadgets-second-col')
</article>
@stop