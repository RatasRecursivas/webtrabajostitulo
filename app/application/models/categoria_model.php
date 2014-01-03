<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Categoria_model extends CI_Model {

    var $tabla = 'categoria';

    public function __construct() {
        parent::__construct();
    }

    public function saludar() {
        return 'hola';
    }

    public function getCategorias() {
        $query = $this->db->order_by('id')->get($this->tabla);
        return $query->result();
    }

}
