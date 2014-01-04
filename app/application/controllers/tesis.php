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
    
    var $datos_view = array();
    var $tesis_id = array();
    var $tesis_datos = array();
    var $tesis_titulo = '';
    var $tesis_acction = '';
    var $tesis_profesores = array();
    var $tesis_getTesis = array();
    var $tesis_todasTesis = array();
    var $tesis_proximasTesis = array();
    
    function __construct() {
        parent::__construct();
        $this->load->model('Tesis_model');
        $this->load->model('Profesor_model');
    }

    private function mostrar_vista($vista) {
        $this->load->view('template/head', $this->datos_view);
        $this->load->view($vista, $this->datos_view);
        $this->load->view('template/footer');
    }
    
    public function redireccionar_msg($link,$mensaje) {
        $this->session->set_flashdata('msg',$mensaje);
        redirect($link);
    }
    public function llenarInfo($title,$acction,$agregar_modificar,$todasLastesis = null,$getProximasDefensas = null, $tesis){
        $info_view = array(
            'title' => $title,
            'query' => $todasLastesis,
            'defensas' => $getProximasDefensas,
            'tesis' => $tesis,
        );
        $this->datos_view = $info_view;
    }

    public function index() {
//        $data['title'] = 'Índice';
//        $data['query'] = $this->Tesis_model->getTodas();
//        $data['defensas'] = $this->Tesis_model->getProximasDefensas();
        $this->llenarInfo('Indice', null, null,  $this->Tesis_model->getTodas(),  $this->Tesis_model->getProximasDefensas(),null);
//        $this->load->view('template/head', $data);
//        $this->load->view('tesis/index', $data);
//        $this->load->view('template/footer');
        $this->mostrar_vista('tesis/index');
    }

    public function ver($id = NULL) {
        $id = (int)$id;
        if (!$id) {
            $this->redireccionar_msg('tesis','No especifico la tesis a mostrar!');
        }
        $tesis = $this->Tesis_model->getTesis($id);
        if($tesis){
            $this->llenarInfo($tesis->titulo, null, null, null, null,$tesis);
            $this->mostrar_vista('tesis/ver');
        }  else {
            $this->redireccionar_msg('tesis', 'Tesis no encontrada');
        }
        
    }

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
                'profesor_guia_rut' => $this->input->post('profesor_date', true),
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
                'profesor_guia_rut' => $this->input->post('profesor_date', true),
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
