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
 * Description of profesor_model
 *
 * @author pperez
 */
class Profesor_model extends CI_Model {

    var $tabla_profesor = 'profesor'; // Almacena rut y user
    var $tabla_users = 'users'; // Almacena nombres, apellidos

    function __construct() {
        parent::__construct();
    }

    public function getProfesores() {
        return $this->db->order_by('rut')
                        ->select('users.email, users.first_name, users.last_name, profesor.rut')
                        ->from($this->tabla_profesor)
                        ->join($this->tabla_users, 'profesor.user_id = users.id')
                        ->get()->result();
    }

    public function getProfesor($rut) { // Recibe sin dv
        return $this->db->
                        select('users.first_name, users.last_name, profesor.rut')
                        ->where('profesor.rut', $rut)
                        ->from($this->tabla_profesor)
                        ->join($this->tabla_users, 'profesor.user_id = users.id')->get()
                        ->result();
    }

    public function getfromWS($rut) { // Se va al WS y carga al wilson
        // Puede añadir o actualizar a un individuo
        // Recibir con dv
        $this->load->library('ws_dirdoc');
        $profesor = $this->ws_dirdoc->getAcademico($rut);
        date_default_timezone_set('America/Santiago'); // Se usa la funcion time()

        if ($profesor) { // Obtuvimos un array no vacio, veamos ...
            $esta_en_db = $this->checkProfesor($rut);
            $data_user = array(
                'first_name' => $profesor->nombres,
                'last_name' => $profesor->apellidoPaterno . ' ' . $profesor->apellidoMaterno,
                'ip_address' => '127.0.0.1',
                'username' => $profesor->rut,
                'password' => '', // I know, i know ... pero no hay logins para academicos tampoco
                'email' => '', // Aparentemente los academicos no tienen correo en dirdoc ...
                'created_on' => time(),
                'active' => 0 // Los academicos tampoco pueden hacer login
            ); // Con esto ya podria llenar a un usuario

            $data_profesor = array(
                'rut' => $profesor->rut
            );

            if ($esta_en_db) { // El registro ya esta en db, actualizamos
                $rut = $profesor->rut; // Probablemente deberia validar el rut
                $user_id = $this->db->select('user_id')->from($this->tabla_profesor)->
                                where('rut', $rut)->get()->row()->user_id;
                $up1 = $this->db->where('id', $user_id)->update($this->tabla_users, $data_user);
                $up2 = $this->db->where('rut', $rut)->update($this->tabla_profesor, $data_profesor);
                $fail = !$up1 or !$up2; // Si hay un fail deberia ver ambos ...
                // Pero dejemoslo asi, seamos realistas
            } else { // Añado el registro
                $ins1 = $this->db->insert($this->tabla_users, $data_user); // datos en tabla users
                $user_id = $this->db->select('last_value')
                                ->from('users_id_seq')->get()->row()->last_value; // Ehhh, obtenido despues del insert de arriba
                $data_profesor['user_id'] = $user_id;
                $ins2 = $this->db->insert($this->tabla_profesor, $data_profesor); // datos en tabla profesor
                $fail = !$ins1 or !$ins2;
            }
        } else {
            $fail = TRUE; // El usuario no existe en el WS, nada que hacer aquí
        }
        return !$fail; // Not fail :)
    }

    public function eliminar($rut) {
        if ($rut == 12345678) // Vandal!
            return false;

        $this->load->helper('utilities');
//        $rut = decode_rut($rut);
        // sacamos el difito verificador por que en la db esta sin este valor
        // Ver el usuario asociado al rut
        if ($this->checkProfesor($rut)) {
            $rut = decode_rut($rut);
            $rut = substr($rut, 0, -1);
            $user_id = $this->db->where('rut', $rut)->select('user_id')
                            ->from($this->tabla_profesor)->get()->row()->user_id;
            $d1 = $this->db->where('rut', $rut)->delete($this->tabla_profesor);
            $d2 = $this->db->where('id', $user_id)->delete($this->tabla_users);
            $fail = !$d1 or !$d2;
        } else {
            $fail = true;
        }
        return !$fail;
    }

    // Retorna si un profesor existe o no en db
    public function checkProfesor($rut) {
        // en la db esta sin digito verificador ¬¬
        $rut = decode_rut($rut);
        $rut = substr($rut, 0, -1);
        $count = $this->db->select('rut')->from($this->tabla_profesor)
                ->where('rut', $rut)
                ->count_all_results();
        return (bool) $count;
    }

}
