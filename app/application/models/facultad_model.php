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
 * Description of facultad_model
 *
 * @author pperez
 */

class Facultad_model extends CI_Model{
    var $tabla = 'facultad';
    
    function __construct() {
        parent::__construct();
    }
    
    public function getFacultades() {
        $query = $this->db->order_by('id')->get($this->tabla);
        return $query->result();
    }
    
    public function editar($id, $data)
    {
        return $this->db->
                where('id', $id)->
                update($this->tabla, $data);
    }
    
    public function getFacultad($id)
    {
        $query = $this->db->where('id', $id)->get($this->tabla)->row();
        return $query;
    }
    
    public function agregar($data)
    {
        return $this->db->insert($this->tabla, $data);
    }
     
    public function eliminar($id) {
        return $this->db->
                where('id',$id)->
                delete($this->tabla);
    }
}
