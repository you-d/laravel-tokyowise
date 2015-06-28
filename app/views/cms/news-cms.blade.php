@extends('cms/layout-cms')
@section('content-cms')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/cms/home">Home</a>
		>
		<a href="/cms/news">News</a>
	</nav>
</section>
<!-- editors contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('news-first-col') <!-- Under Construction -->
	<!-- 2nd Column -->
	@include('cms/news-cms-second-col') 
</article>
<!-- CMS - First Col Section -->
<div id="news-cms-first-col-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<p class="cms-under-construction-txt">UNDER CONSTRUCTION</p>	
</div>
<!-- CMS - Features Module -->
<div id="news-cms-features-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-news-features-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="news-features-module-dialog" class="cms-dialog" >
		<h1>[ News ] Features Side Column</h1>
		<hr><br>
		@if (isset($featureModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/news'), 
						   'class' => '', 'accept-charset' => 'UTF-8']) }}
				<?php $tot = count($featureModuleEntries); ?> 
				Number of entries :&nbsp;
				<select id="entries-num">
					<?php for($i=3; $i<=10; $i++) { ?>
						<option value="{{ $i }}" <?php if($tot == $i) { ?>selected<?php } ?> >{{ $i }}</option>
					<?php } ?>
				</select>
				<br><br><hr><br>
				<button type="button" id="submit-btn">Update</button>
				<button type="button" id="cancel-btn">Cancel</button>	
			{{ Form::close() }}
		@else	
			The $featureModuleEntries has not been defined in the NewsCmsController.
		@endif
	</div>
</div>
<!-- CMS - Rensai Module -->
<div id="news-cms-rensai-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-news-rensai-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="news-rensai-module-dialog" class="cms-dialog" >
		<h1>[ News ] Rensai Side Column</h1>
		<hr><br>
		@if (isset($rensaiModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/news'), 
						   'class' => '', 'accept-charset' => 'UTF-8']) }}
				<?php $tot = count($rensaiModuleEntries); ?> 
				Number of entries :&nbsp;
				<select id="entries-num">
					<?php for($i=3; $i<=10; $i++) { ?>
						<option value="{{ $i }}" <?php if($tot == $i) { ?>selected<?php } ?> >{{ $i }}</option>
					<?php } ?>
				</select>
				<br><br><hr><br>
				<button type="button" id="submit-btn">Update</button>
				<button type="button" id="cancel-btn">Cancel</button>	
			{{ Form::close() }}
		@else	
			The $rensaiModuleEntries has not been defined in the NewsCmsController.
		@endif
	</div>
</div>
<!-- CMS - Gadgets Module -->
<div id="news-cms-gadgets-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-news-gadgets-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="news-gadgets-module-dialog" class="cms-dialog" >
		<h1>[ News ] Gadgets Side Column</h1>
		<hr><br>
		@if (isset($gadgetsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/news'), 
						   'class' => '', 'accept-charset' => 'UTF-8']) }}
				<?php $tot = count($gadgetsModuleEntries); ?> 
				Number of entries :&nbsp;
				<select id="entries-num">
					<?php for($i=3; $i<=10; $i++) { ?>
						<option value="{{ $i }}" <?php if($tot == $i) { ?>selected<?php } ?> >{{ $i }}</option>
					<?php } ?>
				</select>
				<br><br><hr><br>
				<button type="button" id="submit-btn">Update</button>
				<button type="button" id="cancel-btn">Cancel</button>	
			{{ Form::close() }}
		@else	
			The $gadgetsModuleEntries has not been defined in the NewsCmsController.
		@endif
	</div>
</div>	
@stop