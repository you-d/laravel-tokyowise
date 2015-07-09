<section id="rensai-first-col" class="first-col-wide">
	<!-- Social Media Link -->
	@include('module-social-media-sp')
	<!-- Page Header Image -->
	<div class="page-header-img">
		{{ HTML::image('images/rensai/general/rensai-first-col-header-img.png', 'Rensai Page Header Image') }}
	</div>
	<div class="page-header-img-sp">
		{{ HTML::image('images/rensai/general/rensai-first-col-header-img-sp.png', 'Rensai Page Header Image Sp') }}
	</div>
	<!-- New Articles Section -->
	<div id="rensai-new-articles-list">
		<h2>新着記事</h2>
		@foreach ($rensaiPosts as $rensaiPost)
		<div class="rensai-article-entry rensai-article-entry-first-sp">
			<a href="{{ url() }}/rensai/{{ $rensaiPost->category_id }}/{{ $rensaiPost->post_id }}">
				<span class="posting-date">{{ date("d/m/Y", strtotime($rensaiPost->posting_date)) }}</span>
				<span class="rensai-article-title">
					{{ $rensaiPost->post_title }}
				</span>
			</a>
		</div>
		@endforeach
	</div>
	<!-- Article Categories Section -->
	<div id="rensai-article-cat-list">
		<h2>テーマ別</h2>
		<div id="rensai-article-cat-list-container">
			<?php $counter = 0; ?>
			@foreach ($rensaiCategories as $rensaiCategory)
			<div class="rensai-article-cat-entry">
				<a href="{{ url() }}/rensai/{{ $rensaiCategory->id }}">
					<div class="rensai-article-cat-entry-info">
						<div class="rensai-article-cat-entry-title">{{ $rensaiCategory->category_name }}</div>
						<div class="rensai-article-cat-entry-desc">
							@if (strlen($rensaiCategory->group_desc) > 100)
								{{ mb_substr($rensaiCategory->group_desc, 0, 35) . ' ...' }}
							@else
								{{ $rensaiCategory->group_desc }}
							@endif
						</div>
						<div class="rensai-article-cat-entry-more-sp">一覧を見る</div>
					</div>
					<div class="rensai-article-cat-entry-img">
						{{ HTML::image('images/rensai/posts/' . $rensaiLatestThumbImgs [$counter] [0], 'comapps_02_LAOS') }}
					</div>
					<div class="rensai-article-cat-entry-more">一覧を見る</div>
				</a>
			</div>
			<?php $counter++; ?>
			@endforeach
		</div>
	</div>
</section>
