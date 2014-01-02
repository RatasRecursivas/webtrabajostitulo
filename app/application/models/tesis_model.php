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
    
    public function insert($param) {
        return $this->db->insert($param);
    }
    
    public function getTesis($id) {
        return $this->db->select('ubicacion_fichero, titulo, abstract, fecha_publicacion, first_name, last_name')->from($this->tabla)->where('tesis.id', $id)->join('estudiante', 'tesis.estudiante_rut = estudiante.rut', 'inner')->join('users', 'users.id = estudiante.user_id', 'inner')->get()->row();
    }
    
    public function contar() {
        return $this->db->count_all($this->tabla);
    }
    
    public function getTodas()
    {
        $query = $this->db->select('tesis.fecha_publicacion, tesis.id, tesis.titulo, users.first_name, users.last_name, tesis.abstract')->from($this->tabla)->join('estudiante', 'tesis.estudiante_rut = estudiante.rut', 'inner')->join('users', 'users.id = estudiante.user_id', 'inner')->order_by('tesis.fecha_publicacion', 'desc')->get();
        return $query->result();
    }
    
    public function getProximasDefensas($limit = 5)
    {
        $this->load->helper('date');
        $time = time();
        $format = '%Y-%m-%d %h:%i:%s';
        $now = mdate($format, $time);
        $query = $this->db->select('tesis.titulo, tesis.fecha_evaluacion, users.first_name, users.last_name')->from($this->tabla)->where('tesis.fecha_evaluacion >', $now)->join('estudiante', 'tesis.estudiante_rut = estudiante.rut', 'inner')->join('users', 'users.id = estudiante.user_id', 'inner')->limit($limit)->order_by('tesis.fecha_evaluacion', 'desc')->get();
        return $query->result();
    }
}
