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
 * Description of profesor
 *
 * @author pperez
 */
class Profesor extends CI_Controller {

    var $rut;

    function __construct() {
        parent::__construct();
        $this->load->model('Profesor_model');
        if (!$this->ion_auth->is_admin()) { 
            redirect('account/login');
        }
    }

    public function index() {
        $data['title'] = 'Profesores';
        $data['profesores'] = $this->Profesor_model->getProfesores();
        $this->load->helper('utilities');
        $this->load->view('template/head', $data);
        $this->load->view('profesor/index', $data);
        $this->load->view('template/footer');
    }

    public function obtener($rut = NULL) {
        if(array_key_exists('rut', $this->input->get()))
        {
            $rut = $this->input->get('rut', true); // Hackish
        }
        if ($rut) {
            $this->load->helper('utilities');
            // Validar parametro
            $this->rut = $rut . calcularDV_rut($rut);
            $profesor = $this->Profesor_model->getfromWS($this->rut); // Obtener desde el WS
            if ($profesor) {
//                echo "Insertado correctamente";
                redirect('profesor');
            } else {
//                echo "fail!";
                redirect('profesor');
            }
        } else {
            redirect('profesor');
        }
    }

    public function eliminar($rut = NULL) {
        if ($rut) {
            // Form validation ..
            $profesor = $this->Profesor_model->checkProfesor($rut);

            if ($profesor) { // Veo si el profesor esta en la db
                $this->Profesor_model->eliminar($rut);
                redirect('profesor');
            } else {
                redirect('profesor');
            }
        } else { // Epa! este metodo no es accesible por get
            redirect('profesor');
        }
    }

}
