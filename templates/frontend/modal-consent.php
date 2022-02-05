<?php
$title = get_option_easyap('easyap_geral', 'modal_consent_title', null, 'Politica & Privacidade');
$body = get_option_easyap('easyap_geral', 'modal_consent_info', null, 'Este site usa cookies para melhorar sua experiência. Ao continuar navegando você concorda com o uso dos cookies, termos e políticas do site.');
?>
<div class="modal-consent">

    <div class="body">

        <div class="box">
            <div class="col info">
                <strong><?php echo $title; ?></strong>
                <?php echo wpautop(do_shortcode(html_entity_decode($body))); ?>
            </div>
            <div class="col btn">
                <a href="#" class="options"><?php echo get_option_easyap('easyap_geral', 'modal_consent_btn_options_details_label', null, 'Opções'); ?></a>
                <a href="#" class="accept" data-consent="accept-all"><?php echo get_option_easyap('easyap_geral', 'modal_consent_btn_accept_label', null, 'Aceitar'); ?></a>
            </div>
        </div>

    </div>

</div>

<?php
if (is_file(EASYAP_PATH . 'templates/frontend/modal-cookies.php'))
    require_once EASYAP_PATH . 'templates/frontend/modal-cookies.php';
?>

<?php
// modal consent horizontal position
$modal_consent_h_position = get_option_easyap('easyap_styles', 'modal_consent_position_horizontal', null, 'left');

switch ($modal_consent_h_position) {
    case 'left':
        echo "<style>.modal-consent.active { left: 15px; } </style>";
        break;
    case 'right':
        echo "<style>.modal-consent.active { right: 15px; } </style>";
        break;
}
?>

<style>
    .modal-consent {
        background-color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_bg_color', null, 'rgb(19, 41, 61)'); ?>;
    }
    .modal-consent .body .box .col.info {
        color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_text_color', null, 'rgb(232, 241, 242)'); ?>;
    }
    .modal-consent .body .box .col.info a {
        color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_link_color', null, 'rgb(27, 152, 224)'); ?>;
    }
    .modal-consent .body .box .col.btn a.options {
        background-color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_btn_options_details_bg_color', null, 'rgb(232, 241, 242)'); ?>;
        color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_btn_options_details_text_color', null, 'rgb(36, 123, 160)'); ?>;
    }
    .modal-consent .body .box .col.btn a.accept {
        background-color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_btn_aceept_bg_color', null, 'rgb(36, 123, 160)'); ?>;
        color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_btn_aceept_text_color', null, 'rgb(232, 241, 242)'); ?>;
    }
</style>