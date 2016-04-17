/**
 * @returns {ImportManager}
 * @constructor
 */
function ImportManager() {
    this.elements = {
        wrapper : $("#wrapper-div"),
        loadingIcon: $("#loading-icon"),
        results: $("#results")
    };

    var source = $('#events-table-template').html();
    this.template = Handlebars.compile(source);

    this.events = {
        synced: [],
        pending: []
    };

    return this;
}


ImportManager.prototype.downloadFeed = function () {
    var me = this;
    $.ajax({
        url: '/system/events/import/ticketsolve',
        method: 'GET',
        success: function (result) {
            me.elements.loadingIcon.hide();
            me.events.synced = result.syncedEvents;
            me.events.pending = result.unSyncedEvents;
            me.renderEvents();
        }
    });
};

ImportManager.prototype.renderEvents = function()
{
    this.elements.loadingIcon.hide();
    this.elements.results.html(this.template(this.events));
};


ImportManager.prototype.createEvent = function (ticketsolveId) {
    var me = this;
    $.ajax({
        url: '/system/events/import/ticketsolve/create',
        method: 'POST',
        data: me.getEventData(ticketsolveId),
        success: function (result) {
            me.elements.loadingIcon.hide();
            me.elements.results.html(result);
        }
    });
};


ImportManager.prototype.getEventData = function(ticketSolveId){
    for(var i=0; i<=this.events.pending.length; i++){
        if(this.events.pending[i].ticketsolve == ticketSolveId){
            return this.events.pending[i];
        }
    }
    return false;
};

