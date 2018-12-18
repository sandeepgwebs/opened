/*! Customized Jquery from Mahesh Vaghani.  mahesh@templatemela.com  : www.templatemela.com
Authors & copyright (c) 2013: TemplateMela - Megnor Computer Private Limited. */
// Megnor Start
$(document).ready(function () {
							
	$('#header .cart_block dl.products').slimScroll({
		height: '100%'
	});
	$('#block_top_menu li:has(ul)').doubleTapToGo();

//=================== Show or hide tm Vertical menu ========================//

  $('.tmvm-contener .block-title').click(function() {
      //alert('test');
    $('.tmvm-contener .tmvmmenu-content').slideToggle("slow");
    $('.tmvm-contener .block-title').toggleClass('active');
  });

  $('.tm_links_block1 .cat-title').click(function() {
    /*$('.tm_links_block1 .list-block').slideToggle("slow");
    $('.tm_links_block1 .cat-title').toggleClass('active');*/
  });

  
	
	//=================== Show or hide Go Top button ========================//
	$(window).scroll(function() {
		if ($(this).scrollTop() > 500) {
			$('.top_button').fadeIn(500);
		} else {
			$('.top_button').fadeOut(500);
		}
	});							
	$('.top_button').click(function(event) {
		event.preventDefault();		
		$('html, body').animate({scrollTop: 0}, 800);
	});	

	/*======  curosol For Manufacture ==== */
	 var tmbrand = $("#manufacturer-carousel");
      tmbrand.owlCarousel({
     	 items : 5, //10 items above 1000px browser width
     	 itemsDesktop : [1199,4], 
     	 itemsDesktopSmall : [991,3], 
     	 itemsTablet: [767,2], 
     	 itemsMobile : [480,1] 
      });
      // Custom Navigation Events
      $(".tmmanufacture_next").click(function(){
        tmbrand.trigger('owl.next');
      })
      $(".tmmanufacture_prev").click(function(){
        tmbrand.trigger('owl.prev');
      })
	  

    /*======  curosol For Smart Blog ==== */
   var tmblog = $("#tmblog-carousel");
      tmblog.owlCarousel({
       items : 4, //10 items above 1000px browser width
       itemsDesktop : [1199,4], 
       itemsDesktopSmall : [991,3], 
       itemsTablet: [767,2], 
       itemsMobile : [480,1] 
      });
      // Custom Navigation Events
      $(".tmblog_next").click(function(){
        tmblog.trigger('owl.next');
      })
      $(".tmblog_prev").click(function(){
        tmblog.trigger('owl.prev');
      })
    

	 /*======  curosol For Feature PRoduct ==== */
	 var tmfeature = $("#feature-carousel");
      tmfeature.owlCarousel({
     	 items : 4, //10 items above 1000px browser width
     	 itemsDesktop : [1199,4], 
     	 itemsDesktopSmall : [991,3], 
     	 itemsTablet: [479,1], 
     	 itemsMobile : [319,1] 
      });
      // Custom Navigation Events
      $(".feature_next").click(function(){
        tmfeature.trigger('owl.next');
      })
      $(".feature_prev").click(function(){
        tmfeature.trigger('owl.prev');
      })
	  
	  /*======  Curosol For New PRoduct ==== */
	 var tmnewProduct = $("#newproduct-carousel");
      tmnewProduct.owlCarousel({
     	 items : 4, //10 items above 1000px browser width
     	 itemsDesktop : [1199,4], 
     	 itemsDesktopSmall : [991,3], 
     	 itemsTablet: [479,1], 
     	 itemsMobile : [319,1] 
      });
      // Custom Navigation Events
      $(".newproduct_next").click(function(){
        tmnewProduct.trigger('owl.next');
      })
      $(".newproduct_prev").click(function(){
        tmnewProduct.trigger('owl.prev');
      })
	  
	  
	   /*======  curosol For Accessories Product ==== */
	 var tmaccessories = $("#accessories-carousel");
      tmaccessories.owlCarousel({
     	 items : 4, //10 items above 1000px browser width
     	 itemsDesktop : [1199,4], 
     	 itemsDesktopSmall : [991,3], 
     	 itemsTablet: [479,1], 
     	 itemsMobile : [319,1] 
      });
      $(".accessories_next").click(function(){
        tmaccessories.trigger('owl.next');
      })
      $(".accessories_prev").click(function(){
        tmaccessories.trigger('owl.prev');
      })
  
	  /*======  curosol For Category Product ==== */
	 var tmproductcategory = $("#productscategory-carousel");
      tmproductcategory.owlCarousel({
     	 items : 4, //10 items above 1000px browser width
     	 itemsDesktop : [1199,4], 
     	 itemsDesktopSmall : [991,3], 
     	 itemsTablet: [479,1], 
     	 itemsMobile : [319,1] 
      });
      // Custom Navigation Events
      $(".productcategory_next").click(function(){
        tmproductcategory.trigger('owl.next');
      })
      $(".productcategory_prev").click(function(){
        tmproductcategory.trigger('owl.prev');
      })
	  
	  /*======  curosol For Crosssel Product ==== */
	 var tmcrossselling = $("#crossselling-carousel");
      tmcrossselling.owlCarousel({
     	 items : 4, //10 items above 1000px browser width
     	 itemsDesktop : [1199,4], 
     	 itemsDesktopSmall : [991,3], 
     	 itemsTablet: [479,1], 
     	 itemsMobile : [319,1] 
      });
      // Custom Navigation Events
      $(".crossselling_next").click(function(){
        tmcrossselling.trigger('owl.next');
      })
      $(".crossselling_prev").click(function(){
        tmcrossselling.trigger('owl.prev');
      })
	  	  
	  /*======  curosol For topseller Product ==== */

	 var tmbestseller = $("#bestseller-carousel");
      tmbestseller.owlCarousel({
     	 items : 4, //10 items above 1000px browser width
     	 itemsDesktop : [1199,4], 
     	 itemsDesktopSmall : [991,3], 
     	 itemsTablet: [479,1], 
     	 itemsMobile : [319,1] 
      });

      // Custom Navigation Events
      $(".topsellerproduct_next").click(function(){
        tmbestseller.trigger('owl.next');
      })
      $(".topsellerproduct_prev").click(function(){
        tmbestseller.trigger('owl.prev');
      });

	  /*======  curosol For Special Product ==== */

	 var tmspecial = $("#special-carousel");
      tmspecial.owlCarousel({
     	 items : 4, //10 items above 1000px browser width
     	 itemsDesktop : [1199,4], 
     	 itemsDesktopSmall : [991,3], 
     	 itemsTablet: [479,1], 
     	 itemsMobile : [319,1] 
      });

      // Custom Navigation Events
      $(".specialproduct_next").click(function(){
        tmspecial.trigger('owl.next');
      })
      $(".specialproduct_prev").click(function(){
        tmspecial.trigger('owl.prev');
      });
	  
    $('.header_user_info .tm_userinfotitle').click(function(event){
      $(this).toggleClass('active');
      event.stopPropagation();
      $(".user_link").slideToggle("fast");
    });
    $(".user_link").on("click", function (event) {
      event.stopPropagation();
    });
});

function responsivecolumn()
{
	if ($(document).width() <= 991)
	{
		$('.container #columns_inner #left_column').appendTo('.container #columns_inner');
	}
	else if($(document).width() >= 992)
	{
		$('.container #columns_inner #left_column').prependTo('.container #columns_inner');
	}
}
$(document).ready(function(){responsivecolumn();});
$(window).resize(function(){responsivecolumn();});

// top banner

function top_banner(){
   
    if($('body').hasClass('index')){
      $('.banner').show();
    }
   
    $(".close-btn").on("click", function() {
      $(this).fadeOut(100);
      $('.banner').slideUp(1000);
    });
  
}

$(document).ready(function(){top_banner();});

//
$(document).ready(function () {
  $('#search_category').bind("change", function() {
    var space_offset = 1;
    var matches = $('#search_category option:selected').text().search(/\S/);
    var n_spaces = (matches) ? matches : 0;
    $(this).css('text-indent', -(n_spaces*space_offset));
  });
});


// Megnor End


