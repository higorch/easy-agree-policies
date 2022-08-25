<h2><?php _e('Gerenciar tags', 'easyap'); ?></h2>

<div class="wrap-easyap-tags">

    <div class="box">

        <div class="col entry">

            <input type="hidden" name="tag_id" value="">

            <div class="form-group">
                <label><?php _e('Título', 'easyap'); ?></label>
                <input type="text" name="title" placeholder="Google analytics">
            </div>

            <div class="form-group">
                <label><?php _e('Categoria', 'easyap'); ?></label>
                <select name="category">
                    <option value="">---</option>
                    <option value="required"><?php _e('Necessário', 'easyap'); ?></option>
                    <option value="marketing"><?php _e('Marketing', 'easyap'); ?></option>
                    <option value="statistic"><?php _e('Estatística', 'easyap'); ?></option>
                    <option value="functional"><?php _e('Funcional', 'easyap'); ?></option>
                </select>
            </div>

            <div class="easyap-heading" style="margin: 30px 0 15px 0;">
                <div class="col">
                    <a href="#" id="add-script" class="button button-primary"><span class="dashicons dashicons-plus-alt2"></span><?php _e('Add cookies', 'easyap'); ?></a>
                </div>
                <div class="col">
                    <a href="#" id="save-tag" class="button button-primary"><span class="dashicons dashicons-saved"></span><?php _e('Salvar', 'easyap'); ?></a>
                </div>
            </div>

            <div id="cookies-manager">
                <div class="empty-alert">
                    <p><?php _e('Nunhum cookie.', 'easyap'); ?></p>
                </div>
            </div>

        </div>

        <div class="col list">

            <div class="wrap-table" id="required">

                <div class="heading">
                    <b>
                        <?php _e('Necessário', 'easyap'); ?>
                        <span style="color: #999;"><?php _e('(todos aqui terão o consentimento obrigatório)', 'easyap'); ?></span>
                    </b>
                    <small><?php _e('Cookies necessários são essenciais para o funcionamento do site, sem eles o site não funcionaria adequadamente. (Ex. acesso a áreas seguras do site, segurança, legislação).', 'easyap'); ?></small>
                </div>

                <div class="empty-alert">
                    <p><?php _e('Nunhuma tag configurada.', 'easyap'); ?></p>
                </div>

            </div>

            <div class="wrap-table" id="marketing">

                <div class="heading">
                    <b><?php _e('Marketing', 'easyap'); ?></b>
                    <small><?php _e('Através dos cookies de marketing, é possível que uma empresa exiba anúncios personalizados para você, com base nos seus interesses.', 'easyap'); ?></small>
                </div>

                <div class="empty-alert">
                    <p><?php _e('Nunhuma tag configurada.', 'easyap'); ?></p>
                </div>

            </div>

            <div class="wrap-table" id="statistic">

                <div class="heading">
                    <b><?php _e('Estatística', 'easyap'); ?></b>
                    <small><?php _e('Cookies de estatísticas, ou analytics traduzem as interações dos visitantes em relatórios detalhados de comportamento, de maneira anonimizada.', 'easyap'); ?></small>
                </div>

                <div class="empty-alert">
                    <p><?php _e('Nunhuma tag configurada.', 'easyap'); ?></p>
                </div>

            </div>

            <div class="wrap-table" id="functional">

                <div class="heading">
                    <b><?php _e('Funcional', 'easyap'); ?></b>
                    <small><?php _e('Cookies funcionais ajustam o site a serviços de terceiros como vinculo ao seu perfil em redes sociais, comentários, chatbots, etc.', 'easyap'); ?></small>
                </div>

                <div class="empty-alert">
                    <p><?php _e('Nunhuma tag configurada.', 'easyap'); ?></p>
                </div>

            </div>

        </div>

    </div>

</div>

<script>
    (function($) {

        // add script
        $('a#add-script').on('click', function(e) {

            e.preventDefault();

            output = '<div class="easyap-cookies-tag">';

            output += '<a href="#" class="close">x</a>';

            output += '<div class="form-group">';
            output += '<label>Nome</label>';
            output += '<input type="text" name="name[]" placeholder="_ga">';
            output += '</div>';

            output += '<div class="form-group">';
            output += '<label>Domínio</label>';
            output += '<input type="text" name="domain[]" placeholder="google.com">';
            output += '</div>';

            output += '<div class="form-group">';
            output += '<label>Duração</label>';
            output += '<input type="text" name="duration[]" placeholder="350 dias">';
            output += '</div>';

            output += '<div class="form-group">';
            output += '<label>Descrição</label>';
            output += '<textarea name="description[]" placeholder="Google analytics"></textarea>';
            output += '</div>';

            output += '</div>';

            $("#cookies-manager").prepend(output);

            // remove empty alert
            if ($("#cookies-manager .easyap-cookies-tag").length > 0) {
                $('#cookies-manager .empty-alert').hide();
            }

        });

        // remove script
        $(document).on('click', '.easyap-cookies-tag a.close', function(e) {

            e.preventDefault();

            $(this).parent('.easyap-cookies-tag').remove();

            // add empty alert
            if ($("#cookies-manager .easyap-cookies-tag").length == 0) {
                $('#cookies-manager .empty-alert').show();
            }

        });

    })(jQuery)
</script>