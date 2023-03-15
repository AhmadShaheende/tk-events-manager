jQuery(document).ready(function ($) {

    const openPopupBtn = $('.tk-register-for-event');
    const popup = $('.tk-popup');
    const popupOverlay = $('.tk-popup-overlay');
    const closePopupBtn = $('.tk-close-popup');
    const emailInput = $('#tk-email-input');
    const validationMessage = $('.tk-validation-message');
    const tkEventRegistrationFormBtn = $('#tkEventRegistrationFormBtn');



    emailInput.focus(function () {
        tkHideMessage();
    });

    tkEventRegistrationFormBtn.click(function () {
        tkHideMessage();

        if (!tkIsValidEmail(emailInput.val())) {
            tkDisplayMessage('Ungültige E-Mail-Adresse', 'error')
            return;
        }

        $.ajax(
            {
                url: "/wp-content/plugins/tk-events-manager/ajax/event-registration.php",
                type: "POST",
                async: true,
                data: {
                    eventId: popup.attr('id'),
                    email: emailInput.val(),
                    eventName: $(`.tk-event#${popup.attr('id')}`).find('h2').text().replace('Tk Event: ', '')
                },
                success: function (result) {
                    if (result.success) {
                        tkDisplayMessage(result.data.message, 'success');
                    } else {
                        tkDisplayMessage(result.data.message, 'error');
                    }
                }
            }
        );
    })
    openPopupBtn.on('click', function () {
        popup.fadeIn(300);
        popupOverlay.addClass('active')
        popup.attr('id', $(this).closest('.tk-event').attr('id'))
        popup.find('h2').text($(this).siblings('h2').text())
    });

    closePopupBtn.on('click', function () {
        tkHideMessage();
        popup.fadeOut(300);
        popupOverlay.removeClass('active')
    });

    popup.find('form').on('submit', function (event) {
        event.preventDefault();

        if (emailInput[0].checkValidity()) {
            popup.removeClass('is-visible');
        } else {
            validationMessage.text(emailInput[0].validationMessage);
        }
    });

    function tkIsValidEmail(email) {
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }

    function tkDisplayMessage(message, type) {
        $('.tk-validation-message').html('<p>' + message + '</p>')
        let className = type == 'error' ? 'tk-error' : 'tk-success'
        $('.tk-validation-message').addClass(className);
    }

    function tkHideMessage() {
        $('.tk-validation-message').html('')
        $('.tk-validation-message').removeClass('tk-error')
        $('.tk-validation-message').removeClass('tk-success')
    }

})