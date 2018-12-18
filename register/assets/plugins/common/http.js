(function($) {
	"use strict";
    
    $(".reloadCaptcha").on("click", function(){
        var source = $(this).attr('data-source');

        $.ajax({
            url: base_url + 'ajax/reloadCaptcha',
            success: function (data) {
                if (data['status'] == "true" || data['status'] == true) {
                    $(source).html(data.captcha.image);
                }
            },
            dataType: 'json'
        });
    });


    $("[rel='ajaxUpdate']").on("change", function(){
        var sourceElement   =   $(this).attr('data-source');
        var outputElement   =   $(this).attr('data-output');
        var href            =   $(this).attr('data-href');

        if($("#" + $(this).attr('data-source') + " option:selected").val()){
            $.ajax({
                url: href,
                type: "POST",
                dataType: 'json',
                data: sourceElement + '=' + $("#" + sourceElement + " option:selected").val(),
                success: function (data){
                    if(data['status'] == true || data['status'] == 'true'){
                        $('#' + outputElement).html(data['html']);

                        if($("#" + outputElement).hasClass("chzn-select")){
                            $("#" + outputElement).val('').trigger('chosen:updated');
                            $(".chzn-select").val('').trigger("liszt:updated");
                        }
                    }

                    if(data['message']){
                        lobibox(data['msgType'], data['message']);
                    }
                }
            });
        }
    });


    $(".ajaxForm").ajaxForm({
        beforeSubmit: function validator() {
            return $(".ajaxForm").valid();
        },
        success: function (data) {
            if (data['status'] == "true" || data['status'] == true) {
                //$(".ajaxForm").trigger('reset');
            }

            if(data['elementValue']){
                $("#" + data['elementValue']['element']).html(data['elementValue']['value']);
            }

            if(data['elementValue2']){
                $("#" + data['elementValue2']['element']).html(data['elementValue2']['value']);
            }

            if(data['message']){
                lobibox(data['msgType'], data['message']);
            }

            if(data['redirectURL']){
                if(data['redirectionDelay']){
                    setTimeout(function(){
                        window.location = data['redirectURL'];
                    }, data['redirectionDelay']);
                }else{
                    window.location = data['redirectURL'];
                }
            }

            if(data['resetForm']){
                $(".ajaxForm").trigger('reset');
            }
        },
        dataType: 'json'
    });

    $(".ajaxForm2").ajaxForm({
        beforeSubmit: function validator() {
            return $(".ajaxForm2").valid();
        },
        success: function (data) {
            if (data['status'] == "true" || data['status'] == true) {
                //$(".ajaxForm").trigger('reset');
            }

            if(data['elementValue']){
                $("#" + data['elementValue']['element']).html(data['elementValue']['value']);
            }

            if(data['message']){
                lobibox(data['msgType'], data['message']);
            }

            if(data['redirectURL']){
                if(data['redirectionDelay']){
                    setTimeout(function(){
                        window.location = data['redirectURL'];
                    }, data['redirectionDelay']);
                }else{
                    window.location = data['redirectURL'];
                }
            }
        },
        dataType: 'json'
    });

    $(".ajaxForm3").ajaxForm({
        beforeSubmit: function validator() {
            return $(".ajaxForm3").valid();
        },
        success: function (data) {
            if (data['status'] == "true" || data['status'] == true) {
                //$(".ajaxForm").trigger('reset');
            }

            if(data['elementValue']){
                $("#" + data['elementValue']['element']).html(data['elementValue']['value']);
            }

            if(data['message']){
                lobibox(data['msgType'], data['message']);
            }

            if(data['redirectURL']){
                if(data['redirectionDelay']){
                    setTimeout(function(){
                        window.location = data['redirectURL'];
                    }, data['redirectionDelay']);
                }else{
                    window.location = data['redirectURL'];
                }
            }
        },
        dataType: 'json'
    });
})(window.jQuery);