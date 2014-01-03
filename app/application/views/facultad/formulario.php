<div class="row">
    <div class="large-12 columns">
        <?php
        if (isset($query)) {
            $nombre_facultad = array(
                'type' => 'text',
                'placeholder' => 'Ing...',
                'name' => 'nombre_facultad',
                'value' => $query->nombre_facultad
            );

            $button = array(
                'value' => $action,
                'class' => 'button tiny'
            );
            $attributes = array(
                'class' => 'rigth inline',
            );
            $id = $query->id;
        } else {
            $nombre_facultad = array(
                'type' => 'text',
                'placeholder' => 'Ing...',
                'name' => 'nombre_facultad',
                'value' => ''
            );

            $button = array(
                'value' => $action,
                'class' => 'button tiny'
            );
            $attributes = array(
                'class' => 'rigth inline',
            );
            $id = '';
        }
        ?>
        <?= form_open('facultad/' . strtolower($action)); ?>
        <?= form_fieldset($action . ' Registro'); ?>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('Nombre Facultad:', 'nombreFacultad', $attributes); ?>
            </div>
            <div class="small-8 columns">
                <?= form_input($nombre_facultad); ?>
            </div>
            <div class="small-2  columns">
                <?= form_submit($button); ?>
            </div>
            <?= form_hidden('id', $id); ?>
            <?= form_fieldset_close(); ?>
            <?= form_close(); ?>
        </div>
    </div>