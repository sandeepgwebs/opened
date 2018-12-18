var httpScript = function() {
	"use strict";
    $(".generateNewAPI").on("click", function(){
        $.ajax({
            url: base_url + "ajax/generateAPI",
            type: "POST",
            dateType: 'json',
            success: function(data){
                if(data['status'] == true || data['status'] == 'true'){
                    $("input[name='api_key']").val(data['api_key']);
                    $("input[name='secret_key']").val(data['secret_key']);
                }
            }
        });
    });


    $("[rel='ajaxUpdate']").on("change", function(){
        var sourceElement   =   $(this).attr('data-source');
        var outputElement   =   $(this).attr('data-output');
        var outputElement2  =   $(this).attr('data-output2');
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

                        if(data['html2']){
                            $('#' + outputElement2).html(data['html2']);
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

            if(data['rows']){
                $('#sample_1').dataTable().fnClearTable();
                $('#sample_1').dataTable().fnAddData(data['rows']);

                httpScript();
            }

            if(data['elementValue']){
                $("#" + data['elementValue']['element']).html(data['elementValue']['value']);
            }

            if(data['message']){
                lobibox(data['msgType'], data['message']);
            }

            if(data['resetForm']){
                $(".ajaxForm").trigger('reset');
            }
        },
        dataType: 'json'
    });

    $(".ajaxHref").on("click", function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        console.log(href);
        $.ajax({
            url: href,
            type: "get",
            dataType: 'json',
            success: function (data){
                if(data['status'] == true || data['status'] == 'true'){

                }

                if(data['message']){
                    lobibox(data['msgType'], data['message']);
                }
            }
        });
    });
    

}

httpScript();