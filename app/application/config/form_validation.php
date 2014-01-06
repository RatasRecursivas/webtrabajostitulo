<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config = array(
    'carrera/formulario' => array(
        array(
            'field' => 'nombre_carrera',
            'label' => 'Nombre Carrera',
            'rules' => 'required|xss_clean|max_length[50]|trim'
        ),
        array(
            'field' => 'codigo',
            'label' => 'Codigo',
            'rules' => 'required|xss_clean|max_length[50]|trim'
        )
    ),
    'facultad/formulario' => array(
        array(
            'field' => 'nombre_facultad',
            'label' => 'Nombre Facultad',
            'rules' => 'required|xss_clean|max_length[50]|trim'
        ),
    ),
    'categoria/formulario' => array(
        array(
            'field' => 'nombre_categoria',
            'label' => 'Nombre Categoria',
            'rules' => 'required|xss_clean|trim|max_length[50]'
        ),
    ),
    'tesis/formulario' => array(
        array(
            'field' => 'titulo',
            'label' => 'Titulo Tesis',
            'rules' => 'required|xss_clean|trim|max_length[200]'
        ),
        array(
            'field' => 'rut',
            'label' => 'Rut Autor',
            'rules' => 'required|xss_clean|trim|value_rut'
        ),
        array(
            'field' => 'abstract',
            'label' => 'Abstract',
            'rules' => 'required|xss_clean|trim|max_length[1000]'
        ),
        array(
            'field' => 'fecha_publicacion',
            'label' => 'Fecha Publicación',
            'rules' => 'required|xss_clean|trim|validate_fecha_anio_mes_dia'
        ),
        array(
            'field' => 'fecha_evaluacion',
            'label' => 'Fecha de Evaluación',
            'rules' => 'xss_clean|trim|validate_fecha_anio_mes_dia'
        ),
        array(
            'field' => 'hora_evaluacion',
            'label' => 'Hora de envaluacion',
            'rules' => 'xss_clean|trim|validate_hora_minuto_segundo'
        ),
        array(
            'field' => 'fecha_disponibilidad',
            'label' => 'Fecha de Disponibilidad',
            'rules' => 'required|xss_clean|trim|validate_fecha_anio_mes_dia'
        ),
//        array(
//            'field' => 'fichero',
//            'label' => 'Fichero',
//            'rules' => 'comprombar_fichero'
//        ),
    ),
);
