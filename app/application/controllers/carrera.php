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

    var $carrera_id = array();
    var $carrera_datos = array();
    var $carrera_titulo = '';
    var $carrera_acction = '';
    var $carrera_getCarrera = null;
    var $carrera_falcultades = array();
    var $carrera_todasCarreras = array();
    var $carrera_agregar_modificar = '';

    public function setCarrera_titulo($carrera_titulo) {
        $this->carrera_titulo = $carrera_titulo;
    }

    public function setCarrera_acction($carrera_acction) {
        $this->carrera_acction = $carrera_acction;
    }

    public function setCarrera_getCarrera($carrera_getCarrera) {
        $this->carrera_getCarrera = $carrera_getCarrera;
    }

    public function setCarrera_falcultades($carrera_falcultades) {
        $this->carrera_falcultades = $carrera_falcultades;
    }

    public function setCarrera_todasCarreras($carrera_todasCarreras) {
        $this->carrera_todasCarreras = $carrera_todasCarreras;
    }

    public function setCarrera_agregar_modificar($carrera_agregar_modificar) {
        $this->carrera_agregar_modificar = $carrera_agregar_modificar;
    }

        function __construct() {
        parent::__construct();
        $this->load->model('Carrera_model');
        $this->load->model('Facultad_model');
    }

    public function mostrarVista($vista) {
        $info_view = array(
            'title' => $this->carrera_titulo,
            'acction' => $this->carrera_acction,
            'agregar_modificar' => $this->carrera_agregar_modificar,
            'carreras' => $this->carrera_todasCarreras,
            'query' => $this->carrera_getCarrera,
            'facultades' => $this->carrera_falcultades,
        );
        $this->load->view('template/head', $info_view);
        $this->load->view($vista, $info_view);
        $this->load->view('template/footer');
    }

    private function ultimasCarreras() {
        return $this->Carrera_model->getCarreras();
    }

    private function todasFacultades() {
        return $this->Facultad_model->getFacultades();
    }

    private function getDatosPost() {
        $carrera = array(
            'codigo' => $this->input->post('codigo', TRUE),
            'nombre_carrera' => $this->input->post('nombre_carrera', TRUE),
            'id_facultad' => $this->input->post('facultades', TRUE),
        );
        $this->carrera_datos = $carrera;
    }

    public function getIdPost() {
        $id = $this->input->post('id', true);
        $this->carrera_id = $id;
    }

    public function redireccionar_msg($link, $mensaje) {
        $this->session->set_flashdata('msg', $mensaje);
        redirect($link);
    }

    public function index() {
        $this->setCarrera_titulo('Indice | Carrera');
        $this->setCarrera_todasCarreras($this->ultimasCarreras());
        $this->mostrarVista('carrera/index');
    }

    public function agregar() {
        $this->setCarrera_titulo('Agregar | Carrera');
        $this->setCarrera_acction('Agregar');
        $this->setCarrera_agregar_modificar('Agregar');
        $this->setCarrera_falcultades($this->todasFacultades());

        if ($this->input->post()) {
            if ($this->form_validation->run('carrera/formulario')) {
//                echo 'holaaa';
                $this->getDatosPost();
                $guardado = $this->Carrera_model->agregar($this->carrera_datos);

                if ($guardado == true) {
                    $this->redireccionar_msg('carrera', 'Se agrego correctamente la Carrera');
                } else {
                    $this->redireccionar_msg('carrera', 'No se agrego correctamente la Carrera');
                }
            }
        }
        $this->mostrarVista('carrera/formulario');
    }

    public function editar($id = null) {
        $id = (int) $id;
        if (!$id) {
            $this->redireccionar_msg('facultad', 'No especifico la facultad a editar!');
        }
        if ($this->input->post()) {
            if ($this->form_validation->run('carrera/formualrio')) {

                $this->getIdPost();
                $this->getDatosPost();
                
                $editado = $this->Carrera_model->editar($this->carrera_id,  $this->carrera_datos);
                if($editado == true){
                    $this->redireccionar_msg('carrera', 'Se modifico correctamente el registro');
                }  else {
                    $this->redireccionar_msg('carrera', 'Hubo un error modificando el registro');
                }
            }
        }
        $this->setCarrera_titulo('Editar | Carrera');
        $this->setCarrera_acction('editar/'.$id);
        $this->setCarrera_falcultades($this->todasFacultades());
        $this->setCarrera_getCarrera($this->Carrera_model->getCarrera($id));
        $this->setCarrera_agregar_modificar('Editar');
       
        
        if ($this->carrera_getCarrera == FALSE) { //Ups no existe ese ID 
            $this->redireccionar_msg('carrera', 'La carrera a editar no es valida, intente nuevamente');
        } 
        $this->mostrarVista('carrera/formulario');
    }

}
