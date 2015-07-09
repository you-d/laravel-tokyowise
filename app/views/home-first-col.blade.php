<section id="home-contents">
	<!-- headlines section -->
	<div id="headlines-section">
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
					<a href="{{ $urlPath }}">
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
					<a href="{{ $urlPath }}">
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
	</div>
	<div id="headlines-section-sp">
		<!-- Social Media Links -->
		@include('module-social-media-sp')
		<!-- Headline Header Image -->
		<a href="{{ url() }}/#">
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
				<a href="{{ $urlPath }}">
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
						<a href="{{ $urlPath }}">
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
						<a href="{{ url() }}/features/{{ $featurePost->post_id }}" title="{{ $featurePost->post_title }}">
							{{ HTML::image('images/features/posts/' . $featurePost->thumbnail_img, $featurePost->thumbnail_img) }}
						</a>
					</dt>
					<dd>
						<a href="{{ url() }}/features/{{ $featurePost->post_id }}" title="{{ $featurePost->post_title }}">
							{{ $featurePost->post_title }}
						</a>
					</dd>
				</dl>
				<p class="posting-date">{{ date("d/m/Y", strtotime($featurePost->posting_date)) }}</p>
			</div>
		@endforeach
	</div>
	<span class="view-all-link"><a href="{{ url() }}/features">VIEW ALL</a></span>
	<span class="view-all-link-sp"><a href="{{ url() }}/features">Features - VIEW ALL</a></span>
</section>
