<div class="row">
    <div class="large-12 columns">
        <?php
        $label_tesis = 'titulo';
        $label_rut = 'rut';
        $label_abstract = 'abstract';
        $label_fechap = 'fecha_publicacion_putrido';
        $label_fechad = 'fecha_disponibilidad_putrido';
        $label_fechae_anio = 'fecha_evaluacion_putrido';
        $label_fichero = 'fichero';
        $label_fechae_hora = 'hora_evaluacion';
        $label_categoria = 'categoria_id';
        $label_profesor = 'profesor_date';


        $nombre_tesis = array(
            'type' => 'text',
            'placeholder' => 'Ingenieria de Software...',
            'name' => 'titulo',
        );
        $button = array(
            'value' => $agregar_modificar,
            'class' => 'medium button green'
        );
        $rut_autor = array(
            'type' => 'text',
            'placeholder' => '18.048.821-9',
            'name' => 'rut',
        );
        $abstract = array(
            'type' => 'text',
            'placeholder' => 'Ingrese aquí el abstract de la tesis',
            'name' => 'abstract',
        );
        $fecha_publicacion = array(
            'type' => 'text',
            'placeholder' => '08 de Enero de 2014',
            'name' => 'fecha_publicacion',
            'class' => 'input_date',
        );
        $fecha_evaluacion = array(
            'type' => 'text',
            'placeholder' => '09 de Febrero de 2016',
            'name' => 'fecha_evaluacion',
            'class' => 'input_date',
        );
        $hora_evaluacion = array(
            'type' => 'text',
            'class' => 'input_time',
            'placeholder' => '14:00:00',
            'name' => 'hora_evaluacion'
        );
        $fecha_disponibilidad = array(
            'type' => 'text',
            'placeholder' => '08 de Enero de 2014',
            'name' => 'fecha_disponibilidad',
            'class' => 'input_date',
        );
        $subir_input = array(
            'name' => "userfile",
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
        foreach ($categorias as $categoria) {
            $selec_categorias[$categoria->id] = $categoria->nombre_categoria;
        }

        if (isset($tesis)) {
            $nombre_tesis['value'] = $tesis->titulo;
            $id = $tesis->id;

            $rut_autor['value'] = esRut($tesis->estudiante_rut . calcularDV_rut($tesis->estudiante_rut));
            $abstract ['value'] = $tesis->abstract;
            $fecha_disponibilidad['value'] = $tesis->feha_disponibilidad;
            $fecha_evaluacion['value'] = strptime($tesis->fecha_evaluacion, '%Y-%m-%d');
            $hora_evaluacion['value'] = strptime($tesis->fecha_evaluacion, '%H-%i-%s');

            if (isset($tesis->fecha_evaluacion)) {
                $split_time = explode(' ', $tesis->fecha_evaluacion);
                $fecha_evaluacion['value'] = $split_time[0];
                $hora_evaluacion['value'] = $split_time[1];
            } else {
                $f_e_ano_mes_dia = '';
                $f_e_hora = '';
            }

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
            $fecha_evaluacion['value'] = set_value($label_fechae_anio);
            $fecha_publicacion['value'] = set_value($label_fechap);
            $hora_evaluacion['value'] = set_value($label_fechae_hora);
            $id_categoria = '';
        }
        ?>
        <?= form_open_multipart('tesis/' . strtolower($action)); ?>
        <?= form_fieldset($agregar_modificar . ' Registro'); ?>
        <div class="row">
            <div class="large-12 columns">
                <?= form_label_vandalizado('Titulo Tesis :', $label_tesis, array(), 'Ingrese aquí el nombre de la tesis'); ?>
                <?= form_input($nombre_tesis); ?>
                <?= form_error_small($label_tesis); ?>
            </div>
        </div>
        <div class="row">
            <div class="large-4 columns">
                <?= form_label_vandalizado('Rut Estudiante', $label_rut, array(), 'Ingrese el rut del estudiante con el dígito verificador'); ?>
                <?= form_input($rut_autor); ?>
                <?= form_error_small($label_rut); ?>
            </div>
            <div class="large-4 columns">
                <?= form_label_vandalizado('Nombre profesor:', 'nombreprofesor', array(), 'Seleccione el profesor guía de la tesis '); ?>
                <?= form_dropdown('profesor_date', $selec_profesores, $id_profesor, $dropdown_atrribut); ?>
                <?= form_error_small($label_profesor) ?>
            </div>
            <div class="large-4 columns">
                <?= form_label_vandalizado('Nombre Categoria:', 'nombrecategoria', array(), 'Escoja la categoría perteneciente a la tesis'); ?>
                <?= form_dropdown('categoria_id', $selec_categorias, $id_categoria, $dropdown_atrribut); ?>
                <?= form_error_small($label_categoria) ?>
            </div>
        </div>
        <div class="row">
            <div class="large-3 columns">
                <?= form_label_vandalizado('Fecha Publicacion:', $label_fechap, array(), 'Ingrese el día que estara publicada la tesis'); ?>
                <?= form_input($fecha_publicacion); ?>
                <?= form_error_small($label_fechap); ?>
            </div>
            <div class="large-3 columns">
                <?= form_label_vandalizado('Fecha Disponibilidad:', $label_fechad, array(), 'Ingrese el día que estara disponible la tesis'); ?>
                <?= form_input($fecha_disponibilidad); ?>
                <?= form_error_small($label_fechad); ?>
            </div>
            <div class="large-6 columns">
                <div class="row">
                    <?= form_label_vandalizado('Fecha Evaluacion:', '', array(), 'Ingrese el día y la hora en que se defendera la tesis') ?>
                    <div class="large-6 columns">
                        <?= form_input($fecha_evaluacion); ?>
                        <?= form_error_small($label_fechae_anio); ?>
                    </div>
                    <div class="large-6 columns">
                        <?= form_input($hora_evaluacion); ?>
                        <?= form_error_small($label_fechae_hora); ?>
                    </div>
                </div>
            </div>
            <!--<div class="large-4 columns">-->
            <!--</div>-->
        </div>
        <div class="row">
            <div class="large-12 columns">
                <?= form_label_vandalizado('Abstract:', $label_abstract, array(), 'Ingrese aquí el abstract perteneciente a la tesis'); ?>
                <?= form_textarea($abstract); ?>
                <?= form_error_small($label_abstract); ?>
            </div>
        </div>
        <div class="row">
            <div class="large-2 columns">

                <?= form_label('Adjunte el Fichero:', '', array(), 'No debe superar los 30 mb'); ?>
            </div>
            <div class="large-10 columns">
                <?= form_upload($subir_input) ?>
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


