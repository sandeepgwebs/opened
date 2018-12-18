var Script = function () {

//    sidebar dropdown menu

    jQuery('#sidebar .sub-menu > a').click(function () {
        var last = jQuery('.sub-menu.open', $('#sidebar'));
        last.removeClass("open");
        jQuery('.arrow', last).removeClass("open");
        jQuery('.sub', last).slideUp(200);
        var sub = jQuery(this).next();
        if (sub.is(":visible")) {
            jQuery('.arrow', jQuery(this)).removeClass("open");
            jQuery(this).parent().removeClass("open");
            sub.slideUp(200);
        } else {
            jQuery('.arrow', jQuery(this)).addClass("open");
            jQuery(this).parent().addClass("open");
            sub.slideDown(200);
        }
    });

//    sidebar toggle

    $('.icon-reorder').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-180px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '180px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar
    $(".sidebar-scroll").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '5', cursorborderradius: '0px', background: '#404040', cursorborder: ''});

    $("html").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '8', cursorborderradius: '0px', background: '#404040', cursorborder: '', zindex: '1000'});


// theme switcher

    var scrollHeight = '60px';
    jQuery('#theme-change').click(function () {
        if ($(this).attr("opened") && !$(this).attr("opening") && !$(this).attr("closing")) {
            $(this).removeAttr("opened");
            $(this).attr("closing", "1");

            $("#theme-change").css("overflow", "hidden").animate({
                width: '20px',
                height: '22px',
                'padding-top': '3px'
            }, {
                complete: function () {
                    $(this).removeAttr("closing");
                    $("#theme-change .settings").hide();
                }
            });
        } else if (!$(this).attr("closing") && !$(this).attr("opening")) {
            $(this).attr("opening", "1");
            $("#theme-change").css("overflow", "visible").animate({
                width: '226px',
                height: scrollHeight,
                'padding-top': '3px'
            }, {
                complete: function () {
                    $(this).removeAttr("opening");
                    $(this).attr("opened", 1);
                }
            });
            $("#theme-change .settings").show();
        }
    });

    jQuery('#theme-change .colors span').click(function () {
        var color = $(this).attr("data-style");
        setColor(color);
    });

    jQuery('#theme-change .layout input').change(function () {
        setLayout();
    });

    var setColor = function (color) {
        $('#style_color').attr("href", "css/style-" + color + ".css");
    }

// widget tools

    jQuery('.widget .tools .icon-chevron-down, .widget .tools .icon-chevron-up').click(function () {
        var el = jQuery(this).parents(".widget").children(".widget-body");
        if (jQuery(this).hasClass("icon-chevron-down")) {
            jQuery(this).removeClass("icon-chevron-down").addClass("icon-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("icon-chevron-up").addClass("icon-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.widget .tools .icon-remove').click(function () {
        jQuery(this).parents(".widget").parent().remove();
    });
    
//    tool tips

    $('.element').tooltip();

    $('.tooltips').tooltip();

    $("[rel=tooltip]").tooltip({html:true});

//    popovers

    $('.popovers').popover();

// scroller

    $('.scroller').slimscroll({
        height: 'auto'
    });


    /********* custom scripts ***************/

    $(".key_source").on('keyup blur change', function(){
        $(".key_output").val(convertToSlug($(".key_source").val()));

    });
    function convertToSlug(Text){
        return Text
            .toLowerCase()
            .replace(/[^\w ]+/g,'')
            .replace(/ +/g,'-')
            ;
    }

    $(".remove_image").click(function(){
        $('input[name=' + $(this).attr('data-tag') + ']').val('true');
    })

    $('#date1').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('#date2').datepicker({
        format: 'yyyy-mm-dd'
    });

    $(".chzn-select").chosen();
    $(".chzn-select-deselect").chosen({allow_single_deselect:true});

    $('#timepicker4').timepicker({
        minuteStep: 1,
        template: 'modal',
        showSeconds: true,
        showMeridian: false
    });

    $('#default_datetimepicker, #default_datetimepicker1, #default_datetimepicker2').datetimepicker({
        formatTime:'H:i',
        formatDate:'d.m.Y',
        defaultTime:'10:00',
        timepickerScrollbar:true,
        step:30
    });
    
    
    $(".actionBtn").on("click", function() {
        $currentAction = $(this).attr('data-action');
        if ($currentAction == "list") {
            $(this).attr('data-action', 'add');
            $(".divForm").show();
            $(".divList").hide();
            $(this).html('Show All');
        } else if ($currentAction == "add") {
            $(this).attr('data-action', 'list');
            $(".divForm").hide();
            $(".divList").show();
            $(this).html('Add New');
        } else if ($currentAction == "listEdit") {
            $(this).attr('data-action', 'edit');
            $(".divForm").show();
            $(".divList").hide();
            $(this).html('Show All');
        } else if($currentAction == "edit"){
            $(this).attr('data-action', 'listEdit');
            $(".divForm").hide();
            $(".divList").show();
            $(this).html('Edit');
        }
    });

    $('#text-toggle-button').toggleButtons({
        width: 220,
        label: {
            enabled: "Copy",
            disabled: "Insert New",
        }
    });


    $('.listBox #btnRight').click(function (e) {
        $('select').moveToListAndDelete('#lstBox1', '#lstBox2');
        e.preventDefault();
    });

    $('.listBox #btnAllRight').click(function (e) {
        $('select').moveAllToListAndDelete('#lstBox1', '#lstBox2');
        e.preventDefault();
    });

    $('.listBox #btnLeft').click(function (e) {
        $('select').moveToListAndDelete('#lstBox2', '#lstBox1');
        e.preventDefault();
    });

    $('.listBox #btnAllLeft').click(function (e) {
        $('select').moveAllToListAndDelete('#lstBox2', '#lstBox1');
        e.preventDefault();
    });


    /*$('#nestable_list_1').nestable({
            group: 1,
            noDragClass: "dd-nodrag"
        });*/
        //.on('change', updateOutput);
}();



$(".fancybox").fancybox();

$(".fancyboxIframe").fancybox({
    maxWidth	: 1800,
    maxHeight	: 900,
    fitToView	: false,
    width		: '98%',
    height		: '98%',
    autoSize	: false,
    closeClick	: false,
    openEffect	: 'none',
    closeEffect	: 'none',
    iframe: {
        scrolling : 'auto',
        preload   : true
    }
});

function lobibox(type, msg){
    Lobibox.notify(type, {
        size: 'mini',
        closable: true,
        closeOnClick: true,
        delay: false,
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'center top', //or 'center bottom'
        msg: msg
    });
}


$("input[name='sendNotification']").on("change, click", function(){
    if($(this).is(':checked')){
        $(".sendNotificationClass").show();
    }else{
        $(".sendNotificationClass").hide();

    }
});
