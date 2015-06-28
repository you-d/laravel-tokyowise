@extends('cms/layout-cms')
@section('content-cms')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/cms/home">Home</a>
		>
		<a href="/cms/rensai">Ren-Sai</a>
	</nav>
</section>
<!-- features contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('cms/rensai-cms-first-col')
	<!-- 2nd Column -->
	@include('cms/rensai-cms-second-col')
</article>
<!-- CMS - Features Module -->
<div id="rensai-cms-features-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-rensai-features-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="rensai-features-module-dialog" class="cms-dialog" >
		<h1>[ Rensai ] Features Side Column</h1>
		<hr><br>
		@if (isset($featureModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/rensai'), 
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
			The $featureModuleEntries has not been defined in the RensaiCmsController.
		@endif
	</div>
</div>
<!-- CMS - News Module -->
<div id="rensai-cms-news-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-rensai-news-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="rensai-news-module-dialog" class="cms-dialog" >
		<h1>[ Rensai ] News Side Column</h1>
		<hr><br>
		@if (isset($newsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/rensai'), 
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
			The $newsModuleEntries has not been defined in the RensaiCmsController.
		@endif
	</div>
</div>
<!-- CMS - Gadgets Module -->
<div id="rensai-cms-gadgets-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-rensai-gadgets-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="rensai-gadgets-module-dialog" class="cms-dialog" >
		<h1>[ Rensai ] Gadgets Side Column</h1>
		<hr><br>
		@if (isset($gadgetsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/rensai'), 
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
			The $gadgetsModuleEntries has not been defined in the RensaiCmsController.
		@endif
	</div>
</div>
@stop