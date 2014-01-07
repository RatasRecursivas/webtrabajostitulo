<div class="row">
    <div class="small-8 columns large-centered">
        <h1>Cambiar password</h1>

        <?= form_open('account/reiniciar_password/' . $code); ?>
        <p>
            <?= form_label_vandalizado('Password nueva de a lo menos ' . $min_password_length . ' caracteres', 'new_password'); ?>
            <?= form_input($new_password); ?>
        </p>
        
        <p>
            <?= form_label_vandalizado('Confirmar nueva password', 'new_password_confirm'); ?>
            <?= form_input($new_password_confirm); ?>
        </p>
        <?= form_submit($user_id); ?>
        <?= form_hidden($csrf); ?>
        
        <p><?= form_submit('submit', 'Go!'); ?></p>
        <?= form_close(); ?>
    </div>
</div>