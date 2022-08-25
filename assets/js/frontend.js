(function ($) {

    // store cookie
    var setCookie = function (cookieName, cookieValue, daysToExpire = 180) {
        var date = new Date();
        date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
        document.cookie = cookieName + "=" + cookieValue + "; expires=" + date.toGMTString();
    }

    // get cookie
    var getCookie = function (cookieName) {
        var cookieName = cookieName + "=";
        var allCookieArray = document.cookie.split(';');
        for (var i = 0; i < allCookieArray.length; i++) {
            var temp = allCookieArray[i].trim();
            if (temp.indexOf(cookieName) == 0)
                return temp.substring(cookieName.length, temp.length);
        }

        return null;
    }

    // verify exist cookie
    var hasCookie = function (cookieName) {
        var cookieName = getCookie(cookieName);
        if (cookieName !== null)
            return true;
        return false;
    }

    // active or deactive modal consent
    var displayModalConsent = function () {
        setTimeout(function () {
            if (hasCookie('easyap_consents')) {
                $('.modal-consent').removeClass('active');
            } else {
                $('.modal-consent').addClass('active');
            }
        }, 3000);
    }

    displayModalConsent();

    // open modal 
    $('.modal-consent .body .box .col.btn a.options').on('click', function (e) {
        e.preventDefault();
        $('.modal-cookies').addClass('active');
        $("body").css("overflow", "hidden");
    });

    // close modal
    $(document).on('click', '.modal-cookies', function (e) {
        var el = $(this);
        if (!$(e.target).closest('.modal-cookies > *').length || $(e.target).hasClass('dialog') || $(e.target).closest('.modal-cookies .dialog .content .close').length) {
            el.removeClass('active');
            $("body").css("overflow", "initial");
        }
    });

    // save cookie easyap_consents
    $('.modal-consent .body .box .col.btn a, .modal-cookies .dialog .content .easyap-footer .actions a.btn').on('click', function (e) {

        e.preventDefault();

        var el = $(this);
        var consents = [];

        if (typeof el.data('consent') !== 'undefined') {

            var options = $('.modal-cookies input[name="consent[]"]');

            switch (el.data('consent')) {
                case 'accept-all':
                    options.prop('checked', true);
                    options.each(function (index, consent) {
                        consents.push($(consent).val());
                    });
                    break;
                case 'save-options':
                    options.each(function (index, consent) {
                        if ($(consent).is(':checked')) {
                            consents.push($(consent).val());
                        }
                    });
                    break;
            }

            setCookie('easyap_consents', JSON.stringify(consents));

            $('.modal-consent, .modal-cookies').removeClass('active');
            $("body").css("overflow", "initial");
        }
    });

})(jQuery);