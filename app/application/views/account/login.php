<div class="row">
    <div class="large-12 columns">
        <?php
        $label_user = 'user';
        $input_usuer = array(
            'type' => 'text',
            'placeholder' => 'Admin',
            'name' => $label_user,
        );
        $label_password = 'password';
        $input_password = array(
            'type' => 'password',
            'name' => $label_password,
        );
        $submit_form = array(
            'class' => 'medium button green',
        );
        ?>

        <?= form_open('login/'); ?>
        <?= form_fieldset('Ingresar Datos') ?>
        <div class="row">
            <?= '<h1>' . validation_errors() . '</h1>' ?>
            <div class="large-12 columns">
                <?= form_label('Usuario', $label_user) ?>
                <?= form_input($input_usuer) ?>
            </div>
            <div class="large-12 columns">
                <?= form_label('Password', $label_password) ?>
                <?= form_input($input_password) ?>
            </div>
            <div class="large-12 columns">
                <?= form_submit($submit_form) ?>
            </div>
        </div>
    </div>
</div>