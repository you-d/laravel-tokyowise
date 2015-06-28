<section id="home-contents">
	<!-- headlines section -->
	<div id="headlines-section">
	@if (isset($headlineEntries))
		<?php for ($i=0; $i<count($headlineEntries); $i++) { ?>
			<?php
				$entry = $headlineEntries [$i][0];
				$imagePath = $headlineEntries [$i][1];
				$urlPath = $headlineEntries [$i][2];
				$entryTitle = $headlineEntries [$i][3];
			?>
			@if($i == 0)
			<div id="headline-{{ $i }}" class="headline-entry-top">
			@else
			<div id="headline-{{ $i }}" class="headline-entry">
			@endif
				<dl>
					<dt>
						<!-- the 'new' sticker -->
						<div class="new-sticker">
							{{ HTML::image('images/new.png', 'new sticker') }}
						</div>
						<!-- the topic image -->
						<a href="">
							{{ HTML::image( $imagePath . $entry->primary_img, $entry->primary_img ) }}
						</a>
					</dt>
					<dd class="headline-entry-info">
						<span class="posting-date">
							{{ date("d/m/Y", strtotime($entry->posting_date)) }}
						</span>
						&nbsp;&nbsp;
						@if($i == 0)
							[ {{ $entryTitle }} ]
						@else
							[
							@if (strlen($entryTitle) > 25)
								{{ mb_substr($entryTitle, 0, 24) . ' ...' }}
							@else
								{{ $entryTitle }}
							@endif
							]
						@endif
					</dd>
					<dd>
						<!-- the topic description -->
						<a href="">
							<?php $strippedTitle = str_replace("<br>", " ", $entry->post_title); ?>
							@if($i == 0)
								{{ $strippedTitle }}
							@else
								@if (strlen($strippedTitle) > 100)
									{{ mb_substr($strippedTitle, 0, 45) . ' ...' }}
								@else
									{{ $strippedTitle }}
								@endif
							@endif
						</a>
					</dd>
				</dl>
			</div>
		<?php } ?>
	@endif
	</div>
	<!-- CMS - Headlines Section -->
	<div id="home-cms-headline-0-overlay" class="cms-overlay">
		<div class="cms-transparent-overlay"></div>
		<div class="cms-buttons-container">
			<div id="edit-home-headline-0" class="cms-button cms-button-red">Edit</div>
		</div>
		<div id="home-headline-0-dialog" class="cms-dialog" >
			<h1>[ Home ] Headline #0</h1>
			<hr><br>
			<?php
				$thisHeadlinePageType = ucfirst($headlineEntries [0][4]);
				$thisHeadlinePostId = $headlineEntries [0][0]->id;
			?>
			<input type="hidden" id="displayedHeadline" value="{{ $thisHeadlinePageType . ' ' . $thisHeadlinePostId }}"
			@include('cms/home-cms-headline-panel-module')
		</div>
	</div>
	<div id="home-cms-headline-1-overlay" class="cms-overlay">
		<div class="cms-transparent-overlay"></div>
		<div class="cms-buttons-container">
			<div id="edit-home-headline-1" class="cms-button cms-button-red">Edit</div>
		</div>
		<div id="home-headline-1-dialog" class="cms-dialog" >
			<h1>[ Home ] Headline #1</h1>
			<hr><br>
			<?php
				$thisHeadlinePageType = ucfirst($headlineEntries [1][4]);
				$thisHeadlinePostId = $headlineEntries [1][0]->id;
			?>
			<input type="hidden" id="displayedHeadline" value="{{ $thisHeadlinePageType . ' ' . $thisHeadlinePostId }}"
			@include('cms/home-cms-headline-panel-module')
		</div>
	</div>
	<div id="home-cms-headline-2-overlay" class="cms-overlay">
		<div class="cms-transparent-overlay"></div>
		<div class="cms-buttons-container">
			<div id="edit-home-headline-2" class="cms-button cms-button-red">Edit</div>
		</div>
		<div id="home-headline-2-dialog" class="cms-dialog" >
			<h1>[ Home ] Headline #2</h1>
			<hr><br>
			<?php
				$thisHeadlinePageType = ucfirst($headlineEntries [2][4]);
				$thisHeadlinePostId = $headlineEntries [2][0]->id;
			?>
			<input type="hidden" id="displayedHeadline" value="{{ $thisHeadlinePageType . ' ' . $thisHeadlinePostId }}"
			@include('cms/home-cms-headline-panel-module')
		</div>
	</div>
	<div id="home-cms-headline-3-overlay" class="cms-overlay">
		<div class="cms-transparent-overlay"></div>
		<div class="cms-buttons-container">
			<div id="edit-home-headline-3" class="cms-button cms-button-red">Edit</div>
		</div>
		<div id="home-headline-3-dialog" class="cms-dialog" >
			<h1>[ Home ] Headline #3</h1>
			<hr><br>
			<?php
				$thisHeadlinePageType = ucfirst($headlineEntries [3][4]);
				$thisHeadlinePostId = $headlineEntries [3][0]->id;
			?>
			<input type="hidden" id="displayedHeadline" value="{{ $thisHeadlinePageType . ' ' . $thisHeadlinePostId }}"
			@include('cms/home-cms-headline-panel-module')
		</div>
	</div>
	<div id="home-cms-headline-4-overlay" class="cms-overlay">
		<div class="cms-transparent-overlay"></div>
		<div class="cms-buttons-container">
			<div id="edit-home-headline-4" class="cms-button cms-button-red">Edit</div>
		</div>
		<div id="home-headline-4-dialog" class="cms-dialog" >
			<h1>[ Home ] Headline #4</h1>
			<hr><br>
			<?php
				$thisHeadlinePageType = ucfirst($headlineEntries [4][4]);
				$thisHeadlinePostId = $headlineEntries [4][0]->id;
			?>
			<input type="hidden" id="displayedHeadline" value="{{ $thisHeadlinePageType . ' ' . $thisHeadlinePostId }}"
			@include('cms/home-cms-headline-panel-module')
		</div>
	</div>
	<!-- headlines section SP (CMS IS NOT AVAILABLE) -->
	<div id="headlines-section-sp">
		<!-- Social Media Links -->
		@include('module-social-media-sp')
		<!-- Headline Header Image -->
		<a href="">
			<div id="headline-header-img-sp">
				{{ HTML::image('images/home/' . $narrowHeaderImg) }}
			</div>
		</a>
		<!-- Main Carousel (Box Slider) -->
		<ul id='headline-entries-carousel'>
		<?php for ($i=0; $i<count($headlineEntries); $i++) { ?>
		<?php
			$entry = $headlineEntries [$i][0];
			$imagePath = $headlineEntries [$i][1];
			$urlPath = $headlineEntries [$i][2];
		?>
			<li>
				<a href="">
					{{ HTML::image( $imagePath . $entry->primary_img, $entry->primary_img ) }}
				</a>
			</li>
		<?php } ?>
		</ul>
		<!-- Headlines Entries -->
		<?php for ($i=0; $i<count($headlineEntries); $i++) { ?>
		<?php
			$entry = $headlineEntries [$i][0];
			$imagePath = $headlineEntries [$i][1];
			$urlPath = $headlineEntries [$i][2];
			$entryTitle = $headlineEntries [$i][3];
		?>
			<div class='headline-entry @if($i == 0) headline-entry-top @endif'>
				<dl>
					<dd class='headline-entry-info'>
						<div class='new-sticker'>
							{{ HTML::image('images/new.png', 'new topic sticker') }}
						</div>
						<span class='posting-date'>
							{{ date("d/m/Y", strtotime($entry->posting_date)) }}
						</span>
						<span class='headline-entry-title'>
						[
						@if (strlen($entryTitle) > 30)
							{{ mb_substr($entryTitle, 0, 29) . ' ...' }}
						@else
							{{ $entryTitle }}
						@endif
						]
						</span>
					</dd>
					<dd>
						<a href="">
							<?php $strippedTitle = str_replace("<br>", " ", $entry->post_title); ?>
							@if($i == 0)
								{{ $strippedTitle }}
							@else
								@if (strlen($strippedTitle) > 100)
									{{ mb_substr($strippedTitle, 0, 55) . ' ...' }}
								@else
									{{ $strippedTitle }}
								@endif
							@endif
						</a>
					</dd>
				</dl>
			</div>
		<?php } ?>
	</div>
	<!-- News List (Smartphone only) -->
	@include('module-news-sp')
	<!-- Features section (Hybrid) -->
	<div id="features-header-img-sp">
		{{ HTML::image('images/features/general/home-features-highlight-header-sp.png', 'Features Highlight Header') }}
	</div>
	<div id="features-header-img">
		{{ HTML::image('images/features/general/home-features-highlight-header.png', 'Features Highlight Header') }}
	</div>
	<div id="features-section">
		<!-- Feature Highlight Image -->
		<h1>{{ HTML::image('images/features/categories/' . $featureCategory->group_img, $featureCategory->group_img) }}</h1>
		<!-- Feature Highlight Description -->
		<div class="features-highlight-desc">
			{{ $featureCategory->highlight_desc }}
		</div>
		@foreach ($featurePosts as $featurePost)
			<div class="features-entry">
				<dl>
					<dt>
						<a href="" title="">
							{{ HTML::image('images/features/posts/' . $featurePost->thumbnail_img, $featurePost->thumbnail_img) }}
						</a>
					</dt>
					<dd>
						<a href="" title="">
							{{ $featurePost->post_title }}
						</a>
					</dd>
				</dl>
				<p class="posting-date">{{ date("d/m/Y", strtotime($featurePost->posting_date)) }}</p>
			</div>
		@endforeach
	</div>
	<span class="view-all-link"><a href="/cms/features">VIEW ALL</a></span>
	<span class="view-all-link-sp"><a href="/cms/features">Features - VIEW ALL</a></span>
	<!-- CMS - Features Section (Hybrid) -->
	<div id="home-cms-features-highlight-overlay" class="cms-overlay">
		<div class="cms-transparent-overlay"></div>
		<div class="cms-buttons-container">
			<div id="edit-home-features-highlight" class="cms-button cms-button-red">Edit</div>
		</div>
		<div id="home-features-highlight-dialog" class="cms-dialog" >
			<h1>[ Home ] Features Highlight Column</h1>
			<hr><br>
			@if (isset($featureCategory) && isset($featurePosts))
				{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/home'),
							   'class' => '', 'accept-charset' => 'UTF-8']) }}
					<?php $tot = count($featurePosts); ?>
					Number of entries :&nbsp;
					<select id="entries-num">
						<?php for($i=2; $i<=10; $i++) { ?>
							<option value="{{ $i }}" <?php if($tot == $i) { ?>selected<?php } ?> >{{ $i }}</option>
						<?php } ?>
					</select>
					<br><br><hr><br>
					<button type="button" id="submit-btn">Update</button>
					<button type="button" id="cancel-btn">Cancel</button>
				{{ Form::close() }}
			@else
				The $featureCategory & $featurePosts have not been defined in the HomeCmsController.
			@endif
		</div>
	</div>
</section>
