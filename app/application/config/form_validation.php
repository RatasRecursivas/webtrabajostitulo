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
            'label' => 'titulo tesis',
            'rules' => 'requerid|xss_clean|trim|max_length[200]'
        ),
        array(
            'field' => 'rut',
            'label' => 'rut autor',
            'rules' => 'requerid|xss_clean|trim|max_length[9]|interger|value_rut'
        ),
        array(
            'field' => 'abstract',
            'label' => 'abstract',
            'rules' => 'requerid|xss_clean|trim|max_length[1000]'
        ),
        array(
            'field' => 'fecha_publicacion',
            'label' => 'fecha de publicacion',
            'rules' => 'requerid|xss_clean|trim|value_fecha'
        ),
        array(
            'field' => 'fecha_evaluacion',
            'label' => 'fecha de evaluacion',
            'rules' => 'requerid|xss_clean|trim|value_fecha_hora'
        ),
        array(
            'field' => 'fecha_disponibilidad',
            'label' => 'fecha de disponibilidad',
            'rules' => 'requerid|xss_clean|trim|value_fecha'
        ),
    ),
);
