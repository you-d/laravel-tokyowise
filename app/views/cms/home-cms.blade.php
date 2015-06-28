@extends('cms/layout-cms')
@section('content-cms')
<article role="main" id="main">
	<div id="main-body">
		<!-- Headline Header Image - Desktop View Only -->
		<a href="">
			<div id="headline-header-image"> 
				{{ HTML::image('images/home/' . $wideHeaderImg) }}
			</div>
		</a>
		<!-- CMS - Headline Header Image -->
		<div id="home-cms-headline-header-img-overlay" class="cms-overlay">
			<div class="cms-transparent-overlay"></div>
			<div class="cms-buttons-container">
				<div id="edit-home-headline-header-img" class="cms-button cms-button-red">Edit</div>
			</div>
			<div id="home-headline-header-img-dialog" class="cms-dialog" >
				<h1>[Home] Header Image</h1>
				<hr><br>
				@if (isset($wideHeaderImg) && isset($narrowHeaderImg) && isset($headerImgLastUpdate))
					{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/home'), 
						   		  'class' => '', 'files' => true]) }}
					<table class="cms-content-frame">
						<tr>
							<td class="left-col home-cms-panel-headerimg-leftcol">
								{{ Form::label('wide-img-input', 'Replace Wide image : ') }}
							</td>
							<td class="right-col">
								{{ Form::file('wide-img-input', array('id'=>'wide-img-input','class'=>'upload-text-field')) }} 
							</td>
						</tr>
						<tr>
							<td class="left-col home-cms-panel-headerimg-leftcol">
								{{ Form::label('narrow-img-input', 'Replace Narrow image : ') }}
							</td>
							<td class="right-col">
								{{ Form::file('narrow-img-input', array('id'=>'narrow-img-input','class'=>'upload-text-field')) }} 
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<br>
								<div class="dialog-last-update-label">
									Last Update :&nbsp;
									<span class="posting-date">{{ $headerImgLastUpdate }}</span>
									[ GMT +10 ]
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<br><div id="error-list"></div><br>   
							</td>
						</tr>
					</table>	
					{{ Form::close() }}						
				@endif
				<hr><br>
				<button type="button" id="submit-btn">Update</button>
				<button type="button" id="cancel-btn">Cancel</button>
			</div>
		</div>
		<!-- 1st column -->
		@include('cms/home-cms-first-col')
		<!-- 2nd column -->
		@include('cms/home-cms-second-col')
	</div>
	<!-- 3rd column -->
	@include('cms/module-cms-gadgets')
</article>
<!-- CMS - News Module -->
<div id="home-cms-news-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-home-news-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="home-news-module-dialog" class="cms-dialog" >
		<h1>[ Home ] News Side Column</h1>
		<hr><br>
		@if (isset($newsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/home'), 
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
			The $newsModuleEntries has not been defined in the HomeCmsController.
		@endif
	</div>
</div>
<!-- CMS - Rensai Module -->
<div id="home-cms-rensai-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-home-rensai-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="home-rensai-module-dialog" class="cms-dialog" >
		<h1>[ Home ] Rensai Side Column</h1>
		<hr><br>
		@if (isset($rensaiModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/home'), 
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
			The $rensaiModuleEntries has not been defined in the HomeCmsController.
		@endif
	</div>
</div>
<!-- CMS - Gadgets Module -->
<div id="home-cms-gadgets-module-overlay" class="cms-overlay">
	<div class="cms-transparent-overlay"></div>
	<div class="cms-buttons-container">
		<div id="edit-home-gadgets-module" class="cms-button cms-button-red">Edit</div>
	</div>
	<div id="home-gadgets-module-dialog" class="cms-dialog" >
		<h1>[ Home ] Gadgets Side Column</h1>
		<hr><br>
		@if (isset($gadgetsModuleEntries))
			{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/home'), 
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
			The $gadgetsModuleEntries has not been defined in the HomeCmsController.
		@endif
	</div>
</div>
@stop