$(function () {
    new CreateManager();
});


CreateManager = function()
{

    this.elements = {
        title: $("#title"),
        description: $("#description")
    };

    this.wrapper = $("#tsWrapper");
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
        });

    });

};




