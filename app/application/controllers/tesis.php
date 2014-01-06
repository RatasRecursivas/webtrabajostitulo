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

    var $tesis_id_post = array();
    var $tesis_datos_post = array();
    var $tesis_titulo = '';
    var $tesis_acction = '';
    var $tesis_agregar_modificar = '';
    var $tesis_profesores = array();
    var $tesis_getTesis = null;
    var $tesis_todasTesis = null;
    var $tesis_proximasTesis = array();
    var $tesis_categorias = array();
    var $tesis_mensajeFichero = '';

    function __construct() {
        parent::__construct();
        $this->load->model('Tesis_model');
        $this->load->model('Profesor_model');
        $this->load->model('Categoria_model');
        $this->load->helper('utilities');
    }

    public function setTesis_titulo($tesis_titulo) {
        $this->tesis_titulo = $tesis_titulo;
    }

    public function setTesis_mensajeFicher($tesis_mensajefichero) {
        $this->tesis_mensajeFichero = $tesis_mensajefichero;
    }

    public function setTesis_agregar_modificar($agregar_modificar) {
        $this->tesis_agregar_modificar = $agregar_modificar;
    }

    public function setTesis_acction($tesis_acction) {
        $this->tesis_acction = $tesis_acction;
    }

    public function setTesis_profesores($tesis_profesores) {
        $this->tesis_profesores = $tesis_profesores;
    }

    public function setTesis_categorias($tesis_categorias) {
        $this->tesis_categorias = $tesis_categorias;
    }

    public function setTesis_getTesis($tesis_getTesis) {
        $this->tesis_getTesis = $tesis_getTesis;
    }

    public function setTesis_todasTesis($tesis_todasTesis) {
        $this->tesis_todasTesis = $tesis_todasTesis;
    }

    public function setTesis_proximasTesis($tesis_proximasTesis) {
        $this->tesis_proximasTesis = $tesis_proximasTesis;
    }

    private function mostrar_vista($vista) {
        $datos_enviar = array(
            'title' => $this->tesis_titulo,
            'query' => $this->tesis_todasTesis,
            'defensas' => $this->tesis_proximasTesis,
            'profesores' => $this->tesis_profesores,
            'action' => $this->tesis_acction,
            'tesis' => $this->tesis_getTesis,
            'agregar_modificar' => $this->tesis_agregar_modificar,
            'categorias' => $this->tesis_categorias,
        );
        $this->load->view('template/head', $datos_enviar);
        $this->load->view($vista, $datos_enviar);
        $this->load->view('template/footer');
    }

    public function redireccionar_msg($link, $mensaje) {
        $this->session->set_flashdata('msg', $mensaje);
        redirect($link);
    }

    private function getDatosPost() {
        
        $config['upload_path'] = './archivos_tesis/';
        $config['allowed_types'] = 'zip|pdf';
        $config['max_size'] = '2048';
        
        
        $this->load->library('upload', $config);
        $fichero_ubicacion = '';

        if ($this->upload->do_upload()) {
            $fichero_ubicacion = $this->upload->data();
            $fichero_ubicacion = $fichero_ubicacion['full_path'];
        } else {
            $this->redireccionar_msg('tesis', 'Se le olvido adjuntar el fichero o no lo hemos recibido');
        }
        
        $rut_format = esRut($this->input->post('rut',TRUE));
        $rut_format = str_replace('.', '', $rut_format); // replazamos los puntos
        $rut_format = substr($rut_format, 0,-2); //cortamos el digito verificador y el '-' 
        
        if($this->input->post('fecha_evaluacion',true) == false || $this->input->post('hora_evaluacion',true) == false)
        {
            $fecha_evaluacion = null;
        } else {
            $fecha_evaluacion = $this->input->post('fecha_evaluacion', true).' '.$this->input->post('hora_evaluacion',true);
        }
        
        $tesis = array(
            'titulo' => $this->input->post('titulo', TRUE),
            'estudiante_rut' => $rut_format,
            'abstract' => $this->input->post('abstract', TRUE),
            'fecha_publicacion' => $this->input->post('fecha_publicacion', true),
            'fecha_evaluacion' => $fecha_evaluacion,
            'feha_disponibilidad' => $this->input->post('fecha_disponibilidad', true),
            'profesor_guia_rut' => $this->input->post('profesor_date', true),
            'ubicacion_fichero' => $fichero_ubicacion,
            'id_categoria' => $this->input->post('categoria_id', true),
        );
        //var_dump($tesis);
        $this->tesis_datos_post = $tesis;
    }

    private function getIdPost() {
        $id = $this->input->post('id', true);
        $this->tesis_id_post = $id;
    }

    public function index() {

        $this->setTesis_titulo('Indice | Tesis');
        $this->setTesis_todasTesis($this->Tesis_model->getTodas());
        $this->setTesis_proximasTesis($this->Tesis_model->getProximasDefensas());

        $this->mostrar_vista('tesis/index');
    }

    public function ver($id = NULL) {
        $id = (int) $id;
        if (!$id) {
            $this->redireccionar_msg('tesis', 'No especifico la tesis a mostrar!');
        }
        $this->setTesis_getTesis($this->Tesis_model->getTesis($id));
        if ($this->tesis_getTesis) { //existe tesis
            $this->setTesis_titulo($this->tesis_getTesis->titulo);
            $this->mostrar_vista('tesis/ver');
        } else {
            $this->redireccionar_msg('tesis', 'Tesis no encontrada');
        }
    }

    public function editar($id = null) {
        $id = (int) $id;
        if (!$id) {
            $this->redireccionar_msg('tesis', 'Tesis no valida para editar');
        }
        if ($this->input->post()) {
            if ($this->form_validation->run('tesis/formulario')) {
                $this->getDatosPost();
                $this->getIdPost();

                $editado = $this->Tesis_model->editar($this->tesis_id_post, $this->tesis_datos_post);
                if ($editado == true) {
                    $this->redireccionar_msg('tesis', 'Exito al editar');
                } else {
                    $this->redireccionar_msg('tesis', 'Vuelva a procesar la peticion');
                }
            }
        }
        $this->setTesis_titulo('Editar | Tesis');
        $this->setTesis_profesores($this->Profesor_model->getProfesores());
        $this->setTesis_categorias($this->Categoria_model->getCategorias());
        $this->setTesis_getTesis($this->Tesis_model->getTesis($id));
        $this->setTesis_acction('Editar/' . $id);
        $this->setTesis_agregar_modificar('Editar');

        if ($this->tesis_getTesis) { //existe tesis
            $this->mostrar_vista('tesis/formulario');
        } else {
            $this->redireccionar_msg('tesis', 'Tesis no encontrada');
        }
    }

    public function agregar() {
        $this->setTesis_titulo('Agregar | Tesis');
        $this->setTesis_agregar_modificar('Agregar');
        $this->setTesis_acction('Agregar');
        $this->setTesis_profesores($this->Profesor_model->getProfesores());
        $this->setTesis_categorias($this->Categoria_model->getCategorias());
        if ($this->input->post()) {
            if ($this->form_validation->run('tesis/formulario')) {
                $this->getDatosPost();

                $guardado = $this->Tesis_model->agregar($this->tesis_datos_post);
                if ($guardado == true) {
                    $this->redireccionar_msg('tesis', 'Se agrego una nueva tesis');
                } else {
                    $this->redireccionar_msg('tesis', 'Vuelva a intentarlo :(');
                }
            }
        }
        $this->mostrar_vista('tesis/formulario');
    }

}
