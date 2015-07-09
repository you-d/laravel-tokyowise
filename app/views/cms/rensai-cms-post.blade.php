@extends('cms/layout-cms')
@section('content-cms')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="{{ url() }}/cms/home">Home</a>
		>
		<a href="{{ url() }}/cms/rensai">Ren-Sai</a>
		>
		<a href="{{ url() }}/cms/rensai/{{ $rensaiPost->category_id }}">{{ $rensaiPost->category_name }}</a>
		>
		<a href="{{ url() }}/cms/rensai/{{ $rensaiPost->category_id }}/{{ $rensaiPost->post_id }}">
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
