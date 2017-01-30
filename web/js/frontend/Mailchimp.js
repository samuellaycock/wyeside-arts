function Mailchimp() {
    var me = this;

    this.firstName = $("#firstName");
    this.lastName = $("#lastName");
    this.email = $("#email");
    this.submit = $("#emailSubscribe");
    this.form = $("#email-form");
    this.message = $("#email-message");
    this.response = $("#email-response");


    this.submit.on("click", function () {

        me.firstName.disable();
        me.lastName.disable();
        me.email.disable();
        me.submit.hide(0);
        me.message.show(0);
        me.message.innerHTML('<img src="/img/frontend/spinner.gif">');

        $.ajax({
            url: '/email-subscribe',
            method: 'POST',
            data: {
                firstName: me.firstName.val(),
                lastName: me.lastName.val(),
                email: me.email.val()
            },
            success: function (result) {
                if (result.success == 1) {
                    me.form.hide(0);
                    me.response.show(0);
                } else {
                    me.firstName.enable();
                    me.lastName.enable();
                    me.email.enable();
                    me.submit.enable(0);
                    me.message.innerHTML('<p>Sorry, there was a problem subscribing you to our list.</p>');
                }
            }
        });
    });
}

new Mailchimp();