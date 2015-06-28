@extends('cms/layout-cms')
@section('content-cms')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/cms/home">Home</a>
		>
		<a href="/cms/rensai">Ren-Sai</a>
		>
		<a href="/cms/rensai/{{ $rensaiPost->category_id }}">{{ $rensaiPost->category_name }}</a>
		>
		<a href="/cms/rensai/{{ $rensaiPost->category_id }}/{{ $rensaiPost->post_id }}">
			{{ $rensaiPost->post_title }}
		</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('cms/rensai-cms-post-first-col')
	<!-- 2nd Column -->
	@include('cms/rensai-cms-second-col')
</article>
@stop