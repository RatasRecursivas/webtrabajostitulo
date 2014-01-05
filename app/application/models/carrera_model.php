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
        $query = $this->db->
                order_by('codigo')->
                select('carrera.codigo,facultad.nombre_facultad, carrera.nombre_carrera')->
                from($this->tabla)->
                join('facultad', 'carrera.id_facultad = facultad.id')->
                get();
        return $query->result();
    }

    public function agregar($data) {
        return $this->db->insert($this->tabla, $data);
    }

    public function editar($id, $data) {
        return $this->db->
                        where('codigo', $id)->
                        update($this->tabla, $data);
    }

    public function getCarrera($id) {
        $query = $this->db->
                        select('carrera.codigo , carrera.nombre_carrera , facultad.id as facultad_id')->
                        from($this->tabla)->
                        where('carrera.codigo', $id)->
                        join('facultad', 'facultad.id = carrera.id_facultad')->
                        get()->row();
        return $query;
    }
    
    public function eliminar($id) {
        return $this->db-> 
                where('codigo',$id)->delete($this->tabla);
    }

    public function checkCarrera($codigo) {
        $count = $this->db->select('codigo')->from($this->tabla)
                ->where('codigo', $codigo)
                ->count_all_results();
        return (bool) $count;
    }

    public function checkCarrera($codigo) {
        $count = $this->db->select('codigo')->from($this->tabla)
                ->where('codigo', $codigo)
                ->count_all_results();
        return (bool) $count;
    }

    public function checkCarrera($codigo) {
        $count = $this->db->select('codigo')->from($this->tabla)
                ->where('codigo', $codigo)
                ->count_all_results();
        return (bool) $count;
    }

}
