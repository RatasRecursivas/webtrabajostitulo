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
 * Description of tesis
 *
 * @author pperez
 */
class Tesis extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Tesis_model');
        $this->load->model('Profesor_model');
    }

    public function index() {
        $data['title'] = 'Índice';
        $data['query'] = $this->Tesis_model->getTodas();
        $data['defensas'] = $this->Tesis_model->getProximasDefensas();
        $this->load->view('template/head', $data);
        $this->load->view('tesis/index', $data);
        $this->load->view('template/footer');
    }

    public function ver($id = NULL) {
        if ($id) {
            $tesis = $this->Tesis_model->getTesis($id);
            $data['tesis'] = $tesis;
            $data['title'] = $tesis->titulo;

            $this->load->view('template/head', $data);
            $this->load->view('tesis/ver', $data);
            $this->load->view('template/footer');
        }
    }

    //public function prueba() {
    // $query= $this->Profesor_model->getProfesores();
    //echo var_dump($query);





    public function editar($id = null) {
        $data['title'] = 'Editar Tesis';
        $data['action'] = 'Editar';
        $data['tesis'] = $this->Tesis_model->getTodas();

        if ($this->input->post()) {
            $id = $this->input->post('id', true);
            $tesis = array(
                'titulo' => $this->input->post('titulo', TRUE),
                'estudiante_rut' => $this->input->post('rut', true),
                'abstract' => $this->input->post('abstract', TRUE),
                'fecha_publicacion' => $this->input->post('fecha_publicacion', true),
                'fecha_evaluacion' => $this->input->post('fecha_evaluacion', true),
                'feha_disponibilidad' => $this->input->post('fecha_disponibilidad', true),
                'profesor_guia_rut' => $this->input->post('profesor_date',true),
            );
            var_dump($tesis);
            if ($this->Tesis_model->editar($id, $tesis)) {
                $this->session->set_flashdata('msg', 'Se modifico correctamente el registro');
                redirect('tesis');
            } else {
                $data['values'] = $tesis;
                $this->session->set_flashdata('msg', 'ocurrio un error');
                $this->load->view('template/head', $data);
                $this->load->view('tesis/formulario', $data);
                $this->load->view('template/footer');
            }
        } else {
            if (!$id) {
                $this->session->set_flashdata('msg', 'No especificado');
                redirect('tesis');
            } else {
                $data['query'] = $this->Tesis_model->getTesis($id);
                $data['profesores'] = $this->Profesor_model->getProfesores();

                $data['action'] = 'Editar';
                if ($data) {
                    $this->load->view('template/head', $data);
                    $this->load->view('tesis/formulario', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('msg', 'La tesis a editar no es valida');
                    redirect('tesis');
                }
            }
        }
    }
    public function agregar() {
        $data ['title'] = 'Agregar nueva Tesis';
        $data['action'] = 'Agregar';

        $data['profesores'] = $this->Profesor_model->getProfesores();

        if ($this->input->post()) {
            $tesis = array(
                'titulo' => $this->input->post('titulo', TRUE),
                'estudiante_rut' => $this->input->post('rut', true),
                'abstract' => $this->input->post('abstract', TRUE),
                'fecha_publicacion' => $this->input->post('fecha_publicacion', true),
                'fecha_evaluacion' => $this->input->post('fecha_evaluacion', true),
                'feha_disponibilidad' => $this->input->post('fecha_disponibilidad', true),
                'profesor_guia_rut' => $this->input->post('profesor_date',true), 
            );
            if ($this->Tesis_model->agregar($tesis)) {
                $this->session->set_flashdata('msg', 'Se agrego correctamente');
                redirect('tesis');
            } else {
                $this->session->set_flashdata('msg', 'No se agrego correctamente');
                redirect('tesis');
            }
        } else {
            $this->load->view('template/head', $data);
            $this->load->view('tesis/formulario', $data);
            $this->load->view('template/footer');
        }
    }
    
    

}
