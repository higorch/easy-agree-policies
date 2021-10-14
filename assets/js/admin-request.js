(function ($) {

    $("#save-tag").on('click', function (e) {

        e.preventDefault();

        var title = $('input[name="title"]').val();
        var category = $('select[name="category"]').val();
        var scripts = [];

        $('#scripts-manager .easyap-script-tag').map(function () {

            var el = $(this);

            var local = el.find('select[name="local[]"]').val();
            var tag = el.find('textarea[name="script[]"]').val();

            if (!local || local == '---' || tag == '') {
                return;
            }

            scripts.push({
                local: local,
                tag: tag,
            });
        });

        var data = {
            action: 'save_tag',
            title: title,
            category: category,
            scripts: JSON.stringify(scripts),
        };

        $.post(easyap_obj.ajax_url, data, function (response) {
            console.log(response);
        });

    });

})(jQuery);