<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Categoria extends CI_Controller {

    var $categoria_datos =  array();
    var $categoria_id = array ();
    var $categoria_titulo ='';
    var $categoria_acction = '';
    var $categoria_getcategoria = null;
    var $categoria_facultades = array ();
    var $categoria_todascategorias = array ();
    var $categoria_agregar_modificar= '';
    
    
    public function setCategoria_titulo($categoria_titulo) {
        $this->categoria_titulo = $categoria_titulo;
    }

    public function setCategoria_acction($categoria_acction) {
        $this->categoria_acction = $categoria_acction;
    }

    public function setCategoria_getcategoria($categoria_getcategoria) {
        $this->categoria_getcategoria = $categoria_getcategoria;
    }

    public function setCategoria_facultades($categoria_facultades) {
        $this->categoria_facultades = $categoria_facultades;
    }

    public function setCategoria_todascategorias($categoria_todascategorias) {
        $this->categoria_todascategorias = $categoria_todascategorias;
    }

    public function setCategoria_agregar_modificar($categoria_agregar_modificar) {
        $this->categoria_agregar_modificar = $categoria_agregar_modificar;
    }

    
    public function __construct() {
        parent::__construct();
        $this->load->model('Categoria_model');
        $this->load->model('Facultad_model');
          if (!$this->ion_auth->is_admin()) {
            redirect('account/login');
        }
    }

    public function mostrarVista($vista) {
        $info_view = array (
            'title'=> $this->categoria_titulo,
            'action'=>  $this->categoria_acction,
            'agregar_modificar'=> $this->categoria_agregar_modificar,
            'categorias'=>$this->categoria_todascategorias,
            'query'=> $this->categoria_getcategoria,
            'facultades'=> $this->categoria_facultades,
            'msg' => $this->session->flashdata('msg')
        );
        $this->load->view('template/head', $info_view);
        $this->load->view($vista, $info_view);
        $this->load->view('template/footer');
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
        
        $this->setCategoria_titulo('Indice | Categoria');
        $this->setCategoria_todascategorias($this->ultimasCategorias());
        $this->mostrarVista('categoria/index');
    }
    

    public function agregar() {
      
        $this->setCategoria_titulo('Agregar | Categoria');
        $this->setCategoria_acction('Agregar');
        $this->setCategoria_agregar_modificar('Agregar');
        $this->setCategoria_facultades($this->todasFacultades());
        

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
        $this->setCategoria_titulo('Editar | Categoria');
        $this->setCategoria_acction('Editar/'.$id);
        $this->setCategoria_agregar_modificar('Editar');
        $this->setCategoria_facultades($this->todasFacultades());
        $this->setCategoria_getcategoria($this->Categoria_model->getCategoria($id));
        if($this->categoria_getcategoria == false){ //Ups no existe tal id
            $this->redireccionar_msg('categoria', 'La categoria a editar no es valida, intente nuevamente');
        }
        $this->mostrarVista('categoria/formulario');

    }
   public function eliminar($id) {
       
        $id = (int)$id;
        $carrera = $this->Categoria_model->getCategoria($id);
        if($carrera ){ // existe ?
            $eliminado = $this->Categoria_model->eliminar($id);
            if($eliminado == true){
                $this->redireccionar_msg('categoria', 'Fue exitosamente eliminado!');
            } else {
                $this->redireccionar_msg('categoria', ' Ooops :/ , hagalo nuevamente');
            }
        }  else {
            $this->redireccionar_msg('categoria', 'No existe esa categoria');
        }
        
    }
}
