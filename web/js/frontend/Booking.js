function Booking() {

    this.iframe = $("#ticketsolve-iframe");
    this.modal = $('[data-remodal-id=bookingModal]').remodal({});

    return this;

}

Booking.prototype.open = function (url) {

    this.iframe.attr('src', url);
    this.modal.open();

};