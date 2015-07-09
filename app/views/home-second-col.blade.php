<section id="home-second-col">
	<div id="home-side-contents">
		<!-- News Section -->
		@include('module-news')
		<!-- Ren-Sai Section -->
		@include('module-rensai-hybrid')
		<!-- Poem Link Section -->
		<div id="poem-section">
			<a href="{{ url() }}/poems">
				{{ HTML::image('images/poems/general/home-link.jpg', 'Poetic Tokyo Walks') }}
			</a>
		</div>
		<!-- Editor's Eyes Link Section -->
		<div id="editors-eye" class="pc">
			<a href="{{ url() }}/editors">
				{{ HTML::image('images/editors/general/home-editors-eyes.jpg', 'Editors Eyes') }}
			</a>
		</div>
		<!-- Gadgets Section (Smartphone Ver.) -->
		@include('module-gadgets-sp')
		<!-- Writer List Link Section -->
		<div id="contributors-section">
			<a href="{{ url() }}/contributors">
				{{ HTML::image('images/writers.png', 'Writers On Writing') }}
			</a>
		</div>
	</div>
</section>
