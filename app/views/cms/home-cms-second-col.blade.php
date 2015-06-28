<section id="home-second-col">
	<div id="home-side-contents">
		<!-- News Section -->
		@include('cms/module-cms-news')
		<!-- Ren-Sai Section -->
		@include('cms/module-cms-rensai-hybrid')
		<!-- Poem Link Section -->
		<div id="poem-section">
			<a href="/poems">
				{{ HTML::image('images/poems/general/home-link.jpg', 'Poetic Tokyo Walks') }}
			</a>
		</div>
		<!-- Editor's Eyes Link Section -->
		<div id="editors-eye" class="pc">
			<a href="/editors">
				{{ HTML::image('images/editors/general/home-editors-eyes.jpg', 'Editors Eyes') }}
			</a>
		</div>
		<!-- Gadgets Section (Smartphone Ver.) -->
		@include('module-gadgets-sp')
		<!-- Writer List Link Section -->
		<div id="contributors-section">
			<a href="/contributors">
				{{ HTML::image('images/writers.png', 'Writers On Writing') }}
			</a>
		</div>
	</div>
</section>
