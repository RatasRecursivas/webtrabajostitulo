<div class="row">
    <div class="large-12 columns">
        <?php
        $nombre_carrera = array(
            'type' => 'text',
            'placeholder' => 'Ingeneria en informatica',
            'name' => 'nombre_carrera',
        );
        $button = array(
            'value' => $agregar_modificar,
            'class' => 'button tiny'
        );
        $attributes = array(
            'class' => 'rigth inline',
        );
        $nombre_codigo = array(
            'type' => 'text',
            'placeholder' => '21030',
            'name' => 'codigo',
        );
        $label_carrera = 'nombre carrera';
        $label_codigo = 'Codigo' ;
        $selec_facultades = array();
        foreach ($facultades as $facultad) {
            $selec_facultades[$facultad->id] = $facultad->nombre_facultad;
        }

        if (isset($query)) {
            $nombre_carrera['value'] = $query->nombre_carrera;
            $id = $query->codigo;
            $nombre_codigo['value'] = $query->codigo;
            $id_facultad = $query->facultad_id;
        } else {
            $nombre_carrera['value'] = '';
            $id = '';
            $nombre_codgio['value'] = '';
            $id_facultad = '';
        }
        ?>
        <?= form_open('carrera/' . strtolower($action)); ?>
        <?= form_fieldset($action . ' Registro'); ?>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('Nombre carrera:',$label_carrera , $attributes); ?>
            </div>
            <div class="small-10 columns">
                <?= form_input($nombre_carrera); ?>
                <?= form_error_small($label_carrera); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('Codigo:', $label_codigo , $attributes); ?>
            </div>
            <div class="small-10 columns">
                <?= form_input($nombre_codigo); ?>
                <?= form_error_small($label_codigo); ?>
            </div>

        </div>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('Nombre Facultad:', 'nombreFacultad', $attributes); ?>
            </div>
            <div class="large-8 columns">
                <?= form_dropdown('facultades', $selec_facultades,$id_facultad); ?>
            </div>
            <div class="small-2  columns">
                <?= form_submit($button); ?>
            </div>
        </div>
        <?= form_hidden('id', $id); ?>
        <?= form_fieldset_close(); ?>
        <?= form_close(); ?>

    </div>
</div>

