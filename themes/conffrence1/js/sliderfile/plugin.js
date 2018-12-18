

(function($) {
	$.fn.stopNav = function(opt) {
		
		var element = $(this);
		element.wrap("<div class='min_hc'></div>").parent().css({
			float:'left',
			minHeight: element.height(),
			position:'relative',
			width:'100%',
		});
		
		var offst = element.offset();
		offst = Math.round(offst.top);
		var options = $.extend({
            offset:offst,
			onFixNav:function(){
				return;
			},
			onInheritNav:function(){
				return;
			},
        }, opt );
		
		$(window).scroll(function(){
			shownav(options);
		});
		shownav(options);
		
		function shownav(options){
			if ($(window).scrollTop() > options.offset ) {
				element.css('position','fixed');
				options.onFixNav.call(this);
				element.css('padding','3px 0');
				
			} else {
				element.css('position','inherit')
				options.onInheritNav.call(this);
				element.css('padding','0px 0');					
			}
		}
	};
	
	
	
	$.fn.goToTop = function(opt) {
		
		var element = $(this);
		var options = $.extend({
			offset:400,
			animatespeed:800,
		}, opt );
		

		$(window).scroll(function(){
			goTop(options);
		});
		goTop(options);
		
		
		function goTop(){
			if ($(window).scrollTop() > options.offset) {
				element.fadeIn(100);
			} else {
				element.fadeOut(100);
			}
		}
		//Click event to scroll to top
		element.click(function(){
			$('html, body').animate({scrollTop : 0},options.animatespeed);
			return false;
		});	
	};
	
	
	
	$.fn.cssAnimate = function() {
		
		var $elems = $('.animateblock');
		var winheight = $(window).height();
		
		$(window).scroll(function(){
			animate_elems();
			$('.animated').css('opacity','1');
		});
		animate_elems();
		$('.animated').css('opacity','1');
		
		function animate_elems() {
		    wintop = $(window).scrollTop(); // calculate distance from top of window
			// loop through each item to check when it animates
			$elems.each(function(){
				$elm = $(this);
				$elmClass = $elm.attr('data-animate-class');
				if($elm.hasClass('animated')) { return true; } // if already animated skip to the next item
				topcoords = $elm.offset().top; // element's distance from top of page in pixels
				if(wintop > (topcoords - (winheight*.75))) {
				// animate when top of the window is 3/4 above the element
					$elm.addClass($elmClass+' animated');  
				}
			});
		} // end animate_elems()
	};
	
	
})(jQuery);







