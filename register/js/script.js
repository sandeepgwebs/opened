jQuery(document).ready(function(){
"use strict";




/*=================== Cart Item Cross Button ===================*/  
$(".cart-item i.ti-close").on("click",function(){
    $(this).parent().parent().parent().remove();
})
$(".checkout-page .cart-heading").on("click",function(){
    $(".cart-detail , .cart-bottom").slideUp();
    $(this).parent().find(".cart-detail , .cart-bottom").slideToggle();
});



/*=================== Team Page ===================*/  
var l = $("#team-detail-img > ul li").length;
for (var i=0; i<=l; i++) {
    var team_list = $("#team-detail-img > ul li").eq(i);    
    var team_width = $(team_list).find("p").width();
    $(team_list).find("p").css({
        "margin-right":-team_width-21
    })
}


/*=================== Signup and Login Buttons ===================*/  
$(".registration-btn li a").on("click",function(){
    $("body").find(".popup").fadeIn();
    if ($(this).hasClass("signup-btn")){
        setTimeout(function(){
            $(".popup").find(".signup-form").addClass("active").fadeIn();
        });
    }
    else if ($(this).hasClass("login-btn")){
        setTimeout(function(){
            $(".popup").find(".login-form").addClass("active").fadeIn();
        });
    }
    return false;
});
$("html, .close-btn").on("click",function(){
    $(".popup-form").removeClass("active").slideUp();
    $("body").find(".popup").fadeOut();
});
$(".popup-form").on("click",function(e){
    e.stopPropagation();
});



/*=================== Responsive Menu ===================*/  
$("#responsive-menu > span.open-menu").on("click",function(){
    $(this).next(".menu-links").toggleClass("slide");
    $("body").toggleClass("move");
    $("#responsive-menu .menu-links > ul li.menu-item-has-children ul").slideUp();    
});
$("#responsive-menu .menu-links > ul li.menu-item-has-children > a").on("click",function(){
    $(this).next("ul").slideToggle();
    return false;
});
$("html").on("click",function(){
    $("#responsive-header .menu-links").removeClass("slide");
    $("body").removeClass("move");
});
$("#responsive-menu > span.open-menu,#responsive-menu .menu-links > ul li.menu-item-has-children a").on("click",function(e){
    e.stopPropagation();
});
$("#responsive-menu > span.show-topbar").on("click",function(){
    $(this).parent().parent().find(".topbar").slideToggle();
    $(this).toggleClass("slide");
});







/*=================== Ajax Contact Form ===================*/  
$('.submit').on('click',function(){
    var button_id = $(this).attr('id');
    var form = $(this).parent().parent().parent();
    var action = $(form).attr('action');
    var msg = $(form).prev();
    var _name = $(form).find('input[name="name"]').val();
    var _email = $(form).find('input[name="email"]').val();
    var _comments = $(form).find('textarea[name="comments"]').val();
    /*$(msg).empty();
        $(this)
        .after('<img src="images/ajax-loader.gif" class="loader" />')
        .attr('disabled','disabled');*/

    $.post(action, {
        name: _name,
        email: _email,
        comments: _comments,
    },
        function(data){
            $(msg).html(data);
            $(msg).slideDown('slow');
            //$(form + 'img.loader').fadeOut('slow',function(){$(this).remove()});
            $(this).removeAttr('disabled');
            if(data.match('success') != null) $(form).slideUp('slow');

        }
    );

    return false;
});




/*=================== STICKY HEADER ===================*/ 
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll >= 70) {
        $(".stick").addClass("sticky");
    }
    else{
        $(".stick").removeClass("sticky");
    }
}); 


/*=================== Set The Header Margin ===================*/  
var menu_height = $(".menu").height();
if ($(".menu").hasClass("transparent")){
    $("header").css({"margin-bottom":"0"})
}
else if ($(".menu").hasClass("black-transparent")){
    $("header").css({"margin-bottom":"0"})
}
else {
    $("header").css({"margin-bottom":menu_height})
}



