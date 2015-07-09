<section id="gadgets-first-col" class="first-col-wide first-col-wide-border">
	<!-- Social Media Link -->
	@include('module-social-media-sp')
	<!-- Page Header Image -->
	<div class="page-header-img">
		{{ HTML::image('images/gadgets/general/gadgets-header-img.png', 'Gadgets Page Header Image') }}
	</div>
	<div class="page-header-img-sp">
		{{ HTML::image('images/gadgets/general/gadgets-header-img.png', 'Gadgets Page Header Image Sp') }}
	</div>
	@foreach ($gadgetPosts as $gadgetPost)
	<div class="first-col-article-entry">
		<dl>
			<dt>
				<a href="{{ url() }}/gadgets/no{{ $gadgetPost->id }}">
					{{ HTML::image('images/gadgets/posts/' . $gadgetPost->thumbnail_img, $gadgetPost->thumbnail_img) }}
				</a>
			</dt>
			<dd>
				<a href="{{ url() }}/gadgets/no{{ $gadgetPost->id }}">{{ str_replace("<br>"," ",$gadgetPost->post_title) }}</a>
			</dd>
			<p class="posting-date">{{ date("d/m/Y", strtotime($gadgetPost->posting_date)) }}</p>
		</dl>
	</div>
	@endforeach
</section>
