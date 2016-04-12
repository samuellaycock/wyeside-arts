jQuery(document).ready(function($){
	var resizing = false,
		navigationWrapper = $('.wy-nav'),
		navigation = navigationWrapper.children('.wy-nav__menu'),
		searchForm = $('.wy-search'),
		pageContent = $('.wy-main'),
		searchTrigger = $('.wy-nav__button--search'),
		coverLayer = $('.wy-header__overlay'),
		navigationTrigger = $('.wy-nav__button--menu'),
		mainHeader = $('.wy-header');
	
	function checkWindowWidth() {
		var mq = window.getComputedStyle(mainHeader.get(0), '::before').getPropertyValue('content').replace(/"/g, '').replace(/'/g, "");
		return mq;
	}

	function checkResize() {
		if( !resizing ) {
			resizing = true;
			(!window.requestAnimationFrame) ? setTimeout(moveNavigation, 300) : window.requestAnimationFrame(moveNavigation);
		}
	}

	function moveNavigation(){
  		var screenSize = checkWindowWidth();
        if ( screenSize == 'desktop' && (navigationTrigger.siblings('.wy-search').length == 0) ) {
        	//desktop screen - insert navigation and search form inside <header>
        	searchForm.detach().insertBefore(navigationTrigger);
			navigationWrapper.detach().insertBefore(searchForm).find('.cd-search-wrapper').remove();
		} else if( screenSize == 'mobile' && !(mainHeader.children('.wy-nav').length == 0)) {
			//mobile screen - move navigation and search form after .cd-main-content element
			navigationWrapper.detach().insertAfter('.wy-header');
			var newListItem = $('<li class="cd-search-wrapper"></li>');
			searchForm.detach().appendTo(newListItem);
			newListItem.appendTo(navigation);
		}

		resizing = false;
	}

	function closeSearchForm() {
		searchTrigger.removeClass('search-form-visible');
		searchForm.removeClass('is-visible');
		coverLayer.removeClass('search-form-visible');
	}

	//add the .no-pointerevents class to the <html> if browser doesn't support pointer-events property
	( !Modernizr.testProp('pointerEvents') ) && $('html').addClass('no-pointerevents');

	//move navigation and search form elements according to window width
	moveNavigation();
	$(window).on('resize', checkResize);

	//mobile version - open/wy-search__button--close navigation
	navigationTrigger.on('click', function(event){
		event.preventDefault();
		mainHeader.add(navigation).add(pageContent).toggleClass('nav-is-visible');
	});

	searchTrigger.on('click', function(event){
		event.preventDefault();
		if( searchTrigger.hasClass('search-form-visible') ) {
			searchForm.find('form').submit();
		} else {
			searchTrigger.addClass('search-form-visible');
			coverLayer.addClass('search-form-visible');
			searchForm.addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				searchForm.find('input[type="search"]').focus().end().off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
			});
		}
	});

	//close search form
	searchForm.on('click', '.wy-search__button--close', function(){
		closeSearchForm();
	});

	coverLayer.on('click', function(){
		closeSearchForm();
	});
	
	$(document).keyup(function(event){
		if( event.which=='27' ) closeSearchForm();
	});

	//upadate span.selected-value text when user selects a new option
	searchForm.on('change', 'select', function(){
		searchForm.find('.selected-value').text($(this).children('option:selected').text());
	});
});