<h2><?php _e('Criar links em formato de shortcode', 'easyap'); ?></h2>

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

<code>[easyp_link text="políticas e privacidade do site" href="https://google.com"]</code>