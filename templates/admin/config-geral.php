<div class="wrap">

    <h1>Easy LGPD</h1>

    <nav class="nav-tab-wrapper">
        <a href="?page=my-plugin" class="nav-tab <?php if ($tab === null) : ?>nav-tab-active<?php endif; ?>">Default Tab</a>
        <a href="?page=my-plugin&tab=settings" class="nav-tab <?php if ($tab === 'settings') : ?>nav-tab-active<?php endif; ?>">Settings</a>
        <a href="?page=my-plugin&tab=tools" class="nav-tab <?php if ($tab === 'tools') : ?>nav-tab-active<?php endif; ?>">Tools</a>
    </nav>

    <form method="post" action="options.php">
        <?php settings_fields('easylgpd-settings-group'); ?>
        <?php do_settings_sections('easylgpd-settings-group'); ?>

        <div class="tab-content">

            <table class="form-table">

                <tr valign="top">
                    <th scope="row"><?php _e('Texto no botão', 'easylgpd'); ?></th>
                    <td><input type="text" name="easylgpd_btn_text" class="regular-text" value="<?php echo esc_attr(get_option('easylgpd_btn_text')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Título do modal', 'easylgpd'); ?></th>
                    <td><input type="text" name="easylgpd_modal_title" class="regular-text" value="<?php echo esc_attr(get_option('easylgpd_modal_title')); ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Descrição', 'easylgpd'); ?></th>
                    <td><textarea name="easylgpd_modal_info" class="regular-text"><?php echo esc_attr(get_option('easylgpd_modal_info')); ?></textarea></td>
                </tr>

            </table>

        </div>

        <?php submit_button(__('Salvar configurações', 'easylgpd')); ?>
    </form>

</div>