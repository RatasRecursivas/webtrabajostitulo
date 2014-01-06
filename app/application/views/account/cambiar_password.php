<?php echo form_open("account/cambiar_password");?>

      <p>
            <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
            <?php echo form_input($old_password);?>
      </p>

      <p>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
            <?php echo form_input($new_password);?>
      </p>

      <p>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm);?>
      </p>

      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>

<?php echo form_close();?>

      
<div class="row">
    <div class="small-8 columns large-centered">
        <h1>Cambiar password</h1>
        <p>Ingrese sus credenciales para acceder como administrador</p>
        
        <?= form_open("account/cambiar_password"); ?>
        <p>
            <?= form_label_vandalizado('Password actual', 'old_password'); ?>
            <?= form_input($identity); ?>
        </p>
        
        <p>
            <?= form_label_vandalizado('Password nuevo', 'new_password'); ?>
            <?= form_input($password); ?>
        </p>
        
        <p><?= form_submit('submit', 'Login'); ?></p>
        <?= form_close(); ?>
        
        <p><?= anchor('account/recordar_password', 'Olvido su password?'); ?></p>
    </div>
</div>