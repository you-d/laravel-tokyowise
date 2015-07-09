<section id="news-post-first-col" class="first-col-wide post-first-col-wide">
	<!-- Social Media Link -->
	@include('module-social-media-sp')
	<div class="post-first-col-wide-width-limiter">
		<!-- Page Header Text -->
		<div class="post-header-text">
			<h1>{{ $newsPost->post_title }}</h1>
		</div>
		<!-- Posting Date -->
		<p class="posting-date">{{ date("d/m/Y", strtotime($newsPost->posting_date)) }}</p>
		<!-- Page Content -->
		<div class="post-content">
			<dl class="post-primary-img">
				<dt>
					{{ HTML::image('images/news/general/news-icon-img.png', 'News Icon') }}
				</dt>
				<dd>
					<!-- Content Primary Img -->
					{{ HTML::image('images/news/posts/' . $newsPost->primary_img , $newsPost->primary_img) }}
				</dd>
			</dl>
			<!-- Content Body -->
			<!-- include('archive_news_posts/' . $newsPost->post_body) -->
			<?php include app_path() . '/views/archive_news_posts/' . $newsPost->post_body; ?>
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
					<?php $urlPath = $leftLink->id; ?>
				@endif
				<a href="{{ url() }}/news/{{ $urlPath }}">
					<span class="post-link-label">
						@if($leftLink == null) ^ Top @else ≪ Next @endif
					</span>
					<span class="post-link-thumbnail-img">
						@if($leftLink == null)
							{{ HTML::image('images/news/posts/' . $topThumbImg, 'Back to the News page') }}
						@else
							{{ HTML::image('images/news/posts/' . $leftLink->thumbnail_img, $leftLink->thumbnail_img) }}
						@endif
					</span>
					<span class="post-link-thumbnail-title">
						@if($leftLink == null)
							Back to The News Page
						@else
							@if (strlen($leftLink->post_title) > 100)
								{{ mb_substr(str_replace("<br>", " ", $leftLink->post_title), 0, 30) . ' ...' }}
							@else
								{{ str_replace("<br>", " ", $leftLink->post_title) }}
							@endif
						@endif
					</span>
				</a>
			</div>
			<div class="post-prev-next-link-right-col">
				<?php $urlPath = ""; ?>
				@if($rightLink != null)
					<?php $urlPath = $rightLink->id; ?>
				@endif
				<a href="{{ url() }}/news/{{ $urlPath }}">
					<span class="post-link-label">
						@if($rightLink == null) Top ^ @else Prev ≫ @endif
					</span>
					<span class="post-link-thumbnail-img">
						@if($rightLink == null)
							{{ HTML::image('images/news/posts/' . $topThumbImg, 'Back to the features page') }}
						@else
							{{ HTML::image('images/news/posts/' . $rightLink->thumbnail_img, $rightLink->thumbnail_img) }}
						@endif
					</span>
					<span class="post-link-thumbnail-title">
						@if($rightLink == null)
							Back to The News Page
						@else
							@if (strlen($rightLink->post_title) > 100)
								{{ mb_substr(str_replace("<br>", " ", $rightLink->post_title), 0, 30) . ' ...' }}
							@else
								{{ str_replace("<br>", " ", $rightLink->post_title) }}
							@endif
						@endif
					</span>
				</a>
			</div>
		</div>
		<!-- Post Archives Style #2 -->
		<div class="post-archives-v2">
			<h2>{{ HTML::image('images/news/general/news-archive-header-img.png', 'News Archive Header Img') }}</h2>
			<div class="post-archives-v2-entries">
				@foreach ($postArchives as $postArchive)
				<div class="archive-v2-entry">
					<dl>
						<dt>
							<a href="{{ url() }}/news/{{ $postArchive->id }}">
								{{ HTML::image('images/news/posts/' . $postArchive->thumbnail_img, $postArchive->thumbnail_img) }}
							</a>
						</dt>
						<dd>
							<a href="{{ url() }}/news/{{ $postArchive->id }}">
								{{ $postArchive->post_title }}
							</a>
						</dd>
					</dl>
					<p><span class="posting-date">{{ date("d/m/Y", strtotime($postArchive->posting_date)) }}</span></p>
				</div>
				@endforeach
				<div class="archive-v2-entry-clear"></div>
			</div>
		</div>
		<span class="view-all-link"><a href="{{ url() }}/news">VIEW ALL</a></span>
	</div>
</section>
