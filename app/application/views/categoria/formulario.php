<div class="row">
    <div class="large-12 columns">
        <?php
        $nombre_categoria = array(
            'type' => 'text',
            'placeholder' => 'Ing...',
            'name' => 'nombre_categoria',
        );
        $button = array(
            'value' => $agregar_modificar,
            'class' => 'medium button green'
        );
        $select_facultad = array();
        foreach ($facultades as $facultad) {
            $select_facultad[$facultad->id] = $facultad->nombre_facultad;
        }
        $label_categoria = 'nombre_categoria';
        if (isset($query)) {
            $nombre_categoria['value'] = $query->nombre_categoria;
            $id = $query->categoria_id;
            $select_option = $query->facultad_id;
        } else {
            $nombre_categoria['value'] = set_value($label_categoria);
            $id = '';
            $select_option = '';
        }
        ?>
        <?= form_open('categoria/' . strtolower($action)); ?>
        <?= form_fieldset($agregar_modificar . ' Registro'); ?>
        <div class="row">
            <div class="large-6 columns">
                <?= form_label('Nombre Categoria:', $label_categoria); ?>
                <?= form_input($nombre_categoria); ?>
                <?= form_error_small($label_categoria); ?>
            </div>
            <div class="large-6 columns">
                <?= form_label('Facultad:', 'nombre_facultad'); ?>
                <?= form_dropdown('facultades', $select_facultad, $select_option); ?>
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