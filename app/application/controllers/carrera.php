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

    var $datos_view = array();
    var $carrera_id = array();
    var $carrera_datos = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Carrera_model');
        $this->load->model('Facultad_model');
    }

    private function llenarInfo($titulo, $acction, $agregar_editar, $ultimasCarreras = null, $todasFacultades = null, $getCarrera = null) {
        $info = array(
            'title' => $titulo,
            'acction' => $acction,
            'agregar_modificar' => $agregar_editar,
            'carreras' => $ultimasCarreras,
            'facultades' => $todasFacultades,
            'query' => $getCarrera,
        );
        $this->datos_view = $info;
    }

    public function mostrarVista($vista) {
        $this->load->view('template/head', $this->datos_view);
        $this->load->view($vista, $this->datos_view);
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

        $this->llenarInfo('Indice', null, null, $this->ultimasCarreras());
        $this->mostrarVista('carrera/index');
//        $this->load->view('template/head', $data);
//        $this->load->view('carrera/index', $data);
//        $this->load->view('template/footer');
    }

    public function agregar() {
//        $data['title'] = 'Agregar nueva carrera';
//        $data['action'] = 'Agregar';
//        $data['facultades'] = $this->Facultad_model->getFacultades();
        $this->llenarInfo('Agregar Carrera', 'Agregar', 'Guardar', null, $this->todasFacultades());

        if ($this->input->post()) {
//            $carrera = array(
//                'codigo' => $this->input->post('codigo', TRUE),
//                'nombre_carrera' => $this->input->post('nombre_carrera', TRUE),
//                'id_facultad' => $this->input->post('facultades', TRUE),
//            );
            if ($this->form_validation->run('carrera/formulario')) {
//                echo 'holaaa';
                $this->getDatosPost();
                $guardado = $this->Carrera_model->agregar($this->carrera_datos);

                if ($guardado == true) {
                    $this->redireccionar_msg('carrera', 'Se agrego correctamente la Carrera');
//                $this->session->set_flashdata('msg', 'Se agrego correctamente la Carrera');
//                redirect('carrera');
                } else {
//                $this->session->set_flashdata('msg', 'No se agrego correctamente la Carrera');
//                redirect('carrera');
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
        $this->llenarInfo('Editar Carrera', 'Editar/'.$id, 'Editar',null,  $this->todasFacultades(),  $this->Carrera_model->getCarrera($id));
        if (!$this->datos_view['query']) { //Ups no existe ese ID 
            $this->redireccionar_msg('carrera', 'La carrera a editar no es valida, intente nuevamente');
        } 
        $this->mostrarVista('carrera/formulario');
//        $data['title'] = 'Editor de carreras';
//        $data['action'] = 'Editar';
//        $data['facultades'] = $this->Facultad_model->getFacultades();
//
//        if ($this->input->post()) {
//            $id = $this->input->post('id', true);
//            $carrera = array(
//                'codigo' => $this->input->post('codigo', TRUE),
//                'nombre_carrera' => $this->input->post('nombre_carrera', true),
//                'id_facultad' => $this->input->post('facultades', TRUE),
//            );
//            if ($this->Carrera_model->editar($id, $carrera)) {
//                $this->session->set_flashdata('msg', 'Se modifico correctamente el registro');
//                redirect('carrera');
//            } else {
//                $data['values'] = $carrera;
//                $this->session->set_flashdata('msg', 'ocurrio un error');
//                $this->load->view('template/head', $data);
//                $this->load->view('carrera/formulario', $data);
//                $this->load->view('template/footer');
//            }
//        } else {
//            if (!$id) {
//                $this->session->set_flashdata('msg', 'No especifico Carrera');
//                redirect('carrera');
//            } else {
//                $data['query'] = $this->Carrera_model->getCarrera($id);
//                $data['action'] = 'Editar';
//                if ($data) {
//                    $this->load->view('template/head', $data);
//                    $this->load->view('carrera/formulario', $data);
//                    $this->load->view('template/footer');
//                } else {
//                    $this->session->set_flashdata('msg', 'La facultad a editar no es valida, intente nuevamente');
//                    redirect('carrera');
//                }
//            }
//        }
    }

}
