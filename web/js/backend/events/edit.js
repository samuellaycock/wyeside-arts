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


function ajaxLoadEventImages(eventId)
{
    $.ajax({
        url: '/system/events/'+eventId+'/images',
        method: 'GET',
        success: function(result){
            $('#event-images').html(result);
        }
    });
}


function ajaxDeleteImage(imageId)
{
    $.ajax({
        url: '/system/images/'+imageId,
        method: 'DELETE',
        success: function(result){
            $('#event-images').html(result);
        }
    });
}


function ajaxSetMainImage(imageId)
{
    $.ajax({
        url: '/system/images/'+imageId+'/set-main',
        method: 'PATCH',
        success: function(result){
            $('#event-images').html(result);
        }
    });
}