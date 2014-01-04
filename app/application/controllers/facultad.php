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

    var $datos_view = array();
    var $facultad_id = "";
    var $facultad_datos = "";

    function __construct() {
        parent::__construct();
        $this->load->model('Facultad_model');
    }

    private function llenarInfo($title, $acction, $agregar_editar, $ultimasFacultades = null, $getFacultad = null) {
        $info = array(
            'title' => $title,
            'action' => $acction,
            'facultades' => $ultimasFacultades,
            'query' => $getFacultad,
            'agregar_modificar'=> $agregar_editar,
        );
        return $info;
    }

    public function mostrarVista($view, $data) {
        $this->load->view('template/head', $data);
        $this->load->view($view, $data);
        $this->load->view('template/footer');
    }

    private function getDatosPost() {
        $facultad = array(
            'nombre_facultad' => $this->input->post('nombre_facultad', true)
        );
        return $facultad;
    }

    private function getIdPost() {
        $id = $this->input->post('id', true);
        return $id;
    }

    private function ultimasTesis() {
        return $this->Facultad_model->getFacultades();
    }
    
    public function redireccionar_msg($link,$mensaje) {
        $this->session->set_flashdata('msg',$mensaje);
        redirect($link);
    }

    public function index() {
        $this->datos_view = $this->llenarInfo('Indice', null, null, $this->ultimasTesis());
        $this->mostrarVista('facultad/index', $this->datos_view);
    }

    public function agregar() {
        $datos_view = $this->llenarInfo('Agregar Facultad', 'Agregar','Guardar');
        if ($this->input->post()) {
            if ($this->form_validation->run('facultad/formulario')) {
                $this->facultad_datos = $this->getDatosPost();
                $guardado = $this->Facultad_model->agregar($this->facultad_datos);
                if ($guardado == true) {
                    $this->redireccionar_msg('facultad', 'Se agrego correctamente la facultdad');
                } else {
                    $this->redireccionar_msg('msg', 'Hubo un problema agregando la facultad');
                }
            }
        }
        $this->mostrarVista('facultad/formulario', $datos_view);
    }

    public function editar($id = NULL) {
        $id = (int) $id;
        if (!$id) {
            $this->redireccionar_msg('facultad','No especifico la facultad a editar!');
        }
        if ($this->input->post() ) { // Llega por post
            if ($this->form_validation->run('facultad/formulario') ) {//validamos los datos
                $this->facultad_id = $this->getIdPost(); //ok obten toda info, 
                $this->facultad_datos = $this->getDatosPost();
                //editar entonces!
                $editado = $this->Facultad_model->editar($this->facultad_id, $this->facultad_datos);
                if ($editado == True) {
                    $this->redireccionar_msg('facultad', 'Se modifico correctamente el registro');
                } else {
                    $this->redireccionar_msg('facultad', 'Hubo un error modificando el registro');
                }
            }
        }
        $this->datos_view = $this->llenarInfo('Editar de Facultar', 'Editar/'.$id, 'Editar',null, $this->Facultad_model->getFacultad($id));
        if (!$this->datos_view['query']) { //Ups no existe ese ID 
            $this->redireccionar_msg('facultad', 'La facultad a editar no es valida, intente nuevamente');
        } 
        $this->mostrarVista('facultad/formulario', $this->datos_view);
    }

}
