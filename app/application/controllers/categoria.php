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
            $categoria = array(
                'nombre_categoria' => $this->input->post('nombre_categoria', true),
                'id_facultad' => $this->input->post('facultades',true)
            );
            if ($this->Categoria_model->agregar($categoria)) {
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
    
    public function editar($id = NULL) {
        $data['title'] = 'Edición de Categoria';
        
        if ($this->input->post()) { // Llega por post
            $id = $this->input->post('id', true); // El id es recibido mediante un campo oculto en el form
            $categoria = array(
                'nombre_categoria' => $this->input->post('nombre_categoria', true),
                'id_facultad' => $this->input->post('facultades',true)
            );
            if ($this->Categoria_model->editar($id, $categoria)) {
                $this->session->set_flashdata('msg', 'Se modifico correctamente el registro');
                redirect('categoria');
            } else {
                $data['values'] = $facultad;
                $this->session->set_flashdata('msg', 'Hubo un error modificando el registro');
                $this->load->view('template/head', $data);
                $this->load->view('categoria/formulario', $data);
                $this->load->view('template/footer');
            }
        } else { // Llegamos por get solamente, nos llega un id
            if (!$id) {
                $this->session->set_flashdata('msg', 'No especifico la facultad a editar!');
                redirect('categoria');
            } else {
                $data['query'] = $this->Categoria_model->getCategoria($id);
                $data['facultades'] = $this->Facultad_model->getFacultades($id);
                $data['action'] = 'Editar';

                if ($data) { // Tenemos una facultad valida // Pasamos los parametros a la vista, comodidad ante todo :)
                    $this->load->view('template/head', $data);
                    $this->load->view('categoria/formulario', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('msg', 'La facultad a editar no es valida, intente nuevamente');
                    redirect('facultad');
                }
            }
        }
        
    }
}