$(".donate-btn").on("click",function(){
    $(this).next(".enter-amount").toggleClass("proceed");
});


$(".frequency li a").on("click",function(){
    $(".frequency li a").removeClass("active");
    $(this).addClass("active");
});


var wpdonation_button = $(".donation-figures li a"); 
$(".donation-figures li a").on("click",function(){
    $(wpdonation_button).removeClass("active");
    $(this).addClass("active");
    var amount_val = $(this).html();
    $(".donation-amount .textfield textarea").html(amount_val);    
    return false;
});

$(".call-popup").on("click",function(){
    $(".donation-popup").fadeIn();
    $("body,html").addClass("stop");
    return false;
    
});
$(".proceed-to-donate").on("click",function(){
    $(this).parent().parent().parent().find(".select-payment, .personal-detail").slideDown();
    return false;
});
$(".popup-centralize span.close").on("click",function(){
    $(this).parent().parent().parent().fadeOut();
    $("body,html").removeClass("stop");
});




/*=================== Video Active Class ===================*/  
$(".video > a").on("click",function(){
    $(this).parent().toggleClass("active");
    return false;
});




/*=================== Events Toggle ===================*/  
var event_desc = $(".event-desc");
$(".event-toggle:first").addClass("active").find(".event-desc").slideDown();

$(".event-toggle").on("click",function(){
    $(event_desc).slideUp();
    $(this).find(".event-desc").slideDown();
    $(".event-toggle").removeClass("active");
    $(this).addClass("active");
});



/*=================== Accordion ===================*/   
$(function() {
$('.toggle .content').hide();
$('.toggle h2:first').addClass('active').next().slideDown(500).parent().addClass("activate");
$('.toggle h2').on("click",function() {
    if($(this).next().is(':hidden')) {
        $('.toggle h2').removeClass('active').next().slideUp(500).removeClass('animated zoomIn').parent().removeClass("activate");
        $(this).toggleClass('active').next().slideDown(500).addClass('animated zoomIn').parent().toggleClass("activate");
    }
});
});


/*=================== En Scroll ===================*/  
$('.menu-links > ul, .sideheader-menu').enscroll({
    showOnHover: false,
    verticalTrackClass: 'track3',
    verticalHandleClass: 'handle3'
}); 






/*=================== LightBox ===================*/  
$(function() {
    var foo = $('.lightbox , .gallery-img');
    foo.poptrox({
        usePopupCaption: true
    });
});


/*=================== SideHeader ===================*/  
$(".sideheader .c-hamburger").on("click",function(){
    $(this).parent().toggleClass("show");
    $(this).parent().find(".side-megamenu").removeClass("active");
    $(".sideheader-menu > ul li.menu-item-has-children > ul").slideUp();
    $(".sideheader-menu > ul li.menu-item-has-children > a").removeClass("active");
});
$(".sideheader-menu > ul li.menu-item-has-children > a").on("click",function(){
    $(this).next("ul").slideToggle(); 
    $(this).toggleClass("active");
    $(this).parent().find(".side-megamenu").toggleClass("active");
    return false;
});



$(".select").select2();



});/*=== Document.Ready Ends Here ===*/ 		

jQuery(window).load(function(){
"use strict";

function delay(){
    $(".banner-popup").fadeIn();
};
window.setTimeout( delay, 3000 );

$(".banner-popup .close").on("click", function(){
    $(this).parent().parent().parent().fadeOut();
});


$('.parallax').scrolly({bgParallax: true});


    $('.clients-testimonials').owlCarousel({
        autoplay:true,
        autoplayTimeout:2500,
        smartSpeed:2000,
        loop:true,
        dots:false,
        nav:false,
        margin:0,
        singleItem:true,
        mouseDrag:true,
        items:3,
        responsive : {
            0 : {items : 1},
            480 : {items :1},
            768 : {items : 2},
            1200 : {items : 3},
        },
        autoHeight:false,
        animateIn:"fadeIn",
        animateOut:"fadeOut",
    });
});/*=== Window.Load Ends Here ===*/


