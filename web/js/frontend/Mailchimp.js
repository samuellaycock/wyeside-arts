function Mailchimp() {
    var me = this;

    this.firstName = $("#firstName");
    this.lastName = $("#lastName");
    this.email = $("#email");
    this.submit = $("#emailSubscribe");
    this.form = $("#email-form");
    this.message = $("#email-message");
    this.response = $("#email-response");


    $(this.submit).on("click", function () {

        $(me.firstName).prop( "disabled", true );
        $(me.lastName).prop( "disabled", true );
        $(me.email).prop( "disabled", true );
        $(me.submit).prop( "disabled", true );
        $(me.message).show(0);
        $(me.message).html('<img src="/img/frontend/spinner.gif">');

        $.ajax({
            url: '/email-subscribe',
            method: 'POST',
            data: {
                firstName: $(me.firstName).val(),
                lastName: $(me.lastName).val(),
                email: $(me.email).val()
            },
            complete: function (result) {
                if (result == 1) {
                    $(me.form).hide(0);
                    $(me.response).show(0);
                } else {
                    $(me.firstName).prop( "disabled", false );
                    $(me.lastName).prop( "disabled", false );
                    $(me.email).prop( "disabled", false );
                    $(me.submit).prop( "disabled", false );
                    $(me.message).html('<p>Sorry, there was a problem subscribing you to our list.</p>');
                }
            }
        });
    });
}

$( document ).ready(function() {
    new Mailchimp();
});
