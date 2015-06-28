<section id="features-first-col" class="first-col-wide">
	<!-- Social Media Link -->
	@include('module-social-media-sp')
	<!-- Page Header Image -->
	<div class="page-header-img">
		{{ HTML::image('images/features/general/features-first-col-header-img.png', 'Features Page Header Image') }}
	</div>
	<div class="page-header-img-sp">
		{{ HTML::image('images/features/general/features-first-col-header-img-sp.png', 'Features Page Header Image Sp') }}
	</div>
	<!-- Features Listing -->
	<!-- 1st listing -->
	@foreach ($featureCategories as $featureCategory) 
		<div class="features-list">
			<!-- group image -->
			<div class="features-list-header-img">
				{{ HTML::image('images/features/categories/' . $featureCategory->group_img, $featureCategory->category_name) }}
			</div>
			<!-- entries -->
			@foreach ($featurePosts as $featurePost) 
				@if ($featurePost->category_id === $featureCategory->id)
					<div class="features-entry">
						<dl>
							<dt>
								<a href="{{ url('/features', array($featurePost->post_id), false) }}">
									{{ HTML::image('images/features/posts/' . $featurePost->thumbnail_img, $featurePost->thumbnail_img) }}
								</a>
							</dt>
							<dd>
								<a href="{{ url('/features', array($featurePost->post_id), false) }}">
									@if (strlen($featurePost->post_title) > 100) 
										{{ mb_substr($featurePost->post_title, 0, 70) . ' ...' }}
									@else
										{{ $featurePost->post_title }}
									@endif
								</a>
							</dd>
						</dl>
						<p class="posting-date">{{ date("d/m/Y", strtotime($featurePost->posting_date)) }}</p>
					</div>
				@endif
			@endforeach
		</div>	
	@endforeach
</section>