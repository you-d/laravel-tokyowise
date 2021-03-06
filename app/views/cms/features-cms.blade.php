@extends('cms/layout-cms')
@section('content-cms')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="{{ url() }}/cms/home">Home</a>
		>
		<a href="{{ url() }}/cms/features">Features</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('features-first-col') <!-- under construction -->
	<!-- 2nd Column -->
	@include('cms/features-cms-second-col')
</article>
<!-- CMS - First Col Section -->
<div id="features-cms-first-col-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<p class="cms-under-construction-txt">UNDER CONSTRUCTION</p>
</div>
<!-- CMS - Rensai Module -->
<div id="features-cms-rensai-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-features-rensai-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="features-rensai-module-dialog" class="cms-dialog" >
		<h1>[ Features ] Rensai Side Column</h1>
		<hr><br>
		@if (isset($rensaiModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/features'),
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
			The $rensaiModuleEntries has not been defined in the FeaturesCmsController.
		@endif
	</div>
</div>
<!-- CMS - News Module -->
<div id="features-cms-news-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-features-news-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="features-news-module-dialog" class="cms-dialog" >
		<h1>[ Features ] News Side Column</h1>
		<hr><br>
		@if (isset($newsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/features'),
						   'class' => '', 'accept-charset' => 'UTF-8']) }}
				<?php $tot = count($newsModuleEntries); ?>
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
			The $newsModuleEntries has not been defined in the FeaturesCmsController.
		@endif
	</div>
</div>
<!-- CMS - Gadgets Module -->
<div id="features-cms-gadgets-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-features-gadgets-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="features-gadgets-module-dialog" class="cms-dialog" >
		<h1>[ Features ] Gadgets Side Column</h1>
		<hr><br>
		@if (isset($gadgetsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/features'),
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
			The $gadgetsModuleEntries has not been defined in the FeaturesCmsController.
		@endif
	</div>
</div>
@stop
