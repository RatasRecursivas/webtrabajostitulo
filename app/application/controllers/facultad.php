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
 * Description of facultad
 *
 * @author pperez
 */
class Facultad extends CI_Controller {

    var $facultad_id = array();
    var $facultad_datos = array();
    var $facultad_titulo = '';
    var $facultad_acction = '';
    var $facultad_getfalcultad = null;
    var $facultad_todasfacultades = array();
    var $facultad_agregar_modificar = '';

    public function setFacultad_titulo($facultad_titulo) {
        $this->facultad_titulo = $facultad_titulo;
    }

    public function setFacultad_acction($facultad_acction) {
        $this->facultad_acction = $facultad_acction;
    }

    public function setFacultad_getfalcultad($facultad_getfalcultad) {
        $this->facultad_getfalcultad = $facultad_getfalcultad;
    }

    public function setFacultad_todasfacultades($facultad_todasfacultades) {
        $this->facultad_todasfacultades = $facultad_todasfacultades;
    }

    public function setFacultad_agregar_modificar($facultad_agregar_modificar) {
        $this->facultad_agregar_modificar = $facultad_agregar_modificar;
    }

    function __construct() {
        parent::__construct();
        $this->load->model('Facultad_model');
        if (!$this->ion_auth->is_admin()) { // wow
            redirect('account/login');
        }
    }

    public function mostrarVista($vista) {
        $info_view = array(
            'title' => $this->facultad_titulo,
            'action' => $this->facultad_acction,
            'agregar_modificar' => $this->facultad_agregar_modificar,
            'facultades' => $this->facultad_todasfacultades,
            'query' => $this->facultad_getfalcultad,
            'msg' => $this->session->flashdata('msg')
        );
        $this->load->view('template/head', $info_view);
        $this->load->view($vista, $info_view);
        $this->load->view('template/footer');
    }

    private function getDatosPost() {
        $facultad = array(
            'nombre_facultad' => $this->input->post('nombre_facultad', true)
        );
        $this->facultad_datos = $facultad;
    }

    private function getIdPost() {
        $this->facultad_id = $this->input->post('id', true);
    }

    private function ultimasFacultades() {
        return $this->Facultad_model->getFacultades();
    }

    public function redireccionar_msg($link, $mensaje) {
        $this->session->set_flashdata('msg', $mensaje);
        redirect($link);
    }

    public function index() {
//        $this->llenarInfo('Indice', null, null, $this->ultimasTesis());
    
        $this->setFacultad_titulo('Indice | Facultada');
        $this->setFacultad_todasfacultades($this->ultimasFacultades());
        $this->mostrarVista('facultad/index');
    }

    public function agregar() {
     
        $this->setFacultad_titulo('Agregar|Facultad');
        $this->setFacultad_acction('Agregar');
        $this->setFacultad_agregar_modificar('Agregar');
        $this->setFacultad_todasfacultades($this->ultimasFacultades());

        if ($this->input->post()) {
            if ($this->form_validation->run('facultad/formulario')) {
                $this->getDatosPost();
                $guardado = $this->Facultad_model->agregar($this->facultad_datos);

                if ($guardado == true) {
                    $this->redireccionar_msg('facultad ', 'Se agrego correctamente la Facu :)');
                } else {
                    $this->redireccionar_msg('facultad', 'No se agrego correctamente ');
                }
            }
        }
        $this->mostrarVista('facultad/formulario');
    }

    public function editar($id = NULL) {
      
        $id = (int) $id;
        if (!$id) {
            $this->redireccionar_msg('facultad', 'No especifico la facultad a editar!');
        }
        if ($this->input->post()) {
            if ($this->form_validation->run('facultad/formulario')) {
                $this->getIdPost();
                $this->getDatosPost();

                $editado = $this->Facultad_model->editar($this->facultad_id, $this->facultad_datos);

                if ($editado == True) {
                    $this->redireccionar_msg('facultad', 'Se modifico correctamente el registro');
                } else {
                    $this->redireccionar_msg('facultad', 'Hubo un error modificando el registro');
                }
            }
        }
        $this->setFacultad_titulo('Editar|Facultad');
        $this->setFacultad_acction('Editar/' . $id);
        $this->setFacultad_getfalcultad($this->Facultad_model->getFacultad($id));
        $this->setFacultad_agregar_modificar('Editar');

        if ($this->facultad_getfalcultad == false) { //Ups no existe ese ID 
            $this->redireccionar_msg('facultad', 'La facultad a editar no es valida, intente nuevamente');
        } else {
            $this->mostrarVista('facultad/formulario');
        }
    }

    public function eliminar($id) {
       
        $id = (int) $id;
        $facultad = $this->Facultad_model->getFacultad($id);
        if ($facultad) { // existe ?
            $eliminado = $this->Facultad_model->eliminar($id);
            if ($eliminado == true) {
                $this->redireccionar_msg('facultad', 'Fue exitosamente eliminado!');
            } else {
                $this->redireccionar_msg('falcultad', 'Intentelo nuevamente, Ups');
            }
        } else {
            $this->redireccionar_msg('facultad', 'No existe esa Falcultad');
        }
    }

}
