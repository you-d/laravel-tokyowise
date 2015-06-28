<section id="gadget-post-first-col" class="first-col-wide post-first-col-wide">
	<!-- Social Media Link -->
	@include('module-social-media-sp')
	<div class="post-first-col-wide-width-limiter">
		<!-- Page Header Img -->
		<div class="post-header-img-style2">
			{{ HTML::image('images/gadgets/general/gadgets-header-img.png', 'Gadgets Header Img') }}
		</div>
		<!-- Posting Date -->
		<p class="posting-date">{{ date("d/m/Y", strtotime($gadgetPost->posting_date)) }}</p>
		<!-- Page Content -->
		<div class="post-content">
			<dl class="post-primary-img">
				<dt>
					{{ HTML::image('images/gadgets/general/gadgets-icon-img.png', 'Gadgets Icon') }}
				</dt>
				<dd class="post-content-title">
					<!-- Content Title -->
					<small>No.{{ $gadgetPost->id }}</small>
					<br>
					{{ $gadgetPost->post_title }}
				</dd>
				<dd>
					<!-- Content Primary Img -->
					{{ HTML::image('images/gadgets/posts/' . $gadgetPost->primary_img , $gadgetPost->primary_img) }}	
				</dd>
				<dd class="post-content-primary-img-desc">
					<!-- Content Primary Img Desc -->
					{{ $gadgetPost->primary_img_desc }}
				</dd>
			</dl>
			<!-- Content Body -->
			<div class="post-content-top-frame">
				{{ HTML::image('images/gadgets/general/gadgets-post-content-top-frame.png', 'Gadgets Post Content Top Frame') }}
			</div>
			<div class="post-content-body-frame">
				<!-- include('archive_gadget_posts/' . $gadgetPost->post_body) -->
				<?php include app_path() . '/views/archive_gadget_posts/' . $gadgetPost->post_body; ?>
			</div>
			<!-- Social Media Post Sharing Links -->
			<nav class="post-social-media-share-block">
				<ul>
					<li>
						<a href="/#">
							{{ HTML::image('images/social_ico_tw.png', 'Share on Twitter') }}
						</a>
					</li>
					<li>
						<a href="/#">
							{{ HTML::image('images/social_ico_fb.png', 'Share on Facebook') }}
						</a>
					</li>
					<li>
						<a href="/#">
							{{ HTML::image('images/social_ico_pin.png', 'Share on Pinterest') }}
						</a>
					</li>
					<li>
						<a href="/#">
							{{ HTML::image('images/social_ico_go.png', 'Share on Google Plus') }}
						</a>
					</li>
					<li>
						<a href="/#">
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
					<?php $urlPath = "/no" . $leftLink->id; ?>
				@endif
				<a href="/gadgets{{ $urlPath }}">
					<span class="post-link-label">
						@if($leftLink == null) ^ Top @else ≪ Next @endif
					</span>
					<span class="post-link-thumbnail-img">
						@if($leftLink == null)
							{{ HTML::image('images/gadgets/posts/' . $topThumbImg, 'Back to the features page') }}
						@else
							{{ HTML::image('images/gadgets/posts/' . $leftLink->thumbnail_img, $leftLink->thumbnail_img) }}
						@endif
					</span>
					<span class="post-link-thumbnail-title">
						@if($leftLink == null)
							Back to The Gadgets Page
						@else
							@if (strlen($leftLink->post_title) > 100) 
								{{ mb_substr(str_replace("<br>", " ", $leftLink->post_title), 0, 35) . ' ...' }}
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
					<?php $urlPath = "/no" . $rightLink->id; ?>
				@endif
				<a href="/gadgets{{ $urlPath }}">
					<span class="post-link-label">
						@if($rightLink == null) Top ^ @else Prev ≫ @endif
					</span>
					<span class="post-link-thumbnail-img">
						@if($rightLink == null)
							{{ HTML::image('images/gadgets/posts/' . $topThumbImg, 'Back to the features page') }}
						@else
							{{ HTML::image('images/gadgets/posts/' . $rightLink->thumbnail_img, $rightLink->thumbnail_img) }}
						@endif
					</span>
					<span class="post-link-thumbnail-title">
						@if($rightLink == null)
							Back to The Gadgets Page
						@else
							@if (strlen($rightLink->post_title) > 100) 
								{{ mb_substr(str_replace("<br>", " ", $rightLink->post_title), 0, 35) . ' ...' }}
							@else
								{{ str_replace("<br>", " ", $rightLink->post_title) }}
							@endif
						@endif
					</span>
				</a>
			</div>
		</div>
	</div>
</section>