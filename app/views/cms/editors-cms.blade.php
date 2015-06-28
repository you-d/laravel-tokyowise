@extends('cms/layout-cms')
@section('content-cms')
<!-- breadcrumb -->
<section id="breadcrumb-section">
	<nav>
		<a href="/cms/home">Home</a>
		>
		<a href="/cms/editors">Editor&#39;s Eyes</a>
	</nav>
</section>
<!-- editors contents -->
<article role="main" id="main">
	<!-- 1st Column -->
	@include('editors-first-col') <!-- under construction -->
	<!-- 2nd Column -->
	@include('cms/editors-cms-second-col') 
</article>
<!-- CMS - First Col Section -->
<div id="editors-cms-first-col-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<p class="cms-under-construction-txt">UNDER CONSTRUCTION</p>	
</div>
<!-- CMS - Features Module -->
<div id="editors-cms-features-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-editors-features-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="editors-features-module-dialog" class="cms-dialog" >
		<h1>[ Editors ] Features Side Column</h1>
		<hr><br>
		@if (isset($featureModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/editors'), 
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
			The $featureModuleEntries has not been defined in the EditorsCmsController.
		@endif
	</div>
</div>
<!-- CMS - Rensai Module -->
<div id="editors-cms-rensai-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-editors-rensai-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="editors-rensai-module-dialog" class="cms-dialog" >
		<h1>[ Editors ] Rensai Side Column</h1>
		<hr><br>
		@if (isset($rensaiModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/editors'), 
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
			The $rensaiModuleEntries has not been defined in the EditorsCmsController.
		@endif
	</div>
</div>
<!-- CMS - News Module -->
<div id="editors-cms-news-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-editors-news-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="editors-news-module-dialog" class="cms-dialog" >
		<h1>[ Editors ] News Side Column</h1>
		<hr><br>
		@if (isset($newsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/editors'), 
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
			The $newsModuleEntries has not been defined in the EditorsCmsController.
		@endif
	</div>
</div>
<!-- CMS - Gadgets Module -->
<div id="editors-cms-gadgets-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-editors-gadgets-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="editors-gadgets-module-dialog" class="cms-dialog" >
		<h1>[ Editors ] Gadgets Side Column</h1>
		<hr><br>
		@if (isset($gadgetsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/editors'), 
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
			The $gadgetsModuleEntries has not been defined in the EditorsCmsController.
		@endif
	</div>
</div>	
@stop