<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of carrera
 *
 * @author natalia
 */
class Carrera extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Carrera_model');
        $this->load->model('Facultad_model');
    }

    public function mostrarVista($vista,$data){
        $this->load->view('template/head', $data);
        $this->load->view('$vista', $data);
        $this->load->view('template/footer');
    }

    public function index() {
        $data['title'] = 'Carreras';
        $data['carreras'] = $this->Carrera_model->getCarreras();
        $this->mostrarVista('carrera/index', $data);
//        $this->load->view('template/head', $data);
//        $this->load->view('carrera/index', $data);
//        $this->load->view('template/footer');
    }

    public function agregar() {
        $data ['title'] = 'Agregar nueva carrera';
        $data['action'] = 'Agregar';
        $data['facultades'] = $this->Facultad_model->getFacultades();

        if ($this->input->post()) {
            $carrera = array(
                'codigo' => $this->input->post('codigo', TRUE),
                'nombre_carrera' => $this->input->post('nombre_carrera', TRUE),
                'id_facultad' => $this->input->post('facultades', TRUE),
            );
            if ($this->Carrera_model->agregar($carrera)) {
                $this->session->set_flashdata('msg', 'Se agrego correctamente la Carrera');
                redirect('carrera');
            } else {
                $this->session->set_flashdata('msg', 'No se agrego correctamente la Carrera');
                redirect('carrera');
            }
        } else {
            $this->load->view('template/head', $data);
            $this->load->view('carrera/formulario', $data);
            $this->load->view('template/footer');
        }
    }

    public function editar($id = null) {
        $data['title'] = 'Editor de carreras';
        $data['action'] = 'Editar';
        $data['facultades'] = $this->Facultad_model->getFacultades();

        if ($this->input->post()) {
            $id = $this->input->post('id', true);
            $carrera = array(
                'codigo' => $this->input->post('codigo', TRUE),
                'nombre_carrera' => $this->input->post('nombre_carrera', true),
                'id_facultad' => $this->input->post('facultades', TRUE),
            );
            if ($this->Carrera_model->editar($id, $carrera)) {
                $this->session->set_flashdata('msg', 'Se modifico correctamente el registro');
                redirect('carrera');
            } else {
                $data['values'] = $carrera;
                $this->session->set_flashdata('msg', 'ocurrio un error');
                $this->load->view('template/head', $data);
                $this->load->view('carrera/formulario', $data);
                $this->load->view('template/footer');
            }
        } else {
            if (!$id) {
                $this->session->set_flashdata('msg', 'No especifico Carrera');
                redirect('carrera');
            } else {
                $data['query'] = $this->Carrera_model->getCarrera($id);
                $data['action'] = 'Editar';
                if ($data) {
                    $this->load->view('template/head', $data);
                    $this->load->view('carrera/formulario', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('msg', 'La facultad a editar no es valida, intente nuevamente');
                    redirect('carrera');
                }
            }
        }
    }

}
