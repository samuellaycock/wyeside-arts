$(document).ready(function () {
    $(".upload-form").bind('submit', function () {
        var wrapper = $(this).find('.spinner-wrapper');
        $(wrapper).css('display', 'block');
    });

    $("#createShowingBtn").bind('click', function () {
        ajaxCreateShowing(eventId);
    });
    $(".event-status").bind("click", function () {
        ajaxToggleStatus(this, eventId);
    });

    $('#description').trumbowyg({
        fullscreenable: false,
        closable: false
    });
});


function ajaxToggleStatus(element, eventId) {
    if ($(element).hasClass('status-open')) {
        $('.event-status').removeClass('status-open');
        $('.event-status').addClass('status-closed');
        $('.event-status').html('Closed');
        var status = 0;
    } else {
        $('.event-status').removeClass('status-closed');
        $('.event-status').addClass('status-open');
        $('.event-status').html('Open');
        var status = 1;
    }

    $.ajax({
        url: '/system/events/' + eventId + '/update-status/' + status,
        method: 'PATCH'
    });
}

function resetSpinner(formId) {
    $("#" + formId).find('.spinner-wrapper').css('display', 'none');
    $("#" + formId).trigger("reset");
}


function ajaxLoadEventImages(eventId) {
    $.ajax({
        url: '/system/events/' + eventId + '/images',
        method: 'GET',
        success: function (result) {
            $('#event-images').html(result);
        }
    });
}


function ajaxDeleteImage(imageId) {
    $.ajax({
        url: '/system/images/' + imageId,
        method: 'DELETE',
        success: function (result) {
            $('#event-images').html(result);
        }
    });
}


function ajaxSetMainImage(imageId) {
    $.ajax({
        url: '/system/images/' + imageId + '/set-main',
        method: 'PATCH',
        success: function (result) {
            $('#event-images').html(result);
        }
    });
}


function ajaxCreateShowing(eventId) {
    $.ajax({
        url: '/system/events/' + eventId + '/showings',
        method: 'POST',
        data: $("#newShowingForm").serialize(),
        success: function (result) {
            $('#event-showings-table').html(result);
        }
    });
}


function ajaxDeleteShowing(showingId) {
    $.ajax({
        url: '/system/showings/' + showingId,
        method: 'DELETE',
        success: function (result) {
            $('#event-showings-table').html(result);
        }
    });
}


function ajaxUpdateDateType(showingId, element) {
    $.ajax({
        url: '/system/showings/' + showingId,
        method: 'PATCH',
        data: {
            type: $(element).val()
        }
    });
    $(element).parent().html($(element).val());
}

function ajaxUpdateDateLocation(showingId, element) {
    $.ajax({
        url: '/system/showings/update-date-location',
        method: 'POST',
        data: {
            showingId: showingId,
            location: $(element).val()
        }
    });
    $(element).parent().html($(element).find("option:selected").text());
}


function ajaxSyncShowings(eventId) {
    $('#event-showings-table').html('<div style="text-align:center"><img src="/img/backend/spinner.gif"></div>');
    $.ajax({
        url: '/system/ticketsolve/sync-event-dates',
        method: 'POST',
        data: {
            eventId: eventId
        },
        success: function (result) {
            $('#event-showings-table').html(result);
        }
    });
}

// -------------------------------------------------- |||
/// ------------- Updating Ticketsolve |||||||||||||| |||
// -------------------------------------------------- |||

$(function () {
    new TsSyncManager(
        eventId,
        "ticketsolveId",

        "ticketsolveId1Display",
        "ticketsolveId1Spinner",
        "ticketsolveId1Modify",

        "ticketsolve1Value",
        "ticketsolveId1Select",

        "changeSyncTs1",
        "updateTs1"
    );

    new TsSyncManager(
        eventId,
        "ticketsolveId3D",

        "ticketsolveId2Display",
        "ticketsolveId2Spinner",
        "ticketsolveId2Modify",

        "ticketsolve2Value",
        "ticketsolveId2Select",

        "changeSyncTs2",
        "updateTs2"
    );
});


