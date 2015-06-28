<section id="news-first-col" class="first-col-wide first-col-wide-border">
	<!-- Social Media Link -->
	@include('module-social-media-sp')
	<!-- Page Header Image -->
	<div class="page-header-img">
		{{ HTML::image('images/news/general/news-header-img.png', 'News Page Header Image') }}
	</div>
	<div class="page-header-img-sp">
		{{ HTML::image('images/news/general/news-header-img.png', 'News Page Header Image') }}
	</div>
	@foreach ($newsPosts as $newsPost)
	<div class="first-col-article-entry">
		<dl>
			<dt>
				<a href="/news/{{ $newsPost->id }}">
					{{ HTML::image('images/news/posts/' . $newsPost->thumbnail_img, $newsPost->thumbnail_img) }}
				</a>
			</dt>
			<dd>
				<a href="/news/{{ $newsPost->id }}">{{ $newsPost->post_title }}</a>
			</dd>
			<p class="posting-date">{{ date("d/m/Y", strtotime($newsPost->posting_date)) }}</p>
		</dl>
	</div>
	@endforeach
</section>	