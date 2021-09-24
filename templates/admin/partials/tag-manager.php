<div class="easyap-heading" style="margin-top: 15px;">
    <div class="col">
        <span class="title"><?php _e('Gerenciar tags', 'easyap'); ?></span>
    </div>
    <div class="col">
        <a href="#" class="action">
            <span class="dashicons dashicons-saved"></span>
            <?php _e('Salvar', 'easyap'); ?>
        </a>
    </div>
</div>

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
                    <option value="required"><?php _e('Necessário', 'easyap'); ?></option>
                    <option value="marketing"><?php _e('Marketing', 'easyap'); ?></option>
                    <option value="statistic"><?php _e('Estatística', 'easyap'); ?></option>
                    <option value="functional"><?php _e('Funcional', 'easyap'); ?></option>
                </select>
            </div>

            <div class="easyap-heading" style="margin-top: 30px;">
                <div class="col">
                    <span class="title"><?php _e('Scripts', 'easyap'); ?></span>
                </div>
                <div class="col">
                    <a href="#" class="action"><span class="dashicons dashicons-plus-alt2"></span></a>
                </div>
            </div>

            <div id="scripts-manager">
                .........
            </div>

        </div>

        <div class="col list">

            <div class="wrap-table">

                <div class="heading">
                    <b><?php _e('Necessário', 'easyap'); ?></b>
                    <small><?php _e('Cookies necessários são essenciais para o funcionamento do site, sem eles o site não funcionaria adequadamente. (Ex. acesso a áreas seguras do site, segurança, legislação).', 'easyap'); ?></small>
                </div>

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

        $('input[name="scripts"]').on('change', function(e) {

            var el = $(this);

            if (el.is(':checked')) {
                $("#scripts-manager").show();
            } else {
                $("#scripts-manager").hide();
            }
        });

    })(jQuery)
</script>