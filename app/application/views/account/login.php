<div class="row">
    <div class="small-8 columns large-centered">
        <h1>Login</h1>
        <?php
            $submit = array(
                'value' => 'Ingresar',
                'class' => 'button green'
            );
        ?>
        <p>Ingrese sus credenciales para acceder como administrador</p>
        
        <?= form_open("account/login"); ?>
        <p>
            <?= form_label_vandalizado('Usuario/Email', 'identity'); ?>
            <?= form_input($identity); ?>
        </p>
        
        <p>
            <?= form_label_vandalizado('Password', 'password'); ?>
            <?= form_input($password); ?>
        </p>
        
        <p><?= form_submit($submit); ?></p>
        <?= form_close(); ?>
        
        <p><?= anchor('account/recordar_password', 'Olvido su password?'); ?></p>
    </div>
</div>