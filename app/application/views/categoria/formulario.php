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
            'class' => 'button tiny'
        );
        $attributes_label = array(
            'class' => 'rigth inline',
        );
        $select_facultad = array();
        foreach ($facultades as $facultad) {
            $select_facultad[$facultad->id] = $facultad->nombre_facultad;
        }
        if (isset($query)) {
            $nombre_categoria['value'] = $query->nombre_categoria;
            $id = $query->categoria_id;
            $select_option = $query->facultad_id;
        } else {
            $nombre_facultad['value'] = '';
            $id = '';
            $select_option = '';
        }
        $label_categoria = 'nombre_categoria';
        ?>
        <?= form_open('categoria/' . strtolower($action)); ?>
        <?= form_fieldset($agregar_modificar . ' Registro'); ?>
        <div class="row">
            <div class="row">
                <div class="small-2 small-centered large-uncentered columns">
                    <?= form_label('Nombre Categoria:', '$label_categoria', $attributes_label); ?>
                </div>
                <div class="small-10 small-centered large-uncentered columns">
                    <?= form_input($nombre_categoria); ?>
                     <?= form_error_small($label_categoria); ?>
                </div>
            </div>
            <div class="row">
                <div class="small-2 small-centered large-uncentered columns">
                    <?= form_label('Facultad:', 'nombre_facultad', $attributes_label); ?>
                </div>
                <div class="small-8 small-centered large-uncentered columns">
                    <?= form_dropdown('facultades', $select_facultad,$select_option); ?>
                </div>
                <div class="small-2 small-centered large-uncentered columns">
                    <?= form_submit($button); ?>
                </div>
            </div>
            <?= form_hidden('id',$id); ?>

        </div>
        <?= form_fieldset_close(); ?>
        <?= form_close(); ?>
    </div>
</div>