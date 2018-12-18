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
    jQuery.validator.addMethod("specialChrs", function (element, value) {
        return new RegExp('^[a-zA-Z0-9 ]+$').test(value)
    }, "Special Characters not permitted");

    $.validator.addMethod("fmod", function (value,element, param) {
        return this.optional(element) || (value % param) == 0;
    }, "Investment Amount not valid.");

    $.validator.addMethod("not_email",function(value, element) {
        if(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,4})+$/.test( value )){
            return false;
        }else{
            return true;
        }
    },"Should not be an Email.");


    $(".ajaxForm").validate({
        ignore: ":hidden",
        errorElement: "div",
        wrapper: "div",
        errorClass: "errorMsg",
    });

    $("#manuscriptForm").validate({
        ignore: ":hidden",
        rules: {
            "author_first_name[]":{
                required:true
            },
            "author_last_name[]":{
                required:true
            },
            "author_email[]":{
                required:true,
                email: true
            },
            "author_phone[]":{
                required:true,
                minlength: 8,
                maxlength: 15,
                digits: true
            },
            "author_country[]":{
                required:true
            },
            "author_organization[]":{
                required:true
            },
        },
        messages: {

        },
        errorElement: "div",
        wrapper: "div",
        errorClass: "errorMsg",
    });
});