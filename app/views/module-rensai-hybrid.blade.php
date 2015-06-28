<section id="rensai-list-hybrid" class="hybrid-module-section-v1">
	<div id="rensai-list-header" class="hybrid-module-header-v1">
		{{ HTML::image('images/rensai/general/rensai-module-header-img.png', 'Ren-Sai Side Header Img') }}
	</div>
	@if (isset($rensaiModuleEntries))
		@foreach ($rensaiModuleEntries as $rensaiModuleEntry)
		<div class="hybrid-module-entry-v1">
			<a href="/rensai/{{ $rensaiModuleEntry->category_id }}/{{ $rensaiModuleEntry->post_id }}">
				<p>{{ HTML::image('images/rensai/posts/' . $rensaiModuleEntry->thumbnail_img, $rensaiModuleEntry->thumbnail_img) }}</p>
				<dl>
					<dt>
						{{ $rensaiModuleEntry->category_name }}
					</dt>
					<dd>
						@if (strlen($rensaiModuleEntry->post_title) > 100) 
							{{ mb_substr($rensaiModuleEntry->post_title, 0, 35) . ' ...' }}
						@else
							{{ $rensaiModuleEntry->post_title }}
						@endif
					</dd>
				</dl>
			</a>
			<span class="hybrid-module-date-v1 posting-date">{{ date("d/m/Y", strtotime($rensaiModuleEntry->posting_date)) }}</span>
		</div>							
		@endforeach
	@else
		<p>The $rensaiModuleEntries needs to be defined in the controller of this page.</p>
	@endif	
</section>
<span class="view-all-link"><a href="/rensai">VIEW ALL</a></span>
<span class="view-all-link-sp"><a href="/rensai">Ren-Sai - VIEW ALL</a></span>