<div class="modal-accept">

    <div class="body">

        <div class="box">
            <div class="col info">
                <strong><?php echo get_option('easylgpd_modal_title', 'Politica & Privacidade'); ?></strong>
                <?php echo wpautop(get_option('easylgpd_modal_info', 'Este site usa cookies para melhorar sua experiência. Ao continuar navegando você concorda com o uso dos cookies, termos e políticas do site.')); ?>
            </div>
            <div class="col btn">
                <button type="button"><?php echo get_option('easylgpd_btn_text', 'Aceitar'); ?></button>
            </div>
        </div>

    </div>

</div>