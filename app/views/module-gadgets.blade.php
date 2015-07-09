<section id="gadget-list">
	<h1>
		{{ HTML::image('images/gadgets/general/gadgets-header-img.png', 'Gadget List Header Img') }}
	</h1>
	@foreach ($gadgetsModuleEntries as $gadgetsModuleEntry)
	<div class="gadget-entry">
		<p>No. {{ $gadgetsModuleEntry->id }}</p>
		<dl>
			<dt>
				<a href="{{ url() }}/gadgets/{{ 'no' . $gadgetsModuleEntry->id }}">
					{{ HTML::image('images/gadgets/posts/' . $gadgetsModuleEntry->thumbnail_img, $gadgetsModuleEntry->thumbnail_img) }}
				</a>
			</dt>
			<dd>
				<a href="{{ url() }}/gadgets/{{ 'no' . $gadgetsModuleEntry->id }}">
					{{ str_replace("<br>", " ", $gadgetsModuleEntry->post_title); }}
					<br>
					<span>{{ date("d/m/Y", strtotime($gadgetsModuleEntry->posting_date)) }}</span>
				</a>
			</dd>
		</dl>
	</div>
	@endforeach
	<span class="view-all-link"><a href="{{ url() }}/gadgets">VIEW ALL</a></span>
</section>
