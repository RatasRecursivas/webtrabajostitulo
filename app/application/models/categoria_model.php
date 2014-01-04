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

    public function getCategorias() {
        $query = $this->db->order_by('id')->
                select('categoria.id,facultad.nombre_facultad,categoria.nombre_categoria')->
                from($this->tabla)->
                join('facultad', 'categoria.id_facultad = facultad.id')->
                get();
        return $query->result();
    }

    public function agregar($data) {
        return $this->db->insert($this->tabla, $data);
    }

    public function getCategoria($id) {
        $query = $this->db->
                select('categoria.id as categoria_id,facultad.id as facultad_id , categoria.nombre_categoria')->
                from($this->tabla)->
                where('categoria.id',$id)->
                join('facultad', 'categoria.id_facultad = facultad.id')->
                get()->
                row();
        return $query;
    }
    
    public function editar($id,$data){
        return $this->db->
                where('id', $id)->
                update($this->tabla, $data);
    }
    public function eliminar($id) {
        return $this->db-> where('id',$id)->delete($this->tabla);
    }
}
