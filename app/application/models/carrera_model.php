<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of carrera_model
 *
 * @author natalia
 */
class Carrera_model extends CI_Model {

    var $tabla = 'carrera';

    function __construct() {
        parent::__construct();
    }
    
    public function getCarreras() {
        $query = $this->db->order_by('codigo')->select('carrera.codigo,facultad.nombre_facultad, carrera.nombre_carrera')->from($this->tabla)->join('facultad', 'carrera.id_facultad = facultad.id')->get();
        return $query-> result();
        
    }
}
