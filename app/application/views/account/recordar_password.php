<div class="row">
    <div class="small-8 columns large-centered">
        <h1>Olvido su password?</h1>
        <p>Ingrese su email para reestablecer su password</p>

        <?= form_open("account/recordar_password"); ?>
        <p>
            <?= form_label_vandalizado('Email', 'email'); ?>
            <?= form_input($email); ?>
        </p>

        <p><?= form_submit('submit', 'Login'); ?></p>
        <?= form_close(); ?>
    </div>
</div>