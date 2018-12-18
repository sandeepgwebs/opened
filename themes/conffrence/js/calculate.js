/**
 * Created by Manjot on 02-Mar-17.
 */
$(document).ready(function() {
        //$('.field-fee-no_of_papers').hide();
    $(document).on('change', "#fee-user_type", function () {
        if($('#fee-user_type').val() == 3 || $('#fee-user_type').val() == 4){
           $('.field-fee-no_of_papers').hide();
        } else {
           $('.field-fee-no_of_papers').show();
        }
    });
    $('.modal').on('hidden.bs.modal', function(){ $(this).find('form')[0].reset();$('#feecal').html(''); });
});

