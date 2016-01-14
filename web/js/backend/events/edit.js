$( document ).ready(function() {
    $(".upload-form").bind('submit', function(){
        var wrapper = $(this).find('.spinner-wrapper');
        $(wrapper).css('display', 'block');
    });
});

function resetSpinner(formId){
    $("#"+formId).find('.spinner-wrapper').css('display', 'none');
    $("#"+formId).trigger("reset");
}