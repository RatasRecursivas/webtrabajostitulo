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
            'rules' => 'required|integer|xss_clean|max_length[50]|trim'
        ),
        array(
            'field' => 'facultades',
            'label' => 'Facultad',
            'rules' => 'required|integer|xss_clean|trim|existe_DB[facultad.id]',
        ),
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
        array(
            'field' => 'facultades',
            'label' => 'Facultad',
            'rules' => 'required|integer|xss_clean|trim|existe_DB[facultad.id]',
        ),
    ),
//    'estudiante/obtener' => array(
//        array(
//            'field' => 'rut',
//            'label' => 'RUT',
//            'rules' => 'required|xss_clean|trim',
//        ),
//    ),
);