function TsSyncManager(eventId,
                       key,
                       displayWrapperId,
                       spinnerWrapperId,
                       modifyWrapperId,
                       displayFieldId,
                       selectionFieldId,
                       displayButtonId,
                       updateButtonId) {
    var me = this;

    this.eventId = eventId;
    this.keyItem = key;

    this.displayWrapper = $("#" + displayWrapperId);
    this.spinnerWrapper = $("#" + spinnerWrapperId);
    this.modifyWrapper = $("#" + modifyWrapperId);

    this.displayField = $("#" + displayFieldId);
    this.selectionFieldId = selectionFieldId;

    this.displayButton = $("#" + displayButtonId);
    this.updateButtonId = updateButtonId;

    this.displayButton.bind('click', function () {
        me.select();
    });

    return this;
}


TsSyncManager.prototype.select = function () {

    var me = this;

    this.displayWrapper.hide();
    this.spinnerWrapper.show();

    $.ajax({
        url: ' /system/ticketsolve/not-synced-events.ajax',
        method: 'GET'
    }).success(function (result) {
        me.modifyWrapper.html(' <select id="' + me.selectionFieldId + '" class="ticketsolveSelection"><option value="">None (Remove Reference)</option></select><button id="' + me.updateButtonId + '">Update Ticketsolve Reference</button>');
        var tsSel = $("#" + me.selectionFieldId);
        $(result).each(function (index) {
            $(tsSel).append("<option value='" + result[index].eventId + "'>" + result[index].eventId + " : " + result[index].name + "</option>");
        });
        me.spinnerWrapper.hide();
        me.modifyWrapper.show();
        $("#" + me.updateButtonId).bind('click', function () {
            me.update(tsSel.val());
        });
    });
};


TsSyncManager.prototype.update = function (val) {

    var me = this;
    var data = {};

    if (me.keyItem == "ticketsolveId") {
        data = {
            eventId: me.eventId,
            ticketsolveId: val
        }
    } else {
        data = {
            eventId: me.eventId,
            ticketsolveId3D: val
        }
    }

    this.modifyWrapper.hide();
    this.spinnerWrapper.show();

    $.ajax({
        url: '/system/ticketsolve/update-event-ts.ajax',
        method: 'POST',
        data: data,
        success: function (result) {
            me.displayField.val(val);
            me.spinnerWrapper.hide();
            me.displayWrapper.show();
        }
    });

};


// -------------------------------------------------- |||
/// ------------- TMDB IMAGES ||||||||||||||||||||||| |||
// -------------------------------------------------- |||


$(function () {

    var tmdb = new Tmdb(eventId);

});


Tmdb = function (eventId) {

    var me = this;

    this.eventId = eventId;
    this.modal = $('[data-remodal-id=modalImages]').remodal({});

    this.spinner = $("#tmdbSpinner");
    this.content = $("#tmdbImages");

    $("#loadTmdbImages").bind('click', function () {
        me.loadImages();
    });

    return this;
};

Tmdb.prototype.loadImages = function () {

    var me = this;

    this.modal.open();
    this.content.hide();
    this.spinner.show();
    this.content.html('');

    $.ajax({
        url: '/system/tmdb/find-images-for-event',
        method: 'POST',
        data: {
            eventId: me.eventId
        },
        success: function (result) {

            $(result['images']).each(function (index) {
                me.content.append('<div class="tmdb-image"><img src="' + result['images'][index] + '" /></div>');
            });
            me.spinner.hide();
            me.content.show();

            $(".tmdb-image img").bind('click', function () {
                console.log($(this).attr('src'));
                $.ajax({
                    url: '/system/tmdb/copy-image',
                    method: 'POST',
                    data: {
                        eventId: me.eventId,
                        imageSource: $(this).attr('src')
                    }, success : function(){
                        ajaxLoadEventImages(me.eventId);
                    }
                });
                $(this).parent().remove();
            });
        }
    });


};


