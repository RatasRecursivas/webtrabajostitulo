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

    var $profesorrut;
    var $profesor_titulo;
    var $profesor_todoProfesores;
    var $error_rut = null;

    public function setProfesor_titulo($profesor_titulo) {
        $this->profesor_titulo = $profesor_titulo;
    }

    public function setProfesor_todoProfesores($profesor_todoProfesores) {
        $this->profesor_todoProfesores = $profesor_todoProfesores;
    }

    public function setError_rut($error_rut) {
        $this->error_rut = $error_rut;
    }
    
    
    public function mostrar_view($vista) {
        $info_view = array(
            'title' => $this->profesor_titulo,
            'profesores' => $this->profesor_todoProfesores,
            'msg' => $this->session->flashdata('msg'),
            'error_rut' => $this->error_rut,
        );
        $this->load->view('template/head', $info_view);
        $this->load->view($vista, $info_view);
        $this->load->view('template/footer');
    }
    
    public function redireccionar_msg($link,$menjase){
        $this->session->set_flashdata('msg', $menjase);
        redirect($link);
    }

    function __construct() {
        parent::__construct();
        $this->load->model('Profesor_model');
        if (!$this->ion_auth->is_admin()) {
            redirect('account/login');
        }
    }
    
    
    
    public function setProfesorrut($profesorrut) {
        $this->profesorrut = $profesorrut;
    }

        public function index() {
//        $data['title'] = 'Profesores';
//        $data['profesores'] = $this->Profesor_model->getProfesores();
//        $this->load->helper('utilities');
//        $this->load->view('template/head', $data);
//        $this->load->view('profesor/index', $data);
//        $this->load->view('template/footer');
        $this->setProfesor_titulo('Profesores');
        $this->setProfesor_todoProfesores($this->Profesor_model->getProfesores());
//        $this->mostrar_view('profesor/index');
        $this->mostrar_view('profesor/index');
        
    }

    public function obtener($rut = NULL) {
        if (array_key_exists('rut', $this->input->get())) {
            $rut = $this->input->get('rut', true); // Hackish
        }
        if ($rut) {
//            $this->load->helper('utilities');
            // Validar parametro
            $patron = "/^[[:digit:]]+$/";
            if (preg_match($patron, $rut)) {
                
                $this->setProfesorrut($rut.calcularDV_rut($rut));
                $agregado = $this->Profesor_model->getfromWS($this->profesorrut); // Obtener desde el WS
                if ($agregado) {
//                echo "Insertado correctamente";
                    $this->redireccionar_msg('profesor', 'El registro con rut '.esRut($this->profesorrut).' está ingresado en la base de datos');
                } else {
//                echo "fail!";
                    $this->redireccionar_msg('profesor', 'Ups el Rut ingresado no es un profesor');
                }
            } else {
                $this->setError_rut('Rut mal ingresado ');
            }
            $this->setProfesor_titulo('Profesor');
            $this->setProfesor_todoProfesores($this->Profesor_model->getProfesores());
            $this->mostrar_view('profesor/index');
        } else {
            $this->redireccionar_msg('profesor', 'No se ha ingresado el rut!');
        }
    }

    public function eliminar($rut = NULL) {
        if ($rut) {
            // Form validation ..
            $rut = (int)$rut;
            $profesor = $this->Profesor_model->checkProfesor($rut);

            if ($profesor) { // Veo si el profesor esta en la db
                $this->Profesor_model->eliminar($rut);
                $this->redireccionar_msg('profesor', 'El Profesor con Rut: '. $rut.' ha sido eliminado!');
            } else {
                $this->redireccionar_msg('profesor', 'No existe el Rut: '. $rut .' en la base de datos');
            }
        } else { // Epa! este metodo no es accesible por get
            $this->redireccionar_msg('profesor', 'Que esta haciendo ?');
        }
    }

}
