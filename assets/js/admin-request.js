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

                $("#" + category).find('.empty-alert').hide();
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
        var cookies = [];

        if (title == '') {
            alert('Informe o título');
            return;
        }

        if (category == '') {
            alert('Informe a categoria');
            return;
        }

        // cookies push
        $('#cookies-manager .easyap-cookies-tag').map(function () {
            cookies.push({
                name: $(this).find('input[name="name[]"]').val(),
                domain: $(this).find('input[name="domain[]"]').val(),
                duration: $(this).find('input[name="duration[]"]').val(),
                description: $(this).find('textarea[name="description[]"]').val(),
            });
        });

        // post data and reload table tags
        $.post(easyap_obj.ajax_url, {
            action: 'save_tag',
            id: tag_id,
            title: title,
            category: category,
            cookies: JSON.stringify(cookies),
        }).done(function (response) {

            // reset entry
            $('input[name="title"]').val('');
            $('select[name="category"]').val('');
            $('#cookies-manager .easyap-cookies-tag').remove();

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

                $("#cookies-manager .easyap-cookies-tag").remove();
                $('#cookies-manager .empty-alert').show();

                $.each(data.cookies, function (idx, cookie) {

                    output = '<div class="easyap-cookies-tag">';

                    output += '<a href="#" class="close">x</a>';

                    output += '<div class="form-group">';
                    output += '<label>Nome</label>';
                    output += '<input type="text" name="name[]" placeholder="_ga" value="' + cookie.name + '">';
                    output += '</div>';

                    output += '<div class="form-group">';
                    output += '<label>Domínio</label>';
                    output += '<input type="text" name="domain[]" placeholder="google.com" value="' + cookie.domain + '">';
                    output += '</div>';

                    output += '<div class="form-group">';
                    output += '<label>Duração</label>';
                    output += '<input type="text" name="duration[]" placeholder="350 dias" value="' + cookie.duration + '">';
                    output += '</div>';

                    output += '<div class="form-group">';
                    output += '<label>Descrição</label>';
                    output += '<textarea name="description[]" placeholder="Google analytics">' + cookie.description + '</textarea>';
                    output += '</div>';

                    output += '</div>';

                    $("#cookies-manager").prepend(output);
                });

                // remove empty alert
                if ($("#cookies-manager .easyap-cookies-tag").length > 0) {
                    $('#cookies-manager .empty-alert').hide();
                }

            });

        }

        if (el.hasClass('remove')) {

            if (window.confirm("Você realmente excluir a tag?")) {

                $.post(easyap_obj.ajax_url, {
                    action: 'remove_tag',
                    id: id
                }).done(function (response) {
                    $.loadTags();
                });

            }

        }

    });

})(jQuery);