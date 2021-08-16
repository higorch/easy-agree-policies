<div class="modal-accept">

    <div class="body">

        <div class="box">
            <div class="col info">
                <strong><?php echo get_option_easyap('easyap_geral', 'modal_consent_title', null, 'Politica & Privacidade'); ?></strong>
                <?php echo wpautop(get_option_easyap('easyap_geral', 'modal_consent_info', null, 'Este site usa cookies para melhorar sua experiência. Ao continuar navegando você concorda com o uso dos cookies, termos e políticas do site.')); ?>
            </div>
            <div class="col btn">
                <button type="button"><?php echo get_option_easyap('easyap_geral', 'modal_consent_btn_accept_label', null, 'Aceitar'); ?></button>
            </div>
        </div>

    </div>

</div>