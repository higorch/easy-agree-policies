<h2><?php _e('Gerenciar tags', 'easyap'); ?></h2>

<div class="wrap-easyap-tags">

    <div class="box">

        <div class="col entry">

            <div class="form-group">
                <label>Título</label>
                <input type="text" name="title">
            </div>

            <div class="form-group">
                <label>Categoria</label>
                <select name="category">
                    <option>---</option>
                    <option value="required"><?php _e('Obrigatório', 'easyap'); ?></option>
                    <option value="marketing"><?php _e('Marketing', 'easyap'); ?></option>
                    <option value="statistic"><?php _e('Estatística', 'easyap'); ?></option>
                    <option value="functional"><?php _e('Funcional', 'easyap'); ?></option>
                </select>
                <div id="info-category"></div>
            </div>

        </div>

        <div class="col list">

            <table class="easyap-table" role="presentation">

                <thead>
                    <tr>
                        <th class="text-center actions"></th>
                        <th><?php _e('Titulo', 'easyap'); ?></th>
                        <th><?php _e('Categoria', 'easyap'); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="text-center actions">
                            <a href="#" class="edit" title="<?php _e('Editar', 'easyap'); ?>"><span class="dashicons dashicons-edit"></span></a>
                            <a href="#" class="remove" title="<?php _e('Remover', 'easyap'); ?>"><span class="dashicons dashicons-remove"></span></a>
                        </td>
                        <td>Pixel Facebook</td>
                        <td>Marketing</td>
                    </tr>
                    <tr>
                        <td class="text-center actions">
                            <a href="#" class="edit"><span class="dashicons dashicons-edit"></span></a>
                            <a href="#" class="remove"><span class="dashicons dashicons-remove"></span></a>
                        </td>
                        <td>Google analytics</td>
                        <td>Estatísticas</td>
                    </tr>
                </tbody>

            </table>

        </div>

    </div>

</div>

<script>
    (function($) {

        $('select[name="category"]').on('change', function() {

            var el = $(this);
            var description = '';

            switch (el.val()) {
                case 'required':
                    description = "Cookies necessários são essenciais para o funcionamento do site, sem eles o site não funcionaria adequadamente. (Ex. acesso a áreas seguras do site, segurança, legislação)"
                    break;

                case 'marketing':
                    description = "Através dos cookies de marketing, é possível que uma empresa exiba anúncios personalizados para você, com base nos seus interesses."
                    break;

                case 'statistic':
                    description = "Cookies de estatísticas, ou analytics traduzem as interações dos visitantes em relatórios detalhados de comportamento, de maneira anonimizada."
                    break;

                case 'functional':
                    description = "Cookies funcionais ajustam o site a serviços de terceiros como vinculo ao seu perfil em redes sociais, comentários, chatbots, etc."
                    break;

                default:
                    description = '';
                    break;
            }

            $("#info-category").html("<small>" + description + "<small>");

        });

    })(jQuery)
</script>

<style>
    .wrap-easyap-tags {
        display: block;
        width: 100%;
    }

    .wrap-easyap-tags .box {
        display: block;
        width: calc(100% + 30px);
        margin-left: -15px;
        font-size: 0;
    }

    .wrap-easyap-tags .box .col {
        display: inline-block;
        vertical-align: top;
        font-size: initial;
        padding: 15px;
        box-sizing: border-box;
    }

    .wrap-easyap-tags .box .col.entry {
        width: 40%;
    }

    .wrap-easyap-tags .box .col.list {
        width: 60%;
    }

    .wrap-easyap-tags .form-group {
        display: block;
        margin-bottom: 15px;
    }

    .wrap-easyap-tags .form-group label {
        display: block;
        margin-bottom: 5px;
        font-size: .9em;
        font-weight: 700;
    }

    .wrap-easyap-tags .form-group input[type="text"],
    .wrap-easyap-tags .form-group input[type="email"],
    .wrap-easyap-tags .form-group select,
    .wrap-easyap-tags .form-group textarea {
        display: block;
        width: 100%;
        max-width: initial;
    }

    .easyap-table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .easyap-table td,
    .easyap-table th {
        border: 1px solid #ddd;
        padding: 8px;
        font-size: .85em;
    }

    .easyap-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .easyap-table tr:hover {
        background-color: #ddd;
    }

    .easyap-table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #1d2327;
        color: white;
    }

    .easyap-table .text-center {
        text-align: center;
    }

    .easyap-table .actions {
        width: 100px;
    }

    .easyap-table .actions a {
        margin-left: 10px;
        text-decoration: none;
    }

    .easyap-table .actions a .dashicons {
        font-size: 1em;
    }

    .easyap-table .actions a:first-child {
        margin-left: 0;
    }

    .easyap-table .actions a.remove {
        color: red;
    }

    #info-category {
        font-size: 0.85em;
        margin-top: 5px;
        line-height: 16px;
        text-align: justify;
    }
</style>