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
 * Description of estudiante_model
 *
 * @author pperez
 */
class Estudiante_model extends CI_Model {

    var $tabla_estudiante = 'estudiante'; // Almacena codigo carrera, año ingreso
    var $tabla_users = 'users'; // Almacena nombres, apellidos

    function __construct() {
        parent::__construct();
    }
    
    public function getEstudiante($rut) {
        return $this->db->
                select('users.first_name, users.last_name, estudiante.rut, estudiante.codigo_carrera')
                ->where('estudiante.rut', $rut)
                ->from($this->tabla_estudiante)
                ->join($this->tabla_users, 'estudiante.user_id = users.id')->get()
                ->result();
    }

    public function getfromWS($rut) { // Se va al WS y pesca al wilson
        // Puede añadir o actualizar a un individuo
        $this->load->library('ws_dirdoc');
        $estudiante = $this->ws_dirdoc->getEstudiante($rut);
        date_default_timezone_set('America/Santiago');
        
        if ($estudiante) { // Obtuvimos un array no vacio, veamos ...
            $count = $this->db->select('rut')->from($this->tabla_estudiante)
                    ->where('rut', $estudiante->rut)
                    ->count_all_results(); // Vemos si ya esta en la tabla
            $data_user = array(
                'first_name' => $estudiante->nombres,
                'last_name' => $estudiante->apellidoPaterno . ' ' . $estudiante->apellidoMaterno,
                'ip_address' => '127.0.0.1',
                'username' => $estudiante->rut,
                'password' => '', // I know, i know ... pero no hay logins para nosotros
                'email' => $estudiante->email,
                'created_on' => time(),
                'active' => 0 // Los estudiantes no pueden loggearse :)
            ); // Con esto ya podria llenar a un usuario
            $data_estudiante = array(
                'rut' => $estudiante->rut,
                'anio_ingreso' => $estudiante->anioIngreso,
                'codigo_carrera' => $estudiante->codigoCarrera
            );
            
            if($count > 0) // El registro ya esta en db, actualizamos
            {
                $rut = $estudiante->rut;
                $user_id = $this->db->select('user_id')->from($this->tabla_estudiante)->
                        where('rut', $rut)->get()->row()->user_id;
                $up1 = $this->db->where('id', $user_id)->update($this->tabla_users, $data_user);
                $up2 = $this->db->where('rut', $rut)->update($this->tabla_estudiante, $data_estudiante);
                $fail = !$up1 or !$up2; // Si hay un fail deberia ver ambos ...
                // Pero dejemoslo asi, seamos realistas
            } else { // Añado el registro
                $ins1 = $this->db->insert($this->tabla_users, $data_user); // datos en tabla users
                $user_id = $this->db->select('last_value')
                    ->from('users_id_seq')->get()->row()->last_value; // Ehhh, obtenido despues del insert de arriba
                $data_estudiante['user_id'] = $user_id;
                $ins2 = $this->db->insert($this->tabla_estudiante, $data_estudiante); // datos en tabla estudiante
                $fail = !$ins1 or !$ins2;
            }
        } else {
            $fail = TRUE; // El usuario no existe en el WS, nada que hacer aquí
        }
        return !$fail; // Not fail :)
    }

}
