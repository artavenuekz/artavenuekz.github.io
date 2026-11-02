(function ($) {
    'use strict';

	const button = $('.contact_form > a.contact_link.btn-custom');
    var form = $('.contact_form'),
        message = $('.contact_msg'),
        form_data;

    // Success function
    function done_func(response) {
        message.fadeIn().removeClass('alert-danger').addClass('alert-success');
        message.text(response);

        setTimeout(function () {
            message.fadeOut();
        }, 2000);
        form.find('input:not([type="submit"]), textarea').val('');
    }

    // fail function
    function fail_func(data) {
        message.fadeIn().removeClass('alert-success').addClass('alert-success');
     
        message.text(data.responseText);
        setTimeout(function () {
            message.fadeOut();
        }, 2000);
    }
	
	button.click(function (e) {
		e.preventDefault();
        form_data = form.serialize();
		console.log(form_data);
        $.ajax({
            type: 'POST',
            url: 'https://artavenue.kz/assets/php/mail.php',
            data: form_data
        })
            .done(done_func)
            .fail(fail_func);
	});

})(jQuery);