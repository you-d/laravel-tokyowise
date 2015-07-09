@extends('cms/layout-cms')
@section('content-cms')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="{{ url() }}/cms/home">Home</a>
		>
		<a href="{{ url() }}/cms/gadgets">Gadgets</a>
	</nav>
</section>
<!-- editors contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('gadgets-first-col') <!-- Under Construction -->
	<!-- 2nd Column -->
	@include('cms/gadgets-cms-second-col')
</article>
<!-- CMS - First Col Section -->
<div id="gadgets-cms-first-col-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<p class="cms-under-construction-txt">UNDER CONSTRUCTION</p>
</div>
<!-- CMS - Features Module -->
<div id="gadgets-cms-features-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-gadgets-features-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="gadgets-features-module-dialog" class="cms-dialog" >
		<h1>[ Gadgets ] Features Side Column</h1>
		<hr><br>
		@if (isset($featureModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/gadgets'),
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
			The $featureModuleEntries has not been defined in the GadgetsCmsController.
		@endif
	</div>
</div>
<!-- CMS - Rensai Module -->
<div id="gadgets-cms-rensai-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-gadgets-rensai-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="gadgets-rensai-module-dialog" class="cms-dialog" >
		<h1>[ Gadgets ] Rensai Side Column</h1>
		<hr><br>
		@if (isset($rensaiModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/gadgets'),
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
			The $rensaiModuleEntries has not been defined in the GadgetsCmsController.
		@endif
	</div>
</div>
<!-- CMS - News Module -->
<div id="gadgets-cms-news-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-gadgets-news-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="gadgets-news-module-dialog" class="cms-dialog" >
		<h1>[ Gadgets ] News Side Column</h1>
		<hr><br>
		@if (isset($newsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/gadgets'),
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
			The $newsModuleEntries has not been defined in the GadgetsCmsController.
		@endif
	</div>
</div>
@stop
