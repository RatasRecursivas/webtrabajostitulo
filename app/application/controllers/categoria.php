<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Categoria extends CI_Controller {

    var $datos_view = array();
    var $categoria_datos = '';
    var $categoria_id = '';

    public function __construct() {
        parent::__construct();
        $this->load->model('Categoria_model');
        $this->load->model('Facultad_model');
    }

    public function mostrarVista($vista, $data) {
        $this->load->view('template/head', $data);
        $this->load->view($vista, $data);
        $this->load->view('template/footer');
    }

    private function llenarInfo($titulo, $accion, $agregar_editar, $ultimascategoria = null, $todasFacultades = null, $getCategoria = null) {
        $informacion = array(
            'title' => $titulo,
            'action' => $accion,
            'categorias' => $ultimascategoria,
            'facultades' => $todasFacultades,
            'query' => $getCategoria,
        );
        $this->datos_view = $informacion;
    }

    private function getIdPost() {
        $id = $this->input->post('id', true);
        $this->categoria_id = $id;
    }

    private function ultimasCategorias() {
        return $this->Categoria_model->getCategorias();
    }

    private function todasFacultades() {
        return $this->Facultad_model->getFacultades();
    }

    private function getDatosPost() {
        $categoria = array(
            'nombre_categoria' => $this->input->post('nombre_categoria', true),
            'id_facultad' => $this->input->post('facultades', true),
        );
        $this->categoria_datos = $categoria;
    }

    public function redireccionar_msg($link, $mensaje) {
        $this->session->set_flashdata('msg', $mensaje);
        redirect($link);
    }

    public function index() {
//        $data['title'] = 'Índice';
//        $data['action'] = 'Agregar';
        $this->datos_view = $this->llenarInfo('Indice', 'Agregar', 'Agregar', $this->ultimasCategorias());
//        $data['categorias'] = $this->Categoria_model->getCategorias();
        $this->mostrarVista('categoria', $this->datos_view);
    }

    public function agregar() {
//        $data['title'] = 'Agregar nueva Facultad';
//        $data['action'] = 'Agregar';
//        $data['facultades'] = $this->Facultad_model->getFacultades();
        $this->llenarInfo('Agregar', 'Agregar', 'Agregar', null, $this->todasFacultades());

        if ($this->input->post()) {
            if ($this->form_validation->run('categoria/formulario')) {
                
                $this->getDatosPost(); //guardamos los datos de post en $this->categoria_datos

                $guardado = $this->Categoria_model->agregar($this->categoria_datos);

                if ($guardado) {
//                $this->session->set_flashdata('msg', 'Categoria agregada correctamente');
//                redirect('categoria');
                    $this->redireccionar_msg('categoria', 'Categoria agregada correctamente');
                } else {
                    $this->redireccionar_msg('categoria', 'Hubo un problema agregando la categoria');
//                $this->session->set_flashdata('msg', 'Hubo un problema agregando la categoria');
//                redirect('categoria');
                }
            }
        } //            $this->load->view('template/head', $data);
//            $this->load->view('categoria/formulario', $data);
//            $this->load->view('template/footer');
        $this->mostrarVista('categoria/formulario', $this->datos_view);
    }

    public function editar($id = NULL) {
        $id = (int) $id;
        if (!$id) {
            $this->redireccionar_msg('categoria', 'No especifico la categoria a editar!');
        }

        if ($this->input->post()) {
            if ($this->form_validation->run('categoria/formulario')) {

                $this->getIdPost();
                $this->getDatosPost();

                $editado = $this->Categoria_model->editar($this->categoria_id, $this->categoria_datos);
                
                if($editado == true){
                    $this->redireccionar_msg('categoria', 'Se modifico correctamente el registro');
                }  else {
                    $this->redireccionar_msg('categoria', 'Hubo un error modificando el registro');
                }
            }
        }
        $this->llenarInfo('Editar', 'Editar/'.$id, 'Editar',null,  $this->Categoria_model->getCategoria($id));
        
        if(!$this->categoria_datos['query']){ //Ups no existe tal id
            $this->redireccionar_msg('categoria', 'La categoria a editar no es valida, intente nuevamente');
        }
        $this->mostrarVista('categoria/formulario', $this->datos_view);

//        $data['title'] = 'Edición de Categoria';
//        if ($this->input->post()) { // Llega por post
//            $id = $this->input->post('id', true); // El id es recibido mediante un campo oculto en el form
//            $categoria = array(
//                'nombre_categoria' => $this->input->post('nombre_categoria', true),
//                'id_facultad' => $this->input->post('facultades', true)
//            );
//            if ($this->Categoria_model->editar($id, $categoria)) {
//                $this->session->set_flashdata('msg', 'Se modifico correctamente el registro');
//                redirect('categoria');
//            } else {
//                $data['values'] = $facultad;
//                $this->session->set_flashdata('msg', 'Hubo un error modificando el registro');
//                $this->load->view('template/head', $data);
//                $this->load->view('categoria/formulario', $data);
//                $this->load->view('template/footer');
//            }
//        } else { // Llegamos por get solamente, nos llega un id
//            if (!$id) {
//                $this->session->set_flashdata('msg', 'No especifico la facultad a editar!');
//                redirect('categoria');
//            } else {
//                $data['query'] = $this->Categoria_model->getCategoria($id);
//                $data['facultades'] = $this->Facultad_model->getFacultades($id);
//                $data['action'] = 'Editar';
//
//                if ($data) { // Tenemos una facultad valida // Pasamos los parametros a la vista, comodidad ante todo :)
//                    $this->load->view('template/head', $data);
//                    $this->load->view('categoria/formulario', $data);
//                    $this->load->view('template/footer');
//                } else {
//                    $this->session->set_flashdata('msg', 'La facultad a editar no es valida, intente nuevamente');
//                    redirect('facultad');
//                }
//            }
//        }
    }

}
