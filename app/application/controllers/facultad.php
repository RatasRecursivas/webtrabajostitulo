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
    var $facultad_facultades = "";

    function __construct() {
        parent::__construct();
        $this->load->model('Facultad_model');
    }

    private function llenarInfo($title, $acction, $ultimasFacultades = null, $getFacultad=null) {
        $info = array(
            'title' => $title,
            'action' => $acction,
            'facultades' => $ultimasFacultades,
            'query' => $getFacultad,
        );
        return $info;
    }

    public function mostrarVista($view, $data) {
        $this->load->view('template/head', $data);
        $this->load->view($view,$data);
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
    
    private function ultimasTesis(){
        return $this->Facultad_model->getFacultades();
    }
    

    public function index() {
        $this->datos_view = $this->llenarInfo('Indice', null, $this->ultimasTesis());
        $this->mostrarVista('facultad/index', $this->datos_view);
    }

    public function agregar() {
        $datos_view = $this->llenarInfo('Agregar Facultad', 'Agregar');
        if ($this->input->post()) {
            if ($this->form_validation->run('facultad/formulario')) {
                $this->facultad_datos = $this->getDatosPost();

                if ($this->Facultad_model->agregar($this->facultad_datos)) {
                    $this->session->set_flashdata('msg', 'Facultad agregada correctamente');
                    redirect('facultad');
                } else {
                    $this->session->set_flashdata('msg', 'Hubo un problema agregando la facultad');
                    redirect('facultad');
                }
            }
        }
        $this->mostrarVista('facultad/formulario', $datos_view);
    }

    public function editar($id = NULL) {
        $this->datos_view = $this->llenarInfo('Editar de Facultar', 'Editar', null, $this->Facultad_model->getFacultad($id));
        if ($this->input->post()) { // Llega por post
            if ($this->form_validation->run('facultad/formulario')) {

                $this->facultad_id = $this->getIdPost();
                $this->facultad_datos = $this->getDatosPost();

                if ($this->Facultad_model->editar($this->facultad_id, $this->facultad_datos)) {
                    $this->session->set_flashdata('msg', 'Se modifico correctamente el registro');
                    redirect('facultad');
                } else {
                    $this->session->set_flashdata('msg', 'Hubo un error modificando el registro');
                    redirect('facultad/editar/' . $id);
                }
            }
        }
        if (!$id) {
            $this->session->set_flashdata('msg', 'No especifico la facultad a editar!');
            redirect('facultad');
        } else {
            if ($this->datos_view['query']) { // Tenemos una facultad valida // Pasamos los parametros a la vista, comodidad ante todo :)
                $this->mostrarVista('facultad/formulario', $this->datos_view);
            } else {
                $this->session->set_flashdata('msg', 'La facultad a editar no es valida, intente nuevamente');
                redirect('facultad');
            }
        }
    }

}
