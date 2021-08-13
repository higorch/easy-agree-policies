<?php
$geral_screen = (!isset($_GET['action']) || isset($_GET['action']) && 'geral' == $_GET['action']) ? true : false;
$links_screen = (isset($_GET['action']) && 'links' == $_GET['action']) ? true : false;
?>
<div class="wrap">

    <h1>Easy LGPD</h1>

    <h2 class="nav-tab-wrapper">
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'geral'), admin_url('admin.php?page=easy-lgpd'))); ?>" class="nav-tab<?php if ($geral_screen) echo ' nav-tab-active'; ?>"><?php esc_html_e('Geral', 'easylgpd'); ?></a>
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'links'), admin_url('admin.php?page=easy-lgpd'))); ?>" class="nav-tab<?php if ($links_screen) echo ' nav-tab-active'; ?>"><?php esc_html_e('Links', 'easylgpd'); ?></a>
    </h2>

    <form method="post" action="options.php">

        <?php
        if ($geral_screen) {
            settings_fields('easylgpd_geral');
            do_settings_sections('easylgpd-setting-geral');
            submit_button(__('Salvar configurações', 'easylgpd'));
        }

        if ($links_screen) {
            settings_fields('easylgpd_links');
            do_settings_sections('easylgpd-setting-links');
            submit_button(__('Salvar configurações', 'easylgpd'));
        }
        ?>

    </form>

</div>