<div class="row">
    <div class="large-12 columns">
         <?php
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
         $dropdown_atrribut = 'class="medium"';
         $label_tesis = 'titulo tesis';
         $label_rut = 'rut autor';
         $label_abstract = 'abstract';
         $label_fechap = 'fecha de publicacion';
         $label_fechad = 'fecha de disponibilidad';
         $label_fechae = 'fecha de evaluacion';

         $selec_profesores = array();
         foreach ($profesores as $profesor) {
             $selec_profesores[$profesor->rut] = $profesor->first_name . ' ' . $profesor->last_name;
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
         } else {
             $nombre_tesis['value'] = '';
             $id = '';
             $id_profesor = "";
             $rut_autor['value'] = '';
             $abstract ['value'] = '';
             $fecha_disponibilidad['value'] = '';
             $fecha_evaluacion ['value'] = '';
             $fecha_publicacion ['value'] = '';
         }
         ?>
         <?= form_open('tesis/' . strtolower($action)); ?>
         <?= form_fieldset($agregar_modificar . ' Registro'); ?>
         <div class="row">
            <div class="large-12 columns">
                <?= form_label('Titulo Tesis :', $label_tesis); ?>
                <?= form_input($nombre_tesis); ?>
                <?= form_error_small($label_tesis); ?>
            </div>
        </div>
        <div class="row">
            <div class="large-6 columns">
                <?= form_label('Rut Estudiante:', $label_rut); ?>
                <?= form_input($rut_autor); ?>
                <?= form_error_small($label_rut); ?>
            </div>
            <div class="large-6 columns">
                <?= form_label('Nombre profesor:', 'nombreprofesor'); ?>
                <?= form_dropdown('profesor_date', $selec_profesores, $id_profesor, $dropdown_atrribut); ?>
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
            <div class="large-12 columns">
                <?= form_submit($button); ?>
            </div>
        </div>
        <?= form_hidden('id', $id); ?>
        <?= form_fieldset_close(); ?>
        <?= form_close(); ?>

    </div>
</div>


