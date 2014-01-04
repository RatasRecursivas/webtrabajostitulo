<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config = array(
    'facultad/formulario' => array(
        array(
            'field' => 'nombre_facultad',
            'label'=> 'Nombre Facultad',
            'rules' => 'required|xss_clean|max_length[50]|trim'
        ),
    ),
);