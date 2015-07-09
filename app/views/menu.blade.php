<div class="menu-navi-container">
	<div class="gnav">
		<div id="gnav-area">
			<a class="gmenu" id="gmenu"></a>
			<div id="panel">
				<div class="menu-primary-container">
					<ul id="menu-primary" class="menu">
						<li id="navbar-item-home">{{ HTML::link("/home", "Home") }}</li>
						<li id="navbar-item-features">{{ HTML::link("/features", "Features") }}</li>
						<li id="navbar-item-rensai">{{ HTML::link("/rensai", "Ren-Sai") }}</li>
						<li id="navbar-item-gadgets">{{ HTML::link("/gadgets", "Do You Own It?") }}</li>
						<li id="navbar-item-news">{{ HTML::link("/news", "News") }}</li>
						<li id="navbar-item-editors">{{ HTML::link("/editors", "Editor&#39;s Eyes") }}</li>
					</ul>
				</div>
			</div>
		</div>
		<ul class="sns">
			<li id="tw">
				<a href="{{ url() }}/#" target="_blank">
					{{ HTML::image('images/sns_t.png', 'twitter') }}
				</a>
			</li>
			<li id="fb">
				<a href="{{ url() }}/#" target="_blank">
					{{ HTML::image('images/sns_f.png', 'facebook') }}
				</a>
			</li>
		</ul>
	</div>
</div>
