

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

/**
* Description of formulario
*
* @author natalia
*/
<div class="row">
    <div class="large-10  columns">
        <?php
        $nombre_tesis = array(
            'type' => 'text',
            'placeholder' => 'tesis',
            'name' => 'titulo',
        );
        $button = array(
            'value' => $action,
            'class' => 'button tiny'
        );
        $attributes = array(
            'class' => 'rigth inline',
        );
        $rut_autor = array(
            'type' => 'text',
            'placeholder' => 'rut',
            'name' => 'rut',
        );
        $abstract = array(
            'type' => 'text',
            'placeholder' => 'reseña',
            'name' => 'abstract',
        );
        $fecha_publicacion = array(
            'type' => 'date',
            'placeholder' => 'fecha',
            'name' => 'fecha_publicacion',
        );
        $fecha_evaluacion = array(
            'type' => 'date',
            'placeholder' => 'fecha',
            'name' => 'fecha_evaluacion',
        );
        $fecha_disponibilidad = array(
            'type' => 'date',
            'placeholder' => 'fecha',
            'name' => 'fecha_disponibilidad',
        );
        $selec_profesores = array();
        foreach ($profesores as $profesor) {
            $selec_profesores[$profesor->rut] = $profesor->first_name . ' ' . $profesor->last_name;
        }

        if (isset($query)) {
            $nombre_tesis['value'] = $query->titulo;
            $id = $query->id;
            $rut_autor['value'] = $query->estudiante_rut;
            $abstract ['value'] = $query->abstract;
            $fecha_disponibilidad['value'] = $query->feha_disponibilidad;
            $fecha_evaluacion ['value'] = $query->fecha_evaluacion;
            $fecha_publicacion ['value'] = $query->fecha_publicacion;
            $id_profesor = $query->profesor_guia_rut;
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
        <?= form_fieldset($action . ' Registro'); ?>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('Tesis :', 'nombre tesis', $attributes); ?>
            </div>
            <div class="small-10 columns">
                <?= form_input($nombre_tesis); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('rut autor:', 'rut', $attributes); ?>
            </div>
            <div class="small-10 columns">
                <?= form_input($rut_autor); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('Abstract:', 'abstract', $attributes); ?>
            </div>
            <div class="small-10 columns">
                <?= form_textarea($abstract); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('Fecha Publicacion:', 'fecha_p', $attributes); ?>
            </div>
            <div class="small-10 columns">
                <?= form_input($fecha_publicacion); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('fecha disponibilidad:', 'fecha_d', $attributes); ?>
            </div>
            <div class="small-10 columns">
                <?= form_input($fecha_disponibilidad); ?>
            </div>
        </div>
        <div class="row">
            <div class="small-2 columns">
                <?= form_label('fecha evaluacion:', 'fecha_e', $attributes); ?>
            </div>
            <div class="small-10 columns">
                <?= form_input($fecha_evaluacion); ?>
            </div>
        </div>
        <div class="row"> 
            <div class="small-2 columns">
                <?= form_label('Nombre profesor:', 'nombreprofesor', $attributes); ?>
            </div>
            <div class="large-8 columns">
                <?= form_dropdown('profesor_date', $selec_profesores, $id_profesor); ?>
            </div>
            <div class="small-2 columns">
                <?= form_submit($button); ?>
            </div>
        </div>
        <?= form_hidden('id', $id); ?>
        <?= form_fieldset_close(); ?>
        <?= form_close(); ?>

    </div>
</div>


