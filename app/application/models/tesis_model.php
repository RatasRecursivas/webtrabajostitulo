<?php

/*
 * Copyright (C) 2014 Gente Rata S.A
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

/**
 * Description of tesis_model
 *
 * @author pperez
 */
class Tesis_model extends CI_Model {

    var $tabla = 'tesis';

    function __construct() {
        parent::__construct();
    }

    // Obtiene la fecha actual en formato por defecto postgres
    private function _fecha_actual() {
        $this->load->helper('date');
        date_default_timezone_set('America/Santiago');
        $time = time();
        $format = '%Y-%m-%d %h:%i:%s';
        return mdate($format, $time);
    }

    public function insert($param) {
        return $this->db->insert($param);
    }

    public function getTesis($id, $is_admin) {
        $this->db->
                select('ubicacion_fichero, titulo, id_categoria, abstract,fecha_evaluacion, feha_disponibilidad, '
                        . 'fecha_publicacion, usersprofe.first_name as first_name_profe, usersprofe.last_name as last_name_profe,'
                        . 'tesis.id, estudiante_rut, profesor_guia_rut,'
                        . 'usersestudiante.first_name as first_name_estudiante, usersestudiante.last_name as last_name_estudiante,'
                        . 'categoria.nombre_categoria')->
                from($this->tabla)->
                where('tesis.id', $id);

        if (!$is_admin) {// Si no es admin solo debe ver las tesis disponibles
            $this->db->where('tesis.feha_disponibilidad < ', $now);
        }
        
        $query = $this->db->
        join('estudiante', 'tesis.estudiante_rut = estudiante.rut')->
                join('carrera', 'carrera.codigo = estudiante.codigo_carrera')->
                join('facultad', 'facultad.id = carrera.id_facultad')->
                join('profesor', 'tesis.profesor_guia_rut = profesor.rut')->
                join('categoria', 'tesis.id_categoria = categoria.id')->
                join('users as usersestudiante', 'estudiante.user_id = usersestudiante.id')->
                join('users as usersprofe', 'profesor.user_id = usersprofe.id')->
                get()->
                row();
        return $query;
    }

    public function contar() {
        return $this->db->count_all($this->tabla);
    }

    public function getTodas($is_admin) {
        $now = $this->_fecha_actual();
        $this->db->
                        select('tesis.fecha_publicacion, tesis.id, tesis.titulo, users.first_name as first_name_estudiante, users.last_name as last_name_estudiante, tesis.abstract')->
                        from($this->tabla);
        if (!$is_admin) {// Si no es admin solo debe ver las tesis disponibles
            $this->db->where('tesis.feha_disponibilidad < ', $now);
        }
        $query = $this->db->
                        join('estudiante', 'tesis.estudiante_rut = estudiante.rut', 'inner')->
                        join('users', 'users.id = estudiante.user_id', 'inner')->
                        order_by('tesis.fecha_publicacion', 'desc')->get();
        return $query->result();
    }

    public function getProximasDefensas($limit = 5) {
        $now = $this->_fecha_actual();
        $query = $this->db->select('tesis.titulo, tesis.fecha_evaluacion, users.first_name, users.last_name')->from($this->tabla)->where('tesis.fecha_evaluacion >', $now)->join('estudiante', 'tesis.estudiante_rut = estudiante.rut', 'inner')->join('users', 'users.id = estudiante.user_id', 'inner')->limit($limit)->order_by('tesis.fecha_evaluacion', 'desc')->get();
        return $query->result();
    }

    public function editar($id, $data) {
        return $this->db->where('id', $id)->update($this->tabla, $data);
    }

    public function agregar($data) {
        return $this->db->insert($this->tabla, $data);
    }

    public function eliminar($id) {
        return $this->db->
                        where('id', $id)->delete($this->tabla);
    }

    public function getFiltrarTesis($array) {
//        $array = array();
        $query = $this->db->
                select('ubicacion_fichero, titulo, id_categoria, abstract,fecha_evaluacion, feha_disponibilidad, '
                        . 'fecha_publicacion, usersprofe.first_name as first_name_profe, usersprofe.last_name as last_name_profe,'
                        . 'tesis.id, estudiante_rut, profesor_guia_rut,'
                        . 'usersestudiante.first_name as first_name_estudiante, usersestudiante.last_name as last_name_estudiante,'
                        . 'categoria.nombre_categoria')->
                from($this->tabla)->
                where($array)->
                join('estudiante', 'tesis.estudiante_rut = estudiante.rut')->
                join('carrera', 'carrera.codigo = estudiante.codigo_carrera')->
                join('facultad', 'facultad.id = carrera.id_facultad')->
                join('profesor', 'tesis.profesor_guia_rut = profesor.rut')->
                join('categoria', 'tesis.id_categoria = categoria.id')->
                join('users as usersestudiante', 'estudiante.user_id = usersestudiante.id')->
                join('users as usersprofe', 'profesor.user_id = usersprofe.id')->
                get();
        return $query->result();
    }

}