// custom //
var $lifeStage = "";
var $ageSelector = "";
var $riskInvestment = "";
$(".lifeStage li a").on("click", function(){
    $(".lifeStage li a.active").removeClass('active');
    $(this).addClass('active');
    $lifeStage = $(this).parents('li').attr('data-life');
});
$(".ageSelector li a").on("click", function(){
    $(".ageSelector li a.active").removeClass('active');
    $(this).addClass('active');
    $ageSelector = $(this).parents('li').attr('data-age');
});
$(".riskInvestment div").on("click", function(){
    $(".riskInvestment div.active").removeClass('active');
    $(this).addClass('active');
    $riskInvestment = $(this).attr('data-risk');
});

$(".investmentCheck .next").on("click", function () {
    if($lifeStage != "" && $ageSelector != ""){
        $(".steps").fadeOut();
        $('.' + $(this).attr('data-step')).fadeIn();
    }
});

$("input[name='investmentType']").on("click", function() {
    investmentType = $("input[name='investmentType']:checked").val();
    if(investmentType == "lumpsum"){
        $("input[name='amount[]']").attr('placeholder', 'Min Rs. 5,000');
        $(".sip").hide();
    }else{
        $("input[name='amount[]']").attr('placeholder', 'Min Rs. 1,000');
        $(".sip").show();
    }

    if($(this).parents('form').find('input').hasClass('errorMsg')){
        $(this).parents('form').valid();
    }
});

$("input[name='scheme_id[]']").on("click", function(){
    if($(this).is(':checked')){
        $(this).parents('tr').find('input[type="text"]').removeAttr('disabled');
        $(this).parents('tr').find('div.errorMsg').show();
    }else{
        $(this).parents('tr').find('input[type="text"]').attr('disabled', 'disabled');
        $(this).parents('tr').find('div.errorMsg').hide();
    }

    updateTotal();
});


$("input[name='amount[]']").on("change", function(){
    updateTotal();
});

Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
function updateTotal(){
    var totalAmount = 0;
    $("input[name='amount[]']").each(function (index, value) {
        if($(this).attr('disabled') != "disabled" && $(this).val() != ""){
            var amount = $(this).val();
            totalAmount += parseInt(amount);
        }
    });
    totalAmount = totalAmount.formatMoney(0, '.', ',');
    $(".totalInvestment").html('<i class="fa fa-inr"></i> ' + totalAmount);
}


$("[rel='popups']").on("click", function(){
    var source = $(this).attr('data-ref');
    setTimeout(function(){
        $('.' + source)
            .addClass("active")
            .fadeIn();
        $('.popup').show();
    });
});

function investmentValidation(){
    errorFlag       =   true;
    investmentType  =   "lumpsum";

    if ($("input[name='investmentType']:checked").val() == "sip") {
        investmentType = "sip";
    }

    $("input[name='amount[]']").each(function (index, value) {
        errorMessage    =   "";
        if($(this).attr('disabled') != "disabled"){
            amountValue = $(this).val();
            schemeID = $(this).attr('schemeID')
            if(amountValue < 5000 && investmentType == "lumpsump"){
                errorMessage = "Amount should be greater than  Rs. 5,000";
            }
            if(amountValue < 1000 && investmentType == "sip"){
                errorMessage = "Amount should be greater than  Rs. 1,000";
            }

            if((amountValue % 1000) != 0){
                errorMessage = "Amount should be in multiples of Rs. 1,000";
            }

            if(amountValue == ""){
                errorMessage = "Required Investment Amount!";
            }

            if(errorMessage != ""){
                errorFlag = false;
                $("#" + schemeID)
                    .addClass('errorMsg')
                    .html(errorMessage);
            }else{

                $("#" + schemeID).removeClass('errorMsg').html("");
            }
        }
    });
    return errorFlag;
}


