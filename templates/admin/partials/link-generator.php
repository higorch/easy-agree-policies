<h2><?php _e('Criar link em formato de shortcode', 'easyap'); ?></h2>

<table class="form-table" role="presentation">

    <tbody>
        <tr>
            <th scope="row"><?php _e('Texto', 'easyap'); ?></th>
            <td>
                <input class="regular-text" type="text" name="label" placeholder="<?php _e('políticas e privacidade do site', 'easyap'); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Link', 'easyap'); ?></th>
            <td>
                <input class="regular-text" type="text" name="link" placeholder="<?php _e('https://mydomain.com/policies', 'easyap'); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Alvo', 'easyap'); ?></th>
            <td>
                <label style="display: block;">
                    <input type="checkbox" name="_blank">
                    <?php _e('Abrir em nova aba', 'easyap'); ?>
                </label>
            </td>
        </tr>
    </tbody>

</table>

<p>
    <b style="display: block; font-size: 14px; margin-bottom: 5px;"><?php _e('Copie o shortcode:', 'easyap'); ?></b>
    <code id="shortcode-link"></code>
    <small style="display: block; margin-top: 10px;"><?php _e('Cole na descrição em: Geral > Modal consentimento > Informações', 'easyap'); ?></small>
</p>

<script>
    (function($) {

        var text = '',
            href = '#',
            target = '_self';

        $('input[name="label"]').on('keyup', function(e) {
            text = $(this).val();
            $(document).trigger('hortcode_link_change')
        });

        $('input[name="link"]').on('keyup', function(e) {
            href = $(this).val();
            if (href == '') {
                href = "#";
            }
            $(document).trigger('hortcode_link_change')
        });

        $('input[name="_blank"]').on('change', function(e) {
            if ($(this).is(':checked')) {
                target = '_blank';
            } else {
                target = '_self';
            }
            $(document).trigger('hortcode_link_change')
        });

        $(document).on('hortcode_link_change', function() {
            $("#shortcode-link").text('[easyp_link text="' + text + '" href="' + href + '" target="' + target + '"]');
        }).trigger('hortcode_link_change');

    })(jQuery)
</script>