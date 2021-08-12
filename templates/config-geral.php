<div class="wrap">

    <h1>Easy LGPD</h1>

    <form method="post" action="options.php">
        <?php settings_fields('easylgpd-settings-group'); ?>
        <?php do_settings_sections('easylgpd-settings-group'); ?>

        <table class="form-table">

            <tr valign="top">
                <th scope="row"><?php _e('Texto no botão', 'easylgpd'); ?></th>
                <td><input type="text" name="btn_text" class="regular-text" value="<?php echo esc_attr(get_option('btn_text')); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Título do modal', 'easylgpd'); ?></th>
                <td><input type="text" name="modal_title" class="regular-text" value="<?php echo esc_attr(get_option('modal_title')); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Descrição', 'easylgpd'); ?></th>
                <td><textarea name="modal_info" class="regular-text"><?php echo esc_attr(get_option('modal_info')); ?></textarea></td>
            </tr>

        </table>

        <?php submit_button(__('Salvar configurações', 'easylgpd')); ?>
    </form>

</div>