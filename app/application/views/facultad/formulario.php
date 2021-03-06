<div class="row">
    <div class="large-12 columns">
        <?php
        $nombre_facultad = array(
            'type' => 'text',
            'placeholder' => 'Facultad de Ingenería',
            'name' => 'nombre_facultad',
        );
        $button = array(
            'value' => $agregar_modificar,
            'class' => 'medium button green'
        );
        $label_facultad = 'nombre_facultad';
        if (isset($query)) {
            $id = $query->id;
            $nombre_facultad['value'] = $query->nombre_facultad;
        } else {
            $id = '';
            $nombre_facultad['value'] = set_value('nombre_facultad');
        }
        if(strlen(validation_errors()) >0 ){ //hay errores!
            $error = 'error';
        } else {
            $error = '';
        }
        
        ?>
        <?= form_open('facultad/' . strtolower($action)); ?>
        <?= form_fieldset($agregar_modificar . ' Registro'); ?>
        <div class="row">
            <div class="large-12 columns <?= $error ?>">
                <?= form_label_vandalizado('Nombre Facultad:', $label_facultad,array(),'Ingrese aquí una facultad perteneciente a la universidad'); ?>
                <?= form_input($nombre_facultad); ?>
                <?= form_error_small($label_facultad); ?>  
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <?= form_submit($button); ?>
            </div>
        </div>

        <?= form_hidden('id', $id); ?>
        <?= form_fieldset_close(); ?>
        <?= form_close(); ?>
    </div>
</div>