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

    function __construct() {
        parent::__construct();
        $this->load->model('Facultad_model');
    }

    public function index() {
        $data['title'] = 'Índice';
        $data['facultades'] = $this->Facultad_model->getFacultades();
        $this->load->view('template/head', $data);
        $this->load->view('facultad/index', $data);
        $this->load->view('template/footer');
    }
    
    public function agregar() {
        $data['title'] = 'Agregar nueva Facultad';
        $data['action'] = 'Agregar';
        
        if($this->input->post())
        {
            $facultad = array(
                'nombre_facultad' => $this->input->post('nombre_facultad', true)
            );
            if($this->Facultad_model->agregar($facultad))
            {
                $this->session->set_flashdata('msg', 'Facultad agregada correctamente');
                redirect('facultad');
            }
            else
            {
                $this->session->set_flashdata('msg', 'Hubo un problema agregando la facultad');
                redirect('facultad');
            }
        }
        else // LLega por get, le muestro el formulario con los campos vacios
        {
            $this->load->view('template/head', $data);
            $this->load->view('facultad/formulario', $data);
            $this->load->view('template/footer');
        }
    }

    public function editar($id = NULL) {
        $data['title'] = 'Edición de Facultad';

        if ($this->input->post()) { // Llega por post
            $id = $this->input->post('id', true); // El id es recibido mediante un campo oculto en el form
            $facultad = array(// Agrego los valores al array e intento editar en db
                'nombre_facultad' => $this->input->post('nombre_facultad', true)
            );
            if ($this->Facultad_model->editar($id, $facultad)) {
                $this->session->set_flashdata('msg', 'Se modifico correctamente el registro');
                redirect('facultad');
            } else {
                $data['values'] = $facultad;
                $this->session->set_flashdata('msg', 'Hubo un error modificando el registro');
                $this->load->view('template/head', $data);
                $this->load->view('facultad/formulario', $data);
                $this->load->view('template/footer');
            }
        } else { // Llegamos por get solamente, nos llega un id
            if (!$id) {
                $this->session->set_flashdata('msg', 'No especifico la facultad a editar!');
                redirect('facultad');
            } else {
                $data['query'] = $this->Facultad_model->getFacultad($id);
                $data['action'] = 'Editar';

                if ($data) { // Tenemos una facultad valida // Pasamos los parametros a la vista, comodidad ante todo :)
                    $this->load->view('template/head', $data);
                    $this->load->view('facultad/formulario', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('msg', 'La facultad a editar no es valida, intente nuevamente');
                    redirect('facultad');
                }
            }
        }
    }
    
    
}
