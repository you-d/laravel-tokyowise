<section id="gadget-list-sp">
	<h1>
		{{ HTML::image('images/gadgets/general/gadgets-module-header-img-sp.png', 'Gadget List Header Img') }}
	</h1>
	<div id="gadget-entries-container">
		@foreach ($gadgetsModuleEntries as $gadgetsModuleEntry)
		<div class="gadget-entry">
			<a href="{{ url() }}/gadgets/{{ 'no' . $gadgetsModuleEntry->id }}">
				{{ HTML::image('images/gadgets/posts/' . $gadgetsModuleEntry->thumbnail_img, $gadgetsModuleEntry->thumbnail_img) }}
			</a>
		</div>
		@endforeach
	</div>
	<span class="view-all-link-sp"><a href="{{ url() }}/gadgets">Gadgets - VIEW ALL</a></span>
</section>
