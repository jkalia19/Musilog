jQuery(document).ready(function($){
	
	var $container;

	function nsc_trigger_masonry() {
		// don't proceed if $grid has not been selected
		if ( !$container ) {
			return;
		}
		// init Masonry
		$container.imagesLoaded(function(){
			$container.masonry({
				// options
				itemSelector: '.item',
				columnWidth: '.item',
				percentPosition: true,
				gutter: 0,
			});
		});
	}
	
	$(window).load(function(){
		$container = $('#manson'); // this is the grid container
	
		nsc_trigger_masonry();
	
		// Triggers re-layout on infinite scroll
		$( document.body ).on( 'post-load', function () {
			
			// I removed the infinite_count code
			var $selector = $('.infinite-wrap');
			var $elements = $selector.find('.item');
			
			/* here is the idea which is to catch the selector whether it contain element or not, if it's move it to the masonry grid. */
			if( $selector.children().length > 0 ) {
				$container.append( $elements ).masonry( 'appended', $elements, true );
				nsc_trigger_masonry();
			}
			
		});
	});
	
	// The slider being synced must be initialized first
	  jQuery('.flexslider').flexslider({
		slideshowSpeed: carousel_speed.vars, 
		animation: "slide",
		animationLoop: true,
		itemWidth: 215,
		itemMargin: 0,
		minItems: 2,
		maxItems: 3,
		controlNav: false,
	  });
	
	$("#search-button").click(function(){
			$(".serch-form-coantainer").animate({
            width: 'toggle'
        });
		$( ".search-top" ).focus();
    });

	$('.flexslider .slides > li').hover(function(){     
        $(this).find('.slide-desc').fadeIn(500); 
    },     
    function(){    
        $(this).find('.slide-desc').fadeOut(500);
    });
	
	jQuery(".toogle-navigation .fa-bars").click(function(){
		if (jQuery('.main-navigation').hasClass('hide-bar')){
			jQuery(".main-navigation").removeClass("hide-bar");
			jQuery("body").addClass("show-bar");	
		}
		else{
			jQuery(".main-navigation").addClass("hide-bar");
			jQuery("body").removeClass("show-bar");
		}
		
	});
	
	jQuery(".close-bar").click(function(){
		jQuery(".main-navigation").addClass("hide-bar");
		jQuery("body").removeClass("show-bar");
	});
	
	jQuery('a#jump_next').on('click',function (e) {
		 e.preventDefault();

		 var target = this.hash,
		 jQuerytarget = jQuery(target);

		 jQuery('html, body').stop().animate({
			 'scrollTop': jQuerytarget.offset().top
		 }, 900, 'swing', function () {
			window.location.href.split('#masthead')[0] = target;
		 });
	 });
	
	jQuery('a[href*=".png"]:has(img), a[href*=".gif"]:has(img), a[href*=".jpg"]:has(img)').prettyPhoto({ social_tools: false});
	

});