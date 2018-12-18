(function($) {
    "use strict";

    var authorHTML = $(".authorContainer").html();

    var userDetails;

    var reloadScript = function(){
        $(".add_yourself").on('click', function(){
            var authorNum = $(this).attr('data-author');
            console.log(authorNum);

            $("#author_first_name_" + authorNum).val(userDetails['firstname']);
            $("#author_last_name_" + authorNum).val(userDetails['lastname']);
            $("#author_email_" + authorNum).val(userDetails['primary_email']);
            $("#author_phone_" + authorNum).val(userDetails['phone']);
            $("#author_country_" + authorNum).val(userDetails['country']);
            $("#author_organization_" + authorNum).val(userDetails['designation']);
            $("#author_website_" + authorNum).val(userDetails['website']);
        });
    };

    $.ajax({
        url: base_url + "ajax/getUserDetails",
        type: "POST",
        dataType: "json",
        success:function(data) {
            userDetails = data['data'];
            
            console.log(userDetails);
        }
    });
    
    $(".add_more").on("click", function(){
        var authorNum = $('.authorContainer .well-box').length;

        var newAuthorHTML = authorHTML.replace(/1/g, (authorNum + 1));


        $(".authorContainer").append(newAuthorHTML);

        reloadScript();
    });

    reloadScript();

    $("input[name='payment_mode']").on("change", function(){
        var paymentMode = $(this).val();

        console.log(paymentMode);

        if(paymentMode == "online"){
            $(".offlinePayment").hide();
            $(".onlinePayment").show();
        }else if(paymentMode == "offline"){
            $(".onlinePayment").hide();
            $(".offlinePayment").show();
        }

    });



    $("#total_number").on("change, click", function(){
        var $currentAuthorsCount = $(".authorDetails").length;
        console.log($currentAuthorsCount);
        var $totalAuthors = $(this).val();
        console.log($totalAuthors);
        var newAuthorHTML = authorHTML;
        var $countAuthors = $totalAuthors - $currentAuthorsCount;

        if($countAuthors > 0){
            for(var i=1; i <= $countAuthors; i++){
                $(".authorContainer").append(newAuthorHTML);
            }
        }else{
            for(var i=-1; i >= $countAuthors; i--){
                $(".authorDetails:last").remove();
            }
        }

        reloadScript();
    });
})(window.jQuery);