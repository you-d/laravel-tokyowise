<section id="features-list-hybrid" class="hybrid-module-section-v1">
	<div id="features-list-header" class="hybrid-module-header-v1">
		{{ HTML::image('images/features/general/features-module-header-img.png', 'Features Side Header Img') }}
	</div>
	@if (isset($featureModuleEntries))
		@foreach ($featureModuleEntries as $featureModuleEntry)
			<div class="hybrid-module-entry-v1">
				<a href="{{ url() }}/features/{{ $featureModuleEntry->post_id }}">
					<p>{{ HTML::image('images/features/posts/' . $featureModuleEntry->thumbnail_img, $featureModuleEntry->thumbnail_img) }}</p>
					<dl>
						<dt>
							{{ $featureModuleEntry->category_name }}
						</dt>
						<dd>
							@if (strlen($featureModuleEntry->post_title) > 100)
								{{ mb_substr($featureModuleEntry->post_title, 0, 35) . ' ...' }}
							@else
								{{ $featureModuleEntry->post_title }}
							@endif
						</dd>
					</dl>
				</a>
				<span class="hybrid-module-date-v1 posting-date">{{ date("d/m/Y", strtotime($featureModuleEntry->posting_date)) }}</span>
			</div>
		@endforeach
	@else
		<p>The $featureModuleEntries needs to be defined in the controller of this page.</p>
	@endif
</section>
<span class="view-all-link"><a href="{{ url() }}/features">VIEW ALL</a></span>
<span class="view-all-link-sp"><a href="{{ url() }}/features">Features - VIEW ALL</a></span>
