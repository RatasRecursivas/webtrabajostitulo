<div class="row">
    <div class="large-12 columns">
        <?php
        $nombre_categoria = array(
            'type' => 'text',
            'placeholder' => 'Ing...',
            'name' => 'nombre_categoria',
        );
        $button = array(
            'value' => $action,
            'class' => 'button tiny'
        );
        $attributes = array(
            'class' => 'rigth inline',
        );
        $select_facultad = array();
        foreach ($facultades as $facultad) {
            $select_facultad[$facultad->id] = $facultad->nombre_facultad;
        }
        
        
        if (isset($query)) {
            $nombre_facultad['value'] = $query->nombre_categoria;
            $id = $query->id;
        } else {
            $nombre_facultad['value'] = '';
            $id = '';
        }
        ?>
        <?= form_open('categoria/' . strtolower($action)); ?>
        <?= form_fieldset($action . ' Registro'); ?>
        <div class="row">
            <div class="large-12 columns">
                <?= form_label('Nombre Categoria:', 'nombre_categoria', $attributes); ?>
                <?= form_input($nombre_categoria); ?>
                <?= form_dropdown('Facultad',$select_facultad); ?>
            </div>
            
        </div>
        <?= form_fieldset_close(); ?>
        <?= form_close(); ?>
    </div>
</div>