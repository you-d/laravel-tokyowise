<section id="rensai-category-first-col" class="first-col-wide">
	<!-- Social Media Link -->
	@include('module-social-media-sp')
	<!-- Header Image -->
	<div id="rensai-category-group-img">
		{{ HTML::image('images/rensai/categories/' . $rensaiCategory->group_img, $rensaiCategory->group_img) }}	
	</div>
	<!-- Header Desc -->
	<div id="rensai-category-desc">
		{{ $rensaiCategory->group_desc }}
	</div>
	<!-- Entries -->
	@foreach ($rensaiPosts as $rensaiPost)
	<div class="rensai-entry">
		<dl>
			<dt>
				<a href="/rensai/{{ $rensaiCategory->id }}/{{ $rensaiPost->post_id }}">
					{{ HTML::image('images/rensai/posts/' . $rensaiPost->thumbnail_img, $rensaiPost->thumbnail_img) }}
				</a>
			</dt>
			<dd>
				<a href="/rensai/{{ $rensaiCategory->id }}/{{ $rensaiPost->post_id }}">
					@if (strlen($rensaiPost->post_title) > 100) 
						{{ mb_substr($rensaiPost->post_title, 0, 70) . ' ...' }}
					@else
						{{ $rensaiPost->post_title }}
					@endif
				</a>
			</dd>
		</dl>
		<p class="posting-date">{{ date("d/m/Y", strtotime($rensaiPost->posting_date)) }}</p>	
	</div>
	@endforeach
</section>