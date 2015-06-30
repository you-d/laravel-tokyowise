@extends('cms/layout-cms')
@section('content-cms')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/cms/home">Home</a>
		>
		<a href="/cms/rensai">Ren-Sai</a>
		>
		<a href="/cms/rensai/{{ $rensaiCategory->id }}">{{ $rensaiCategory->category_name }}</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('cms/rensai-cms-category-first-col')
	<!-- 2nd Column -->
	@include('cms/rensai-cms-second-col')
</article>
<!-- CMS - Features Module -->
<div id="rensai-cms-features-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container" style="color:#F00000; font-weight:bold; line-height:140%">
		This module can be edited from the Rensai Hub CMS page.
	</div>
</div>
<!-- CMS - News Module -->
<div id="rensai-cms-news-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container" style="color:#F00000; font-weight:bold; line-height:140%">
		This module can be edited from the Rensai Hub CMS page.
	</div>
</div>
<!-- CMS - Gadgets Module -->
<div id="rensai-cms-gadgets-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container" style="color:#F00000; font-weight:bold; line-height:140%">
		This module can be edited from the Rensai Hub CMS page.
	</div>
</div>
@stop
