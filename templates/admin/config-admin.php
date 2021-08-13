<?php
$geral_screen = (!isset($_GET['action']) || isset($_GET['action']) && 'geral' == $_GET['action']) ? true : false;
$links_screen = (isset($_GET['action']) && 'links' == $_GET['action']) ? true : false;
?>
<div class="wrap">

    <h1><?php _e('Easy agree policies', 'easyap'); ?></h1>

    <h2 class="nav-tab-wrapper">
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'geral'), admin_url('admin.php?page=easy-agree-policies'))); ?>" class="nav-tab<?php if ($geral_screen) echo ' nav-tab-active'; ?>"><?php esc_html_e('Geral', 'easyap'); ?></a>
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'links'), admin_url('admin.php?page=easy-agree-policies'))); ?>" class="nav-tab<?php if ($links_screen) echo ' nav-tab-active'; ?>"><?php esc_html_e('Links', 'easyap'); ?></a>
    </h2>

    <form method="post" action="options.php">

        <?php
        if ($geral_screen) {
            settings_fields('easyap_geral');
            do_settings_sections('easyap-setting-geral');
            submit_button(__('Salvar configurações', 'easyap'));
        }

        if ($links_screen) {
            settings_fields('easyap_links');
            do_settings_sections('easyap-setting-links');
            submit_button(__('Salvar configurações', 'easyap'));
        }
        ?>

    </form>

</div>