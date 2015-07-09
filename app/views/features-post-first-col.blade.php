<section id="features-post-first-col" class="first-col-wide post-first-col-wide">
	<!-- Social Media Link -->
	@include('module-social-media-sp')
	<div class="post-first-col-wide-width-limiter">
		<!-- Page Header Image -->
		<div class="page-header-img post-header-img">
			{{ HTML::image('images/features/posts/' . $featurePost->header_img, $featurePost->header_img) }}
		</div>
		<div class="page-header-img-sp post-header-img">
			{{ HTML::image('images/features/posts/' . $featurePost->header_img, $featurePost->header_img) }}
		</div>
		<!-- Posting Date -->
		<p class="posting-date">{{ date("d/m/Y", strtotime($featurePost->posting_date)) }}</p>
		<!-- Page Content -->
		<div class="post-content">
			<dl class="post-primary-img">
				<dt>
					{{ HTML::image('images/features/categories/' . $featureCategory->icon_img, $featureCategory->icon_img) }}
				</dt>
				<dd>
					<!-- Content Primary Img -->
					{{ HTML::image('images/features/posts/' . $featurePost->primary_img , $featurePost->primary_img) }}
				</dd>
			</dl>
			<!-- Content Body -->
			<!-- include('archive_feature_posts/' . $featurePost->post_body) -->
			<?php include app_path() . '/views/archive_feature_posts/' . $featurePost->post_body; ?>
			<!-- Social Media Post Sharing Links -->
			<nav class="post-social-media-share-block">
				<ul>
					<li>
						<a href="{{ url() }}/#">
							{{ HTML::image('images/social_ico_tw.png', 'Share on Twitter') }}
						</a>
					</li>
					<li>
						<a href="{{ url() }}/#">
							{{ HTML::image('images/social_ico_fb.png', 'Share on Facebook') }}
						</a>
					</li>
					<li>
						<a href="{{ url() }}/#">
							{{ HTML::image('images/social_ico_pin.png', 'Share on Pinterest') }}
						</a>
					</li>
					<li>
						<a href="{{ url() }}/#">
							{{ HTML::image('images/social_ico_go.png', 'Share on Google Plus') }}
						</a>
					</li>
					<li>
						<a href="{{ url() }}/#">
							{{ HTML::image('images/social_ico_tum.png', 'Share on Tumblr') }}
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<!-- Prev & Next Link -->
		<div class="post-prev-next-link">
			<div class="post-prev-next-link-left-col">
				<?php $urlPath = ""; ?>
				@if($leftLink != null)
					<?php $urlPath = "/" . $leftLink->post_id; ?>
				@endif
				<a href="{{ url() }}/features{{ $urlPath }}">
					<span class="post-link-label">
						@if($leftLink == null) ^ Top @else ≪ Next @endif
					</span>
					<span class="post-link-thumbnail-img">
						@if($leftLink == null)
							{{ HTML::image('images/features/posts/' . $topThumbImg, 'Back to the features page') }}
						@else
							{{ HTML::image('images/features/posts/' . $leftLink->thumbnail_img, $leftLink->thumbnail_img) }}
						@endif
					</span>
					<span class="post-link-thumbnail-title">
						@if($leftLink == null)
							Back to The Features Page
						@else
							@if (strlen($leftLink->post_title) > 100)
								{{ mb_substr($leftLink->post_title, 0, 35) . ' ...' }}
							@else
								{{ $leftLink->post_title }}
							@endif
						@endif
					</span>
				</a>
			</div>
			<div class="post-prev-next-link-right-col">
				<?php $urlPath = ""; ?>
				@if($rightLink != null)
					<?php $urlPath = "/" . $rightLink->post_id; ?>
				@endif
				<a href="{{ url() }}/features{{ $urlPath }}">
					<span class="post-link-label">
						@if($rightLink == null) Top ^ @else Prev ≫ @endif
					</span>
					<span class="post-link-thumbnail-img">
						@if($rightLink == null)
							{{ HTML::image('images/features/posts/' . $topThumbImg, 'Back to the features page') }}
						@else
							{{ HTML::image('images/features/posts/' . $rightLink->thumbnail_img, $rightLink->thumbnail_img) }}
						@endif
					</span>
					<span class="post-link-thumbnail-title">
						@if($rightLink == null)
							Back to The Features Page
						@else
							@if (strlen($rightLink->post_title) > 100)
								{{ mb_substr($rightLink->post_title, 0, 35) . ' ...' }}
							@else
								{{ $rightLink->post_title }}
							@endif
						@endif
					</span>
				</a>
			</div>
		</div>
		<!-- Post Archives -->
		<div class="post-archives">
			<h2>{{ $featureCategory->category_name }}</h2>
			@foreach ($postArchives as $postArchive)
				@if ($postArchive->post_id === $featurePost->post_id)
				<div class="archive-entry archive-entry-selected">
				@else
				<div class="archive-entry">
				@endif
					<dl>
						<dt class="posting-date">{{ date("d/m/Y", strtotime($postArchive->posting_date)) }}</dt>
						<dd>
							<a href="{{ url('/features', array($postArchive->post_id), false) }}">
								@if (strlen($postArchive->post_title) > 100)
									{{ mb_substr($postArchive->post_title, 0, 35) . ' ...' }}
								@else
									{{ $postArchive->post_title }}
								@endif
							</a>
						</dd>
					</dl>
				</div>
			@endforeach
		</div>
	</div>
</section>
