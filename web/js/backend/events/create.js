$(document).ready(function () {
  /*  $('#description').trumbowyg({
        fullscreenable: false,
        closable: false
    });*/
});

CreateManager = function(use3d)
{

    this.elements = {
        title: $("#title"),
        description: $("#description")
    };

    this.wrapper = $("#tsWrapper");
    this.wrapper3D = $("#tsWrapper3D");
    this.use3d = use3d;

    this.events = {};

    this.loadData();
};

CreateManager.prototype.loadData = function () {

    var me = this;

    $.ajax({
        url: ' /system/ticketsolve/not-synced-events.ajax',
        method: 'GET'
    }).success(function (result) {

        me.events = result;

        me.wrapper.html('<select id="eventSelection" class="ticketsolveSelection"><option value="">Select an Event</option></select>');
        var tsSel = $("#eventSelection");
        $(result).each(function (index) {
            $(tsSel).append("<option value='" + index + "'>" + result[index].eventId + " : " + result[index].name + "</option>");
        });

        tsSel.bind('change', function () {
            me.elements.title.val(me.events[this.value].name);
            me.elements.description.val(me.events[this.value].description);
            $("#ticketsolveIdCreate").val(me.events[this.value].eventId);
        });

        if(me.use3d == 1) {
            me.wrapper3D.html('<select id="eventSelection3D" class="ticketsolveSelection"><option value="">Select a 3D Event</option></select>');
            var tsSel3D = $("#eventSelection3D");
            $(result).each(function (index) {
                $(tsSel3D).append("<option value='" + index + "'>" + result[index].eventId + " : " + result[index].name + "</option>");
            });

            tsSel3D.bind('change', function () {
                $("#ticketsolveIdCreate3D").val(me.events[this.value].eventId);
            });
        }
    });

};




