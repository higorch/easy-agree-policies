(function ($) {

    // open modal 
    $('.modal-accept .body .box .col.btn a.options').on('click', function (e) {

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

})(jQuery);