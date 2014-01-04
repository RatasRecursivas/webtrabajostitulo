<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profesor_model
 *
 * @author natalia
 */
class Profesor_model extends CI_Model {

    var $tabla = 'profesor';

    function __construct() {
        parent::__construct();
    }

    public function getProfesores() {
        $query = $this->db->
                select('first_name, last_name , rut, user_id')->
                from($this->tabla)->
                join('users', 'users.id= profesor.user_id')->
                get();
        return $query->result();
    }

}
