<section id="news-list-sp">
	<h1>
		{{ HTML::image('images/news/general/news-module-header-img.png', 'News Side Header Img') }}
	</h1>
	@if (isset($newsModuleEntries))
		@foreach ($newsModuleEntries as $newsModuleEntry)
			<div class="news-entry">
				<dl>
					<dt>
						<a href="{{ url() }}/news/{{ $newsModuleEntry->id }}">
							@if (strlen($newsModuleEntry->post_title) > 100)
								{{ mb_substr($newsModuleEntry->post_title, 0, 35) . ' ...' }}
							@else
								{{ $newsModuleEntry->post_title }}
							@endif
						</a>
					</dt>
					<dd>
						<span class="posting-date">{{ date("d/m/Y", strtotime($newsModuleEntry->posting_date)) }}</span>
					</dd>
				</dl>
			</div>
		@endforeach
	@else
		<p>The $newsModuleEntries needs to be defined in the controller of this page.</p>
	@endif
</section>
<span class="view-all-link-sp"><a href="{{ url() }}/news">NEWS - VIEW ALL</a></span>
