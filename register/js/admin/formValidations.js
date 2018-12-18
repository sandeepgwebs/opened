$(function() {


    // regex validation method
    $.validator.addMethod("regex", function(value, element, regexpr) {
        return regexpr.test(value);
    }, "Please enter a valid data.");
    $.validator.addMethod('minStrict', function (value, el, param) {
        return value > param;
    });
    $.validator.addMethod("lettersonly", function(value, element){
        return this.optional(element) || /^[a-z," "]+$/i.test(value);
    }, "Letters and spaces only please");

    $.validator.addMethod("isEqual", function(value, element, param) {
        return value == param;
    }, "Invalid Value.");

    $.validator.addMethod('lessthan', function(value, element, param) {
        return this.optional(element) || value <= param;
    }, 'Invalid value');
    $.validator.addMethod('greatorthan', function(value, element, param) {
        return this.optional(element) || value >= param;
    }, 'Invalid value');
    jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^\w+$/i.test(value);
    }, "Letters, numbers, and underscores only please");



    // Setup form validation on the #register-form element
    $("#packageForm").validate({
        ignore: ":hidden",
        rules: {
            package_name: {
                required: true,
            },
            num_exams: {
                required: true,
                digits: true
            },
            num_st: {
                required: true,
                digits: true
            },
            num_pt: {
                required: true,
                digits: true
            },
            num_flt: {
                required: true,
                digits: true
            },
            validity: {
                required: true,
                digits: true
            },
            amount: {
                required: true,
                digits: true
            },
        },

        // Specify the validation error messages
        messages: {
            package_name: "Invalid Package Name",
            num_exams: "Invalid Number of exams",
            num_st: "Invalid Number of sectional test",
            num_pt: "Invalid Number of practice test",
            num_flt: "Invalid Number of full length test",
            validity: "Invalid Validity",
            amount: "Invalid Amount"
        },
        errorElement: "div",
        errorClass: "errorMsg",
        wrapper: "div",
        /*errorPlacement: function(error, element) {
            //error.appendTo($('#requestFormError'));
            error.appendTo($('#error_' + element.context.name));
        },*/
    });
    
    // Setup form validation on the #register-form element
    $("#frmInstitute").validate({
        ignore: ":hidden",
        rules: {
            name: {
                required: true,
            },
            email_id:{
                required: true,
                email: true
            },
            password:{
                required: true,
            },
            contact_number: {
                required: true,
                minlength: 8,
                maxlength: 12,
                digits: true
            },
            domain:{
                required: true,
                regex: /^[a-zA-Z0-9-\.]+\.[a-z]{2,4}/
            },
        },

        // Specify the validation error messages
        messages: {
            name: "Invalid Institute Name",
            email: "Invalid Email ID",
            password: "Invalid Password",
            contact_number: {
                required: "Invalid Contact Number",
                minlength: "Contact number should be between 8-12 digits",
                maxlength: "Contact number should be between 8-12 digits",
                digits: "Invalid Contact Number",
            },
            domain: "Invalid Domain Name",
        },
        errorElement: "div",
        errorClass: "errorMsg",
        wrapper: "div",
        /*errorPlacement: function(error, element) {
            //error.appendTo($('#requestFormError'));
            error.appendTo($('#error_' + element.context.name));
        },*/
    });

});