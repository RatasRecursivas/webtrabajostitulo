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

    public function index() {
        $data['title'] = 'Carreras';
        $data['carreras'] = $this->Carrera_model->getCarreras();
        $this->load->view('template/head', $data);
        $this->load->view('carrera/index', $data);
        $this->load->view('template/footer');
    }

    public function agregar() {
        $data ['title'] = 'Agregar nueva carrera';
        $data['action'] = 'Agregar';
        $data['facultades'] = $this->Facultad_model->getFacultades();

        if ($this->input->post()) {
            $carrera = array(
                'codigo' => $this->input->post('codigo', TRUE),
                'nombre_carrera' => $this->input->post('nombre_carrera', TRUE),
                'id_facultad' => $this->input->post('id_facultad', TRUE),
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

}
