/**
 * Created by Manjot on 02-Mar-17.
 */
$(document).ready(function() {

    $('.field-fee-file').hide();
    $('.field-fee-copyright_form').hide();
    $('.field-fee-no_of_papers').hide();
    $(document).on('change', "#fee-user_type", function () {
        if($('#fee-user_type').val() == 3 || $('#fee-user_type').val() == 4){
            $('.field-fee-file').hide();
            $('.field-fee-copyright_form').hide();
            $('field-fee-no_of_papers').hide();
        } else {
            $('.field-fee-file').show();
            $('.field-fee-copyright_form').show();
            $('.field-fee-no_of_papers').show();
        }
    });
});

