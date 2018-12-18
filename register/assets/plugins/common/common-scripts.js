var Script = function () {

}();

$('[data-toggle="tooltip"]').tooltip();
/*
$(".fancybox").fancybox();*/
/*$(".dob").datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: "-90:-18",
    maxDate: '-18y',
    dateFormat: 'yy-mm-dd'
});*/

function lobibox(type, msg){
    Lobibox.notify(type, {
        size: 'mini',
        closable: true,
        closeOnClick: true,
        delay: false,
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'center top', //or 'center bottom'
        msg: msg,
        iconSource: 'fontAwesome',
        delay: 5000,                // Hide notification after this time (in miliseconds)
        sound: false,
    });
}

