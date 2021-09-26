<h2><?php _e('Gerenciar tags', 'easyap'); ?></h2>

<div class="wrap-easyap-tags">

    <div class="box">

        <div class="col entry">

            <div class="form-group">
                <label><?php _e('Título', 'easyap'); ?></label>
                <input type="text" name="title">
            </div>

            <div class="form-group">
                <label><?php _e('Categoria', 'easyap'); ?></label>
                <select name="category">
                    <option>---</option>
                    <option value="required"><?php _e('Necessário', 'easyap'); ?></option>
                    <option value="marketing"><?php _e('Marketing', 'easyap'); ?></option>
                    <option value="statistic"><?php _e('Estatística', 'easyap'); ?></option>
                    <option value="functional"><?php _e('Funcional', 'easyap'); ?></option>
                </select>
            </div>

            <div class="easyap-heading" style="margin: 30px 0 15px 0;">
                <div class="col">
                    <a href="#" id="add-script" class="button button-primary"><span class="dashicons dashicons-plus-alt2"></span><?php _e('Add tag', 'easyap'); ?></a>
                </div>
                <div class="col">
                    <a href="#" class="button button-primary"><span class="dashicons dashicons-saved"></span><?php _e('Salvar', 'easyap'); ?></a>
                </div>
            </div>

            <div id="scripts-manager">
                <div class="empty-tags">
                    <p><?php _e('Nunhum script configurado.', 'easyap'); ?></p>
                </div>
            </div>

        </div>

        <div class="col list">

            <div class="wrap-table">

                <div class="heading">
                    <b>
                        <?php _e('Necessário', 'easyap'); ?>
                        <span style="color: #999;"><?php _e('(todos aqui terão o consentimento)', 'easyap'); ?></span>
                    </b>
                    <small><?php _e('Cookies necessários são essenciais para o funcionamento do site, sem eles o site não funcionaria adequadamente. (Ex. acesso a áreas seguras do site, segurança, legislação).', 'easyap'); ?></small>
                </div>

                <table class="easyap-table" role="presentation">

                    <thead>
                        <tr>
                            <th class="text-center actions"></th>
                            <th><?php _e('Titulo', 'easyap'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="text-center actions">
                                <a href="#" class="edit" title="<?php _e('Editar', 'easyap'); ?>"><span class="dashicons dashicons-edit"></span></a>
                                <a href="#" class="remove" title="<?php _e('Remover', 'easyap'); ?>"><span class="dashicons dashicons-remove"></span></a>
                            </td>
                            <td>Pixel Facebook</td>
                        </tr>
                        <tr>
                            <td class="text-center actions">
                                <a href="#" class="edit"><span class="dashicons dashicons-edit"></span></a>
                                <a href="#" class="remove"><span class="dashicons dashicons-remove"></span></a>
                            </td>
                            <td>Google analytics</td>
                        </tr>
                    </tbody>

                </table>

            </div>

            <div class="wrap-table">

                <div class="heading">
                    <b><?php _e('Marketing', 'easyap'); ?></b>
                    <small><?php _e('Através dos cookies de marketing, é possível que uma empresa exiba anúncios personalizados para você, com base nos seus interesses.', 'easyap'); ?></small>
                </div>

                <div class="empty-tags">
                    <p><?php _e('Nunhuma tag configurada.', 'easyap'); ?></p>
                </div>

            </div>

            <div class="wrap-table">

                <div class="heading">
                    <b><?php _e('Estatística', 'easyap'); ?></b>
                    <small><?php _e('Cookies de estatísticas, ou analytics traduzem as interações dos visitantes em relatórios detalhados de comportamento, de maneira anonimizada.', 'easyap'); ?></small>
                </div>

                <div class="empty-tags">
                    <p><?php _e('Nunhuma tag configurada.', 'easyap'); ?></p>
                </div>

            </div>

            <div class="wrap-table">

                <div class="heading">
                    <b><?php _e('Funcional', 'easyap'); ?></b>
                    <small><?php _e('Cookies funcionais ajustam o site a serviços de terceiros como vinculo ao seu perfil em redes sociais, comentários, chatbots, etc.', 'easyap'); ?></small>
                </div>

                <div class="empty-tags">
                    <p><?php _e('Nunhuma tag configurada.', 'easyap'); ?></p>
                </div>

            </div>

        </div>

    </div>

</div>

<script>
    (function($) {

        $('a#add-script').on('click', function(e) {

            e.preventDefault();

            output = '<div class="easyap-script-tag">';

            output += '<a href="#" class="close">x</a>';

            output += '<div class="form-group">';
            output += '<label>Local</label>';
            output += '<select name="local[]">';
            output += '<option>---</option>';
            output += '<option value="after-body-open">Após abertura do body</option>';
            output += '<option value="before-body-open">Antes de fechar o body</option>';
            output += '<option value="before-head-close">Antes de fechar o head</option>';
            output += '</select>';
            output += '</div>';

            output += '<div class="form-group">';
            output += '<label>Script</label>';
            output += '<textarea name="script[]"></textarea>';
            output += '</div>';

            output += '</div>';

            $("#scripts-manager").prepend(output);

            // remove empty alert
            if ($("#scripts-manager .easyap-script-tag").length > 0) {
                $('#scripts-manager .empty-tags').hide();
            }

        });

        $(document).on('click', '.easyap-script-tag a.close', function(e) {

            e.preventDefault();

            $(this).parent('.easyap-script-tag').remove();

            // add empty alert
            if ($("#scripts-manager .easyap-script-tag").length == 0) {
                $('#scripts-manager .empty-tags').show();
            }

        });

    })(jQuery)
</script>