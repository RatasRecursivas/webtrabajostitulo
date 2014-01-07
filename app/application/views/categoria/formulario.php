<div class="row">
    <div class="large-12 columns">
        <?php
        $nombre_categoria = array(
            'type' => 'text',
            'placeholder' => 'Redes Neuronales',
            'name' => 'nombre_categoria',
        );
        $button = array(
            'value' => $agregar_modificar,
            'class' => 'medium button green'
        );
        $label_categoria = 'nombre_categoria';
        $label_facultad = 'facultades';
        $select_facultad = array();
        foreach ($facultades as $facultad) {
            $select_facultad[$facultad->id] = $facultad->nombre_facultad;
        }
        if (isset($query)) {
            $nombre_categoria['value'] = $query->nombre_categoria;
            $id = $query->categoria_id;
            $select_option = $query->facultad_id;
        } else {
            $nombre_categoria['value'] = set_value($label_categoria);
            $id = '';
            $select_option = set_value($label_facultad);
        }
        ?>
        <?= form_open('categoria/' . strtolower($action)); ?>
        <?= form_fieldset($agregar_modificar . ' Registro'); ?>
        <div class="row">
            <div class="large-6 columns">
                <?= form_label_vandalizado('Nombre Categoria:', $label_categoria, array(), 'Ingrese el nombre de la categoría a la cual pertenece una tesis'); ?>
                <?= form_input($nombre_categoria); ?>
                <?= form_error_small($label_categoria); ?>
            </div>
            <div class="large-6 columns">
                <?= form_label_vandalizado('Facultad:', 'nombre_facultad', array(), 'Seleccione la facultad a la cual pertenece la categoría'); ?>
                <?= form_dropdown('facultades', $select_facultad, $select_option); ?>
                <?= form_error_small($label_facultad) ?>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <?= form_submit($button); ?>
            </div>
        </div>
        <?= form_hidden('id', $id); ?>

    </div>
    <?= form_fieldset_close(); ?>
    <?= form_close(); ?>
</div>