(function ($) {

    // load table tags
    $.loadTags = function () {

        $.get(easyap_obj.ajax_url, {
            action: 'load_table_tag',
        }).done(function (response) {

            var data = JSON.parse(response);

            $.each(data, function (category, tags) {

                var output = '';

                output += '<table class="easyap-table">';
                output += '<thead>';
                output += '<tr>';
                output += '<th class="text-center actions"></th>';
                output += '<th>Titulo</th>';
                output += '</tr>';
                output += '</thead>';
                output += '<tbody>';

                tags.map(function (tag) {
                    output += '<tr>';
                    output += '<td class="text-center actions">';
                    output += '<a href="#" class="edit" title="Editar" data-id="' + tag.id + '"><span class="dashicons dashicons-edit"></span></a>';
                    output += '<a href="#" class="remove" title="Remover" data-id="' + tag.id + '"><span class="dashicons dashicons-remove"></span></a>';
                    output += '</td>';
                    output += '<td>' + tag.title + '</td>';
                    output += '</tr>';
                });

                output += '</tbody>';
                output += '</table>';

                $("#" + category).find('.empty-tags').hide();
                $("#" + category).find('.easyap-table').remove();
                $("#" + category).append(output);

            });

        });

    };

    $.loadTags();

    // save tag
    $("#save-tag").on('click', function (e) {

        e.preventDefault();

        var id = $('input[name="id"]').val();
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
            id: id,
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