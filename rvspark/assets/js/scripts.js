var $j = jQuery.noConflict();

// All mobile header badassery belongs under here
(function( $j ) {
 
    $j.fn.mobileHeader = function( actions ) {

    	var vars = {
    		aSpeed: 600,
    		body: $j('body'),
    		win: $j(window),
    		easingType: "easeOutQuad",
    		header: $j('#cap'),
    		trigger: $j('#mobileOpen'),
    		nav: $j('nav','#cap'),
    		headerOn: false,
    		mobileOpen: false,
    		scrollClass: 'showHeader',
    		headerOn: false
    	};

 		return this.each(function() {

 			// Run this on page load
 			initialLoad();

	    });

 		function getScrollLine(){
 			var heroLogo = $j('#heroLogo').offset();
	    	vars.scrollLine = heroLogo.top;
 		}

 		function homeCheck() {
 			vars.isHomePage = false
 			if (vars.body.hasClass('home')) {
 				vars.isHomePage = true;
 			}
 		}

	    function initialLoad() {

	    	homeCheck();

	    	// If we're on the home page we need the header background
	    	// to turn white when we scroll down
	    	if (vars.isHomePage) {
	    		getScrollLine();
	    		scrollCheck();
	    		vars.win.on('scroll',function(){
	    			window.requestAnimationFrame(scrollCheck);
	    		});
	    		vars.win.on('resize',function(){
	    			scrollCheck();
	    		});

	    	}

	    	// Add our event listeners for the hamburger
	    	vars.trigger.on('click',function(){
    			if (!vars.mobileOpen) {
    				openMobileNav();
    			} else {
    				closeMobileNav();
    			}
    		});
    		
	    }

	    function closeMobileNav(){
	    	vars.body.removeClass('mobileNavOpen').addClass('mobileNavClosing');
	    	setTimeout(function(){
	    		vars.body.removeClass('mobileNavClosing');
	    		vars.win.scrollTop(vars.scrollPosition);
	    	},600);
	    	vars.mobileOpen = false;
	    }

	    function openMobileNav(){
	    	vars.scrollPosition = vars.win.scrollTop();
	    	vars.body.addClass('mobileNavOpen').css({top:-vars.scrollPosition});
	    	vars.mobileOpen = true;
	    }

	    // Shows/hides header background on home page as we scroll
	    function scrollCheck(){
	    	if ((vars.headerOn) && (!vars.body.hasClass('mobileNavOpen'))) {
	    		if (vars.win.scrollTop() < vars.scrollLine) {
	    			vars.body.removeClass(vars.scrollClass);
	    			vars.headerOn = false;
	    		}
	    	} else {
	    		if (vars.win.scrollTop() > vars.scrollLine) {
	    			vars.body.addClass(vars.scrollClass);
	    			vars.headerOn = true;
	    		}
	    	}
    	}

    };
 
}( jQuery ));


// Fix the pricing options so if the screen is small
// the middle option is centered on the screen
(function( $j ) {
 
    $j.fn.pricingScroll = function( actions ) {

 		return this.each(function() {

 			var vars = {
    			window: $j('.options',this),
    			pricing: $j('#prices',this)
    		};

    		if (vars.pricing.width() > vars.window.width()) {
    			calculateScroll();
    		}

    		function calculateScroll() {
    			var scroll = (vars.pricing.width() / 2) - (vars.window.width() / 2) + 30;
    			vars.window.scrollLeft(scroll);
    		}

	    });

    };
 
}( jQuery ));

$j(document).ready(function(){
	$j('body').mobileHeader();
	$j('#pricing').pricingScroll();

	$j('#content').each(function(){
		if ($j(this).height() > 800) {
			$j(this).addClass('noAngle');
		}
	});
});