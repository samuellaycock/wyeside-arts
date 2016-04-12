jQuery(document).ready(function($){
	//if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
	var MqL = 1200;
	//move nav element position according to window width
	moveNavigation();
	$(window).on('resize', function(){
		(!window.requestAnimationFrame) ? setTimeout(moveNavigation, 300) : window.requestAnimationFrame(moveNavigation);
	});

	//mobile - open lateral menu clicking on the menu icon
	$('.wy-nav__button-trigger').on('click', function(event){
		event.preventDefault();
		if( $('.wy-main').hasClass('nav-is-visible') ) {
			closeNav();
			$('.wy-nav__overlay').removeClass('is-visible');
		} else {
			$(this).addClass('nav-is-visible');
			$('.wy-nav__menu').addClass('nav-is-visible');
			$('.wy-nav').addClass('nav-is-visible');
			$('.wy-main').addClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').addClass('overflow-hidden');
			});
			toggleSearch('close');
			$('.wy-nav__overlay').addClass('is-visible');
		}
	});

	//open search form
	$('.wy-nav__button--search').on('click', function(event){
		event.preventDefault();
		toggleSearch();
		closeNav();
	});

	//close lateral menu on mobile 
	$('.wy-nav__overlay').on('swiperight', function(){
		if($('.wy-nav__menu').hasClass('nav-is-visible')) {
			closeNav();
			$('.wy-nav__overlay').removeClass('is-visible');
		}
	});
	$('.nav-on-left .wy-nav__overlay').on('swipeleft', function(){
		if($('.wy-nav__menu').hasClass('nav-is-visible')) {
			closeNav();
			$('.wy-nav__overlay').removeClass('is-visible');
		}
	});
	$('.wy-nav__overlay').on('click', function(){
		closeNav();
		toggleSearch('close')
		$('.wy-nav__overlay').removeClass('is-visible');
	});


	//prevent default clicking on direct children of .primary-nav
	$('.wy-nav__menu').children('.has-children').children('a').on('click', function(event){
		event.preventDefault();
	});
	//open submenu
	$('.wy-nav__menu-drop').children('a').on('click', function(event){
		if( !checkWindowWidth() ) event.preventDefault();
		var selected = $(this);
		if( selected.next('ul').hasClass('is-hidden') ) {
			//desktop version only
			selected.addClass('selected').next('ul').removeClass('is-hidden').end().parent('.has-children').parent('ul').addClass('moves-out');
			selected.parent('.has-children').siblings('.has-children').children('ul').addClass('is-hidden').end().children('a').removeClass('selected');
			$('.wy-nav__overlay').addClass('is-visible');
		} else {
			selected.removeClass('selected').next('ul').addClass('is-hidden').end().parent('.has-children').parent('ul').removeClass('moves-out');
			$('.wy-nav__overlay').removeClass('is-visible');
		}
		toggleSearch('close');
	});

	//submenu items - go back link
	$('.wy-nav__button--back').on('click', function(){
		$(this).parent('ul').addClass('is-hidden').parent('.has-children').parent('ul').removeClass('moves-out');
	});

	function closeNav() {
		$('.wy-nav__button-trigger').removeClass('nav-is-visible');
		$('.wy-nav').removeClass('nav-is-visible');
		$('.wy-nav__menu').removeClass('nav-is-visible');
		$('.wy-nav__menu-drop ul').addClass('is-hidden');
		$('.wy-nav__menu-drop a').removeClass('selected');
		$('.moves-out').removeClass('moves-out');
		$('.wy-main').removeClass('nav-is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			$('body').removeClass('overflow-hidden');
		});
	}

	function toggleSearch(type) {
		if(type=="close") {
			//close serach 
			$('.wy-nav__search').removeClass('is-visible');
			$('.wy-nav__button--search').removeClass('search-is-visible');
			$('.wy-nav__overlay').removeClass('search-is-visible');
		} else {
			//toggle search visibility
			$('.wy-nav__search').toggleClass('is-visible');
			$('.wy-nav__button--search').toggleClass('search-is-visible');
			$('.wy-nav__overlay').toggleClass('search-is-visible');
			if($(window).width() > MqL && $('.wy-nav__search').hasClass('is-visible')) $('.wy-nav__search').find('input[type="search"]').focus();
			($('.wy-nav__search').hasClass('is-visible')) ? $('.wy-nav__overlay').addClass('is-visible') : $('.wy-nav__overlay').removeClass('is-visible') ;
		}
	}

	function checkWindowWidth() {
		//check window width (scrollbar included)
		var e = window, 
            a = 'inner';
        if (!('innerWidth' in window )) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        if ( e[ a+'Width' ] >= MqL ) {
			return true;
		} else {
			return false;
		}
	}

	function moveNavigation(){
		var navigation = $('.wy-nav__menu');
  		var desktop = checkWindowWidth();
        if ( desktop ) {
			navigation.detach();
			navigation.insertBefore('.wy-nav__buttons');
		} else {
			navigation.detach();
			navigation.insertAfter('.main-content');
		}
	}
});