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
 * Description of estudiante
 *
 * @author pperez
 */

class Estudiante extends CI_Controller {

    var $rut;

    function __construct() {
        parent::__construct();
        $this->load->model('Estudiante_model');
    }

    public function index() {
        if (!$this->ion_auth->is_admin()) {
            redirect('login');
        }
        $data['title'] = 'Estudiantes';
        $data['estudiantes'] = $this->Estudiante_model->getEstudiantes();
        $this->load->helper('utilities_helper');
        $this->load->view('template/head', $data);
        $this->load->view('estudiante/index', $data);
        $this->load->view('template/footer');
    }

    public function obtener($rut = NULL) {
        if (!$this->ion_auth->is_admin()) {
            redirect('login');
        }
        if (array_key_exists('rut', $this->input->get())) {
            $rut = $this->input->get('rut', true);
        }
        if ($rut) {
            $this->load->helper('utilities');
            // Validar parametro
            $this->rut = $rut . calcularDV_rut($rut);
            $estudiante = $this->Estudiante_model->getfromWS($this->rut); // Obtener desde el WS
            if ($estudiante) {
//                echo "Insertado correctamente";
                redirect('estudiante');
            } else {
//                echo "fail!";
                redirect('estudiante');
            }
        } else {
            redirect('estudiante');
        }
    }

    public function eliminar($rut = NULL) {
        if (!$this->ion_auth->is_admin()) {
            redirect('account/login');
        }
        
        if ($rut) { // Si llega por post reviso el rut
            // Form validation ..
            $estudiante = $this->Estudiante_model->checkEstudiante($rut);

            if ($estudiante) { // Veo si el estudiante esta en la db
                $this->Estudiante_model->eliminar($rut);
                redirect('estudiante');
            } else {
                redirect('estudiante');
            }
        } else { // Epa! este metodo no es accesible por get
            redirect('estudiante');
        }
    }

}
