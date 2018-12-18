$(document).ready(function() {
	$("body").fadeIn();
    $("body").cssAnimate();
	var authorGroup = $( ".author" ).last().clone();
	

	
    if ($(".intro-text").length) {
        $(".intro-text").addClass('fadeInRight animated');
    }
    $(".serv-inner").each(function() {
        var src = $(this).find("img").attr("src");
        $(this).css("background-image", "url(" + src + ")");
    });
    if ($('.bxslider').length) {
        $('.bxslider').bxSlider({
            auto: true,
            autoControls: true,
            pager: true
        });
    } 
	
    $(".view-more-text").click(function() {
        $(this).hide();
        $("#about").slideDown();
    });
	
	$(".addk").click(function() {
		var ct = $( ".author" ).length-1;
		authorGroup.find(".field-papers-fname"+ct).removeClass("field-papers-fname"+ct).addClass("field-papers-fname"+(ct+1));
		authorGroup.find(".field-papers-fname"+(ct+1)).find(".control-label").attr("for","papers-fname"+(ct+1));
		authorGroup.find(".field-papers-fname"+(ct+1)).find(".form-control").attr("id","papers-fname"+(ct+1)).attr("name","Papers[fname"+(ct+1)+"]");
		
		authorGroup.find(".field-papers-lname"+ct).removeClass("field-papers-lname"+ct).addClass("field-papers-lname"+(ct+1));
		authorGroup.find(".field-papers-lname"+(ct+1)).find(".control-label").attr("for","papers-lname"+(ct+1));
		authorGroup.find(".field-papers-lname"+(ct+1)).find(".form-control").attr("id","papers-lname"+(ct+1)).attr("name","Papers[lname"+(ct+1)+"]");
		
		authorGroup.find(".field-papers-email"+ct).removeClass("field-papers-email"+ct).addClass("field-papers-email"+(ct+1));
		authorGroup.find(".field-papers-email"+(ct+1)).find(".control-label").attr("for","papers-email"+(ct+1));
		authorGroup.find(".field-papers-email"+(ct+1)).find(".form-control").attr("id","papers-email"+(ct+1)).attr("name","Papers[email"+(ct+1)+"]");
		
		authorGroup.find(".field-papers-country_id"+ct).removeClass("field-papers-country_id"+ct).addClass("field-papers-country_id"+(ct+1));
		authorGroup.find(".field-papers-country_id"+(ct+1)).find(".control-label").attr("for","papers-country_id"+(ct+1));
		authorGroup.find(".field-papers-country_id"+(ct+1)).find(".form-control").attr("id","papers-country_id"+(ct+1)).attr("name","Papers[country_id"+(ct+1)+"]");
		
		authorGroup.find(".field-papers-organization"+ct).removeClass("field-papers-organization"+ct).addClass("field-papers-organization"+(ct+1));
		authorGroup.find(".field-papers-organization"+(ct+1)).find(".control-label").attr("for","papers-organization"+(ct+1));
		authorGroup.find(".field-papers-organization"+(ct+1)).find(".form-control").attr("id","papers-organization"+(ct+1)).attr("name","Papers[organization"+(ct+1)+"]");
		
		authorGroup.find(".field-papers-webpage"+ct).removeClass("field-papers-webpage"+ct).addClass("field-papers-webpage"+(ct+1));
		authorGroup.find(".field-papers-webpage"+(ct+1)).find(".control-label").attr("for","papers-webpage"+(ct+1));
		authorGroup.find(".field-papers-webpage"+(ct+1)).find(".form-control").attr("id","papers-webpage"+(ct+1)).attr("name","Papers[webpage"+(ct+1)+"]");
		
		authorGroup.find(".field-papers-corresp"+ct).removeClass("field-papers-corresp"+ct).addClass("field-papers-corresp"+(ct+1));
		authorGroup.find(".field-papers-corresp"+(ct+1)).find("input").attr("id","papers-corresp"+(ct+1)).attr("name","Papers[corresp"+(ct+1)+"]");
		
        authorGroup.appendTo( ".authors" );
		var count = $( ".author" ).length;
        $( ".author" ).last().find(".head4").text("Author "+ count);
		 authorGroup = $( ".author" ).last().clone();
		 $("#papers-count").val(count);
    });
	
	// find menu-item associated with this page and make current:
	$('a').each(function(index, value) { 
		if ($(this).prop("href") === window.location.href) {
			$(this).addClass("current-page");
		} 
	});			$(".popup-gallery a").each(function(){		var url = $(this).find("img").attr("src");		$(this).css("background-image","url("+url+")");	});
	/*if($('.marquee').length && $('.marquee').text() != "") {
		$('.marquee').marquee({
			duration: 12000,
			pauseOnHover: true,
			delayBeforeStart: 0,
		});
	}*/
	
	
	
});


