<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Categoria extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Categoria_model');
        $this->load->model('Facultad_model');
    }
    
    public function index(){
        $data['title'] = 'Índice';
        $data['action'] = 'Agregar';
        $data['categorias'] = $this->Categoria_model->getCategorias();
        $this->load->view('template/head',$data);
        $this->load->view('categoria/index',$data);
        $this->load->view('template/footer');
    }
    
    public function agregar(){
        $data['title'] = 'Agregar nueva Facultad';
        $data['action'] = 'Agregar';
        $data['facultades'] = $this->Facultad_model->getFacultades();

        if ($this->input->post()) {
            $facultad = array(
                'nombre_facultad' => $this->input->post('nombre_facultad', true)
            );
            if ($this->Facultad_model->agregar($facultad)) {
                $this->session->set_flashdata('msg', 'Categoria agregada correctamente');
                redirect('categoria');
            } else {
                $this->session->set_flashdata('msg', 'Hubo un problema agregando la categoria');
                redirect('categoria');
            }
        } else { // LLega por get, le muestro el formulario con los campos vacios
            $this->load->view('template/head', $data);
            $this->load->view('categoria/formulario', $data);
            $this->load->view('template/footer');
        }
    }
}