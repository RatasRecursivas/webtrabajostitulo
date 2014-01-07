<div class="row">
    <div class="small-8 columns large-centered">
        <h1>Cambiar password</h1>
        <p>Ingrese sus credenciales para acceder como administrador</p>

        <?= form_open("account/cambiar_password"); ?>
        <p>
            <?= form_label_vandalizado('Password actual', 'old_password'); ?>
            <?= form_input($old_password); ?>
        </p>

        <p>
            <?= form_label_vandalizado('Password nueva', 'new_password'); ?>
            <?= form_input($new_password); ?>
        </p>
        
        <p>
            <?= form_label_vandalizado('Confirmar nueva password', 'new_password_confirm'); ?>
            <?= form_input($new_password_confirm); ?>
        </p>
        

        <?= form_submit($user_id); ?>
        <p><?= form_submit('submit', 'Go!'); ?></p>
        <?= form_close(); ?>

        <p><?= anchor('account/recordar_password', 'Olvido su password?'); ?></p>
    </div>
</div>