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

        var tag_id = $('input[name="tag_id"]').val();
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
            id: tag_id,
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

    // edit or remove tag
    $(document).on('click', '.easyap-table .actions a', function (e) {

        e.preventDefault();

        var el = $(this);
        var id = el.data('id');

        if (el.hasClass('edit')) {

            $('input[name="tag_id"]').val(id);

            $.get(easyap_obj.ajax_url, {
                action: 'edit_tag',
                id: id,
            }).done(function (response) {

                var data = JSON.parse(response);

                $('input[name="tag_id"]').val(data.id);
                $('input[name="title"]').val(data.title);
                $('select[name="category"]').val(data.category);

                $("#scripts-manager .easyap-script-tag").remove();
                $('#scripts-manager .empty-tags').show();

                $.each(data.tags, function (idx, tag) {

                    output = '<div class="easyap-script-tag">';

                    output += '<a href="#" class="close">x</a>';

                    output += '<div class="form-group">';
                    output += '<label>Local</label>';
                    output += '<select name="local[]">';
                    output += '<option value="">---</option>';
                    output += '<option ' + (tag.local == 'after-body-open' ? 'selected' : '') + ' value="after-body-open">Após abertura do body</option>';
                    output += '<option ' + (tag.local == 'before-body-open' ? 'selected' : '') + ' value="before-body-open">Antes de fechar o body</option>';
                    output += '<option ' + (tag.local == 'before-head-close' ? 'selected' : '') + ' value="before-head-close">Antes de fechar o head</option>';
                    output += '</select>';
                    output += '</div>';

                    output += '<div class="form-group">';
                    output += '<label>Script</label>';
                    output += '<textarea name="script[]">' + tag.tag + '</textarea>';
                    output += '</div>';

                    output += '</div>';

                    $("#scripts-manager").prepend(output);

                });

                // remove empty alert
                if ($("#scripts-manager .easyap-script-tag").length > 0) {
                    $('#scripts-manager .empty-tags').hide();
                }

            });

        }

        if (el.hasClass('remove')) {
            alert('remove ' + el.data('id'));
        }


    });

})(jQuery);