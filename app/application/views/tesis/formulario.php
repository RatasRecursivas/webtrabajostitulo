<div class="row">
    <div class="large-12 columns">
        <?php
        
        $label_tesis = 'titulo';
        $label_rut = 'rut';
        $label_abstract = 'abstract';
        $label_fechap = 'fecha_publicacion';
        $label_fechad = 'fecha_disponibilidad';
        $label_fechae = 'fecha_evaluacion';
        $label_fichero = 'fichero';
        
        $nombre_tesis = array(
            'type' => 'text',
            'placeholder' => 'Titulo Tesis...',
            'name' => 'titulo',
        );
        $button = array(
            'value' => $agregar_modificar,
            'class' => 'medium button green'
        );
        $rut_autor = array(
            'type' => 'text',
            'placeholder' => 'Rut...',
            'name' => 'rut',
        );
        $abstract = array(
            'type' => 'text',
            'placeholder' => 'Reseña...',
            'name' => 'abstract',
        );
        $fecha_publicacion = array(
            'type' => 'date',
            'placeholder' => '12/10/2012',
            'name' => 'fecha_publicacion',
        );
        $fecha_evaluacion = array(
            'type' => 'date',
            'placeholder' => '12/10/2012 14:30',
            'name' => 'fecha_evaluacion',
        );
        $fecha_disponibilidad = array(
            'type' => 'date',
            'placeholder' => '12/10/2012',
            'name' => 'fecha_disponibilidad',
        );
        $subir_input = array(
            'type' => "file",
            'name' => "userfile",
            'size' => "20",
                //'class' => "tiny round disabled button"
        );
        $subir_button = array(
            'value' => "upload",
            'class' => 'success button',
        );
        $attributes = 'rigth inline';

        $dropdown_atrribut = 'class="medium"';

        $selec_profesores = array();
        foreach ($profesores as $profesor) {
            $selec_profesores[$profesor->rut] = $profesor->first_name . ' ' . $profesor->last_name;
        }
        $selec_categorias = array();
        foreach ($categorias as $categoria){
            $selec_categorias[$categoria->id] = $categoria->nombre_categoria;
        }
        
        if (isset($tesis)) {
            $nombre_tesis['value'] = $tesis->titulo;
            $id = $tesis->id;
            $rut_autor['value'] = $tesis->estudiante_rut;
            $abstract ['value'] = $tesis->abstract;
            $fecha_disponibilidad['value'] = $tesis->feha_disponibilidad;
            $fecha_evaluacion ['value'] = $tesis->fecha_evaluacion;
            $fecha_publicacion ['value'] = $tesis->fecha_publicacion;
            $id_profesor = $tesis->profesor_guia_rut;
            $id_categoria = $tesis->id_categoria;
        } else {
            $nombre_tesis['value'] = set_value($label_tesis);
            $id = '';
            $id_profesor = "";
            $rut_autor['value'] = set_value($label_rut);
            $abstract ['value'] = set_value($label_abstract);
            $fecha_disponibilidad['value'] = set_value($label_fechad);
            $fecha_evaluacion ['value'] = set_value($label_fechae);
            $fecha_publicacion ['value'] = set_value($label_fechap);
            $id_categoria = '';
        }
        ?>
        <?= form_open_multipart('tesis/' . strtolower($action)); ?>
        <?= form_fieldset($agregar_modificar . ' Registro'); ?>
        <div class="row">
            <div class="large-12 columns">
                <?= form_label('Titulo Tesis :', $label_tesis); ?>
                <?= form_input($nombre_tesis); ?>
                <?=  form_error_small($label_tesis); ?>
            </div>
        </div>
        <div class="row">
            <div class="large-4 columns">
                <?= form_label('Rut Estudiante:', $label_rut); ?>
                <?= form_input($rut_autor); ?>
                <?= form_error_small($label_rut); ?>
            </div>
            <div class="large-4 columns">
                <?= form_label('Nombre profesor:', 'nombreprofesor'); ?>
                <?= form_dropdown('profesor_date', $selec_profesores, $id_profesor, $dropdown_atrribut); ?>
            </div>
            <div class="large-4 columns">
                <?= form_label('Nombre Categoria:', $label_rut); ?>
                <?= form_dropdown('categoria_id',$selec_categorias,$id_categoria,$dropdown_atrribut); ?>
            </div>
        </div>
        <div class="row">
            <div class="large-4 columns">
                <?= form_label('Fecha Publicacion:', $label_fechap); ?>
                <?= form_input($fecha_publicacion); ?>
                <?= form_error_small($label_fechap); ?>
            </div>
            <div class="large-4 columns">
                <?= form_label('Fecha Disponibilidad:', $label_fechad); ?>
                <?= form_input($fecha_disponibilidad); ?>
                <?= form_error_small($label_fechad); ?>
            </div>
            <div class="large-4 columns">
                <?= form_label('Fecha Evaluacion:', $label_fechae); ?>
                <?= form_input($fecha_evaluacion); ?>
                <?= form_error_small($label_fechae); ?>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <?= form_label('Abstract:', $label_abstract); ?>
                <?= form_textarea($abstract); ?>
                <?= form_error_small($label_abstract); ?>
            </div>
        </div>
        <div class="row">
            <div class="large-2 columns">
                
                <?= form_label('Adjunte el Fichero:'); ?>
            </div>
            <div class="large-10 columns">
                <?= form_input($subir_input); ?>
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


