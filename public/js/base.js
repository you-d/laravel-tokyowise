$(document).ready(function() {
	setViewport();
	scrollToTop();
	sp_sliders();

	// Handle the logout button
	$("#logout-link-box").click(function(e) {
		e.preventDefault()
		var url = window.location.href + "?logout=1";
		$( location ).attr("href", url);
	});

	// Handle the hamburger button in sp mode
	$(" div#panel").hide();
	$(".gmenu").click(function() {
		$(this).toggleClass("menuOpen").next().slideToggle();
	});
	/*
	$(".feature_main").hide();
	$(".acordion a").click(function(){
		$(this).toggleClass("menuOpen");
		$(".feature_main").slideToggle();

		return false;
	});*/

	// Submit the login form
	$("#login-btn").click(function() {
		$("#login-form").submit();
	});
});

$(window).load(function() {
	 // Don't show the login-link-box div when users are visiting the login page.
	if (window.location.pathname == "/login") {
		$("#login-link-box").css("display", "none");
	}
});

/* GLOBAL PROPERTY
------------------------------------ */
var isTop = true; // For the scrollToTop() function

/* GLOBAL FUNCTION
------------------------------------ */
function setViewport(){
	var _contents = '';
	var _meta = document.createElement('meta');
	switch( getBranch() ){
		case 'SP':
				_contents = 'width=device-width, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1, user-scalable=yes';
			break;
		case 'TB':
		case 'PC':
				_contents = 'width=1040, user-scalable=yes';
			break;
	}
	_meta.setAttribute('name', 'viewport');
	_meta.setAttribute('content', _contents);
	document.getElementsByTagName('head')[0].appendChild(_meta);
}

function getBranch(){
	//TB
	if(
		(navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') == -1)
		|| navigator.userAgent.indexOf('iPad') > 0
	){
		return 'TB'
	}
	//SP
	else if(
		(navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1)
		|| navigator.userAgent.indexOf('iPod') > 0
		|| (navigator.userAgent.indexOf('Android') > 0 && navigator.userAgent.indexOf('Mobile') > 0)
		|| navigator.userAgent.indexOf('Windows Phone') > 0
	){
		return 'SP'
	}
	//PC
	else{
		return 'PC'
	}
}

function scrollToTop() {
	var _btn = $('#top-page-btn');
	// initial state: at the top of the page, the button is invisible.
	_btn.stop().fadeOut(0);

	$(window).scroll(function() {
		var _v = $(window).scrollTop();
		if( _v <= 0 ) {
			if( !isTop ) {
				isTop = true;
				_btn.stop().fadeOut(300);
			}
		} else {
			if( isTop ) {
				_btn.stop().fadeIn(300);
				isTop = false;
			}
		};
	});

	$('#top-page-btn a').click(function() {
		var speed = 400;
		$('html, body').animate({ scrollTop: 0 }, speed, 'swing');
		return false;
	});
}

function sp_sliders() {
	if( $("#headline-entries-carousel").length > 0 ) {
    	var _mainSlider = $("#headline-entries-carousel").bxSlider( {
            pager: false,
            auto: true,
            pause: 8000,
            // slideWidth: 290,
            minSlides: 1,
            maxSlides: 1,
            startSlide:0,
						// moveSlides: 1,
            prevText: '<img src="./images/btn_prev_main.png" alt="">',
            nextText: '<img src="./images/btn_next_main.png" alt="">',
            onSlideAfter: function(){ _mainSlider.startAuto(); }
        });
	};
}
