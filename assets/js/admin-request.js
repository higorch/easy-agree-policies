(function ($) {

    // load table tags
    $.loadTags = function () {

        $.get(easyap_obj.ajax_url, {
            action: 'load_table_tag',
        }).done(function (response) {
            console.log(response);
        });

    };

    $.loadTags();

    $("#save-tag").on('click', function (e) {

        e.preventDefault();

        var title = $('input[name="title"]').val();
        var category = $('select[name="category"]').val();
        var scripts = [];

        if (title == '') {
            alert('Informe o título');
            return;
        }

        if (category == '') {
            alert('Informe a categoria');
            return;
        }

        // scripts push
        $('#scripts-manager .easyap-script-tag').map(function () {

            var el = $(this);

            var local = el.find('select[name="local[]"]').val();
            var tag = el.find('textarea[name="script[]"]').val();

            if (!local || tag == '') {
                return;
            }

            scripts.push({
                local: local,
                tag: tag,
            });
        });

        // post data and reload table tags
        $.post(easyap_obj.ajax_url, {
            action: 'save_tag',
            title: title,
            category: category,
            scripts: JSON.stringify(scripts),
        }).done(function (response) {

            // reset entry
            $('input[name="title"]').val('');
            $('select[name="category"]').val('');
            $('#scripts-manager .easyap-script-tag').remove();

            $.loadTags();

        });

    });

})(jQuery);