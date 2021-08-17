<div class="modal-accept">

    <div class="body">

        <div class="box">
            <div class="col info">
                <strong><?php echo get_option_easyap('easyap_geral', 'modal_consent_title', null, 'Politica & Privacidade'); ?></strong>
                <?php echo wpautop(get_option_easyap('easyap_geral', 'modal_consent_info', null, 'Este site usa cookies para melhorar sua experiência. Ao continuar navegando você concorda com o uso dos cookies, termos e políticas do site.')); ?>
            </div>
            <div class="col btn">
                <button type="button" class="options"><?php echo get_option_easyap('easyap_geral', 'modal_consent_btn_options_details_label', null, 'Opções'); ?></button>
                <button type="button" class="accept"><?php echo get_option_easyap('easyap_geral', 'modal_consent_btn_accept_label', null, 'Aceitar'); ?></button>
            </div>
        </div>

    </div>

</div>

<style>
    .modal-accept {
        background-color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_bg_color', null, 'rgb(19, 41, 61)'); ?>;
    }
    .modal-accept .body .box .col.info {
        color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_text_color', null, 'rgb(232, 241, 242)'); ?>;
    }
    .modal-accept .body .box .col.info a {
        color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_link_color', null, 'rgb(27, 152, 224)'); ?>;
    }
    .modal-accept .body .box .col.btn button.options {
        background-color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_btn_options_details_bg_color', null, 'rgb(232, 241, 242)'); ?>;
        color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_btn_options_details_text_color', null, 'rgb(36, 123, 160)'); ?>;
    }
    .modal-accept .body .box .col.btn button.accept {
        background-color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_btn_aceept_bg_color', null, 'rgb(36, 123, 160)'); ?>;
        color: <?php echo get_option_easyap('easyap_styles', 'modal_consent_btn_aceept_text_color', null, 'rgb(232, 241, 242)'); ?>;
    }
</style>