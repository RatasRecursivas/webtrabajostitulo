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

    public function mostrarVista($vista) {
        $this->load->view('template/head', $this->datos_view);
        $this->load->view($vista, $this->datos_view);
        $this->load->view('template/footer');
    }

    private function llenarInfo($titulo, $accion, $agregar_editar, $ultimascategoria = null, $todasFacultades = null, $getCategoria = null) {
        $informacion = array(
            'title' => $titulo,
            'action' => $accion,
            'categorias' => $ultimascategoria,
            'facultades' => $todasFacultades,
            'agregar_modificar' => $agregar_editar,
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
        $this->llenarInfo('Indice', null, null, $this->ultimasCategorias());
        $this->mostrarVista('categoria/index');
    }

    public function agregar() {
        $this->llenarInfo('Agregar', 'Agregar', 'Agregar', null, $this->todasFacultades());

        if ($this->input->post()) {
            if ($this->form_validation->run('categoria/formulario')) {
                
                $this->getDatosPost(); //guardamos los datos de post en $this->categoria_datos

                $guardado = $this->Categoria_model->agregar($this->categoria_datos);

                if ($guardado) {
                    $this->redireccionar_msg('categoria', 'Categoria agregada correctamente');
                } else {
                    $this->redireccionar_msg('categoria', 'Hubo un problema agregando la categoria');
                }
            }
        }
        $this->mostrarVista('categoria/formulario');
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
        $this->llenarInfo('Editar | Categoria', 'Editar/'.$id, 'Editar',null, $this->todasFacultades(), $this->Categoria_model->getCategoria($id));
        if(!$this->datos_view['query'] ){ //Ups no existe tal id
            $this->redireccionar_msg('categoria', 'La categoria a editar no es valida, intente nuevamente');
        }
        $this->mostrarVista('categoria/formulario');

    }

}
