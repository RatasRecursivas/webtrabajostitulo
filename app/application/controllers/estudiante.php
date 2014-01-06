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

    var $estudiante_rut;
    var $estudiante_titulo;
    var $estidiante_todosEstudiante;
    var $error_rut = null;

    function __construct() {
        parent::__construct();
        $this->load->model('Estudiante_model');
        if (!$this->ion_auth->is_admin()) {
            redirect('account/login');
        }
    }

    public function setEstudiante_titulo($estudiante_titulo) {
        $this->estudiante_titulo = $estudiante_titulo;
    }

    public function setError_rut($error_rut) {
        $this->error_rut = $error_rut;
    }

    public function setEstudiante_rut($estudiante_rut) {
        $this->estudiante_rut = $estudiante_rut;
    }

    public function setEstidiante_todosEstudiante($estidiante_todosEstudiante) {
        $this->estidiante_todosEstudiante = $estidiante_todosEstudiante;
    }

    public function mostrar_view($vista) {
        $info_view = array(
            'title' => $this->estudiante_titulo,
            'estudiantes' => $this->estidiante_todosEstudiante,
            'msg' => $this->session->flashdata('msg'),
            'error_rut' => $this->error_rut,
        );
        $this->load->view('template/head', $info_view);
        $this->load->view($vista, $info_view);
        $this->load->view('template/footer');
    }

    public function redireccionar_msg($link, $menjase) {
        $this->session->set_flashdata('msg', $menjase);
        redirect($link);
    }

    public function index() {
        $this->setEstudiante_titulo('Estudiantes');
        $this->setEstidiante_todosEstudiante($this->Estudiante_model->getEstudiantes());
        $this->mostrar_view('estudiante/index');
    }

    public function obtener($rut = NULL) {
        if (array_key_exists('rut', $this->input->get())) {
            $rut = $this->input->get('rut', true);
        }
        if ($rut) {
            $patron = "/^[[:digit:]]+$/";
            if (preg_match($patron, $rut)) {
//                $this->estudiante_rut = $rut . calcularDV_rut($rut);
                $this->setEstudiante_rut($rut.calcularDV_rut($rut));
                $agregado = $this->Estudiante_model->getfromWS($this->estudiante_rut); // Obtener desde el WS
                if ($agregado) {
                    $this->redireccionar_msg('estudiante', 'El registro con rut ' . esRut($this->estudiante_rut) . ' está ingresado en la base de datos');
                } else {
                    $this->redireccionar_msg('estudiante', 'Ups el rut ingresado no es un estudiante');
                }
            } else {
                $this->setError_rut('Rut mal ingresado ');
            }
            $this->setEstudiante_titulo('Estudiante');
            $this->setEstidiante_todosEstudiante($this->Estudiante_model->getEstudiantes());
            $this->mostrar_view('estudiante/index');
        } else {
            $this->redireccionar_msg('estudiante', 'No se ha ingresado el rut!');
        }
    }

    public function eliminar($rut = NULL) {
        if ($rut) { // Si llega por post reviso el rut
            // Form validation ..
            $rut = (int) $rut;

            $estudiante = $this->Estudiante_model->checkEstudiante($rut);

            if ($estudiante) { // Veo si el estudiante esta en la db
                $this->Estudiante_model->eliminar($rut);
                $this->setEstudiante_rut($rut.calcularDV_rut($rut));
                $this->redireccionar_msg('estudiante', 'Estudiante con Rut: ' . esRut($this->estudiante_rut) . ' ha sido eliminado!');
            } else {
                $this->redireccionar_msg('estudiante', 'No existe el Rut: ' . $rut . ' en la base de datos');
            }
        } else { // Epa! este metodo no es accesible por get
            $this->redireccionar_msg('estudiante', 'Que esta haciendo ?');
        }
    }

}
