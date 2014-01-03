<div class="row">
    <div class="large-12 columns">
        <?php
        if (isset($query)) {
            $nombre_carrera = array(
                'type' => 'text',
                'placeholder' => 'Ing...',
                'name' => 'nombre_carrera',
                'value' => $query->nombre_carrera
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
            $nombre_carrera = array(
                'type' => 'text',
                'placeholder' => 'carrera',
                'name' => 'nombre_carrera',
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

        if (isset($query)) {
            $codigo = array(
                'type' => 'text',
                'placeholder' => 'codigo',
                'name' => 'codigo',
                'value' => $query->codigo
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
            $codigo = array(
                'type' => 'text',
                'placeholder' => 'codigo',
                'name' => 'codigo',
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
            $selec_facultades = array();
            foreach ($facultades as $facultad) {
                $selec_facultades[$facultad->id] = $facultad->nombre_facultad;
            }
        }
        ?>
        <?= form_open('carrera/' . strtolower($action)); ?>
        <?= form_fieldset($action . ' Registro'); ?>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('Nombre carrera:', 'nombreCarrera', $attributes); ?>
            </div>
            <div class="small-8 columns">
                <?= form_input($nombre_carrera); ?>
            </div>
            <div class="small-2  columns">
            </div>
        </div>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('Codigo:', 'numerocodigo', $attributes); ?>
            </div>
            <div class="small-8 columns">
                <?= form_input($codigo); ?>
            </div>
            <div class="small-2  columns">
                <?= form_submit($button); ?>
            </div>

        </div>
        <div class="row">
            <?= form_dropdown('facultades', $selec_facultades); ?>
        </div>
        <?= form_hidden('id', $id); ?>
        <?= form_fieldset_close(); ?>
        <?= form_close(); ?>

    </div>
</div>

