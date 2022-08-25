<?php
$geral_screen = (!isset($_GET['action']) || isset($_GET['action']) && 'geral' == $_GET['action']) ? true : false;
$styles_screen = (isset($_GET['action']) && 'styles' == $_GET['action']) ? true : false;
$link_generator_screen = (isset($_GET['action']) && 'link-generator' == $_GET['action']) ? true : false;
$tag_manager = (isset($_GET['action']) && 'tag-manager' == $_GET['action']) ? true : false;
?>
<div class="wrap">

    <h1><?php _e('Easy agree policies', 'easyap'); ?></h1>

    <h2 class="nav-tab-wrapper">
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'geral'), admin_url('admin.php?page=easy-agree-policies'))); ?>" class="nav-tab<?php if ($geral_screen) echo ' nav-tab-active'; ?>"><?php esc_html_e('Geral', 'easyap'); ?></a>
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'styles'), admin_url('admin.php?page=easy-agree-policies'))); ?>" class="nav-tab<?php if ($styles_screen) echo ' nav-tab-active'; ?>"><?php esc_html_e('Estilos', 'easyap'); ?></a>
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'link-generator'), admin_url('admin.php?page=easy-agree-policies'))); ?>" class="nav-tab<?php if ($link_generator_screen) echo ' nav-tab-active'; ?>"><?php esc_html_e('Gerador de link', 'easyap'); ?></a>
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'tag-manager'), admin_url('admin.php?page=easy-agree-policies'))); ?>" class="nav-tab<?php if ($tag_manager) echo ' nav-tab-active'; ?>"><?php esc_html_e('Tags', 'easyap'); ?></a>
    </h2>

    <form method="post" action="options.php">

        <?php
        if ($geral_screen) {
            settings_fields('easyap_geral');
            do_settings_sections('easyap-setting-geral');
            submit_button(__('Salvar configurações', 'easyap'));
        }

        if ($styles_screen) {
            settings_fields('easyap_styles');
            do_settings_sections('easyap-setting-styles');
            submit_button(__('Salvar configurações', 'easyap'));
        }

        if ($link_generator_screen) {
            require_once EASYAP_PATH . 'templates/admin/partials/link-generator.php';
        }

        if ($tag_manager) {
            settings_fields('easyap_tags');
            require_once EASYAP_PATH . 'templates/admin/partials/tag-manager.php';
        }
        ?>

    </form>

</div>