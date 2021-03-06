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
    var $tesis_carreras = array();
    var $tesis_facultades = array();
    var $tesis_fichero_ubicacion = null;
    var $validation = array();
    var $admin;

    function __construct() {
        parent::__construct();
        $this->load->model('Tesis_model');
        $this->load->model('Profesor_model');
        $this->load->model('Facultad_model');
        $this->load->model('Carrera_model');
        $this->load->model('Categoria_model');
        $this->load->helper('utilities');
        $this->admin = ($this->ion_auth->is_admin()) ? true : false;
    }

    public function setTesis_fichero_ubicacion($tesis_fichero_ubicacion) {
        $this->tesis_fichero_ubicacion = $tesis_fichero_ubicacion;
    }

    public function setTesis_titulo($tesis_titulo) {
        $this->tesis_titulo = $tesis_titulo;
    }

    public function setTesis_agregar_modificar($agregar_modificar) {
        $this->tesis_agregar_modificar = $agregar_modificar;
    }

    public function setTesis_carreras($tesis_carreras) {
        $this->tesis_carreras = $tesis_carreras;
    }

    public function setTesis_facultades($tesis_facultades) {
        $this->tesis_facultades = $tesis_facultades;
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
        $datosGet = array();
        if ($this->input->get('categoria')) {
            $datosGet['categoria_default'] = $this->input->get('categoria');
        } else {
            $datosGet['categoria_default'] = null;
        }
        if ($this->input->get('facultad')) {
            $datosGet['facultad_default'] = $this->input->get('facultad');
        } else {
            $datosGet['facultad_default'] = null;
        }
        if ($this->input->get('carrera')) {
            $datosGet['carrera_default'] = $this->input->get('carrera');
        } else {
            $datosGet['carrera_default'] = null;
        }
        if ($this->input->get('profesor')) {
            $datosGet['profesor_default'] = $this->input->get('profesor');
        } else {
            $datosGet['profesor_default'] = null;
        }

        $datos_enviar = array(
            'title' => $this->tesis_titulo,
            'query' => $this->tesis_todasTesis,
            'defensas' => $this->tesis_proximasTesis,
            'profesores' => $this->tesis_profesores,
            'action' => $this->tesis_acction,
            'tesis' => $this->tesis_getTesis,
            'agregar_modificar' => $this->tesis_agregar_modificar,
            'categorias' => $this->tesis_categorias,
            'carreras' => $this->tesis_carreras,
            'facultades' => $this->tesis_carreras,
            'msg' => $this->session->flashdata('msg'),
            'filtro_default' => $datosGet,
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
        $config['allowed_types'] = 'zip|pdf|doc|docx';
        $config['max_size'] = '30000'; // 30 MB

        $this->load->library('upload', $config);

        $fechapublicacion = strtotime($this->input->post('fecha_publicacion_putrido', true));

        if ($this->upload->do_upload()) {

            $fichero_ubicacion = $this->upload->data();
            $fichero_ubicacion = $fichero_ubicacion['file_name'];
        } else {
            $fichero_ubicacion = null;
        }

        $this->setTesis_fichero_ubicacion($fichero_ubicacion);

        $rut_format = esRut($this->input->post('rut', TRUE));
        $rut_format = str_replace('.', '', $rut_format); // replazamos los puntos
        $rut_format = substr($rut_format, 0, -2); //cortamos el digito verificador y el '-' 

        if ($this->input->post('fecha_evaluacion_putrido', true) == false || $this->input->post('hora_evaluacion', true) == false) {
            $fecha_evaluacion = null;
        } else {
            $fecha_evaluacion = $this->input->post('fecha_evaluacion_putrido', true) . ' ' . $this->input->post('hora_evaluacion', true);
        }

        $fecha_publicacion = ($this->input->post('fecha_publicacion_putrido', true)) ? $this->input->post('fecha_publicacion_putrido', true) : null;
        $fecha_disponibilidad = ($this->input->post('fecha_disponibilidad_putrido', true)) ? $this->input->post('fecha_disponibilidad_putrido', true) : null;

        $tesis = array(
            'titulo' => $this->input->post('titulo', TRUE),
            'estudiante_rut' => $rut_format,
            'abstract' => $this->input->post('abstract', TRUE),
            'fecha_publicacion' => $fecha_publicacion,
            'fecha_evaluacion' => $fecha_evaluacion,
            'feha_disponibilidad' => $fecha_disponibilidad,
            'profesor_guia_rut' => $this->input->post('profesor_date', true),
            'ubicacion_fichero' => $fichero_ubicacion,
            'id_categoria' => $this->input->post('categoria_id', true),
            'ruts_profesores_comision' => $this->input->post('ruts_profesores_comision', true), // Me imagino que si no selecciona profesores para la comision revisora llegara un array vacio, right? right?
        );
        $this->tesis_datos_post = $tesis;
    }

    protected function validation() {
        $this->validation = array(
            array(
                'field' => 'titulo',
                'label' => 'Titulo Tesis',
                'rules' => 'required|xss_clean|trim|max_length[200]'
            ),
            array(
                'field' => 'fecha_evaluacion_putrido',
                'label' => 'Fecha de Evaluación',
                'rules' => 'xss_clean|trim|validate_fecha_anio_mes_dia'
            ),
            array(
                'field' => 'fecha_disponibilidad_putrido',
                'label' => 'Fecha de Disponibilidad',
                'rules' => 'xss_clean|trim|validate_fecha_anio_mes_dia|compararFecha[' . $this->input->post('fecha_publicacion_putrido') . ']',
            ),
            array(
                'field' => 'rut',
                'label' => 'Rut Autor',
                'rules' => 'required|xss_clean|trim|value_rut'
            ),
            array(
                'field' => 'abstract',
                'label' => 'Abstract',
                'rules' => 'xss_clean|trim|max_length[1000]'
            ),
            array(
                'field' => 'fecha_publicacion_putrido',
                'label' => 'Fecha Publicación',
                'rules' => 'xss_clean|trim|validate_fecha_anio_mes_dia'
            ),
            array(
                'field' => 'hora_evaluacion',
                'label' => 'Hora de envaluacion',
                'rules' => 'xss_clean|trim|validate_hora_minuto_segundo'
            ),
//            array(
//                'field' => 'userfile',
//                'label' => 'Fichero',
//                'rules' => 'valide_fichero['
//                . $this->input->post('fecha_publicacion_putrido') . ']',
//            ),
            array(
                'field' => 'categoria_id',
                'label' => 'Categoria',
                'rules' => 'required|integer|xss_clean|trim|existe_DB[categoria.id]'
            ),
            array(
                'field' => 'profesor_date',
                'label' => 'Profesor',
                'rules' => 'required|integer|xss_clean|trim|existe_DB[profesor.rut]'
            ),
        );
    }

    private function getIdPost() {
        $id = $this->input->post('id', true);
        $this->tesis_id_post = $id;
    }

    public function index() {
        $this->setTesis_titulo('Indice | Tesis');
        /*
         * Aca va se le envia los datos para el filtro
         */
        $this->setTesis_categorias($this->Categoria_model->getCategorias());
        $this->setTesis_profesores($this->Profesor_model->getProfesores());
        $this->setTesis_facultades($this->Facultad_model->getFacultades());
        $this->setTesis_carreras($this->Carrera_model->getCarreras());
        /*
         * 
         */
        if ($this->input->get() == true) {
            $consulta = array();
            if ($this->input->get('categoria')) {
                $consulta['categoria.nombre_categoria'] = $this->input->get('categoria');
            }
            if ($this->input->get('facultad')) {
                $consulta['facultad.nombre_facultad'] = $this->input->get('facultad');
            }
            if ($this->input->get('carrera')) {
                $consulta['carrera.nombre_carrera'] = $this->input->get('carrera');
            }
            if ($this->input->get('profesor')) {
                $consulta['tesis.profesor_guia_rut'] = $this->input->get('profesor');
            }
//            var_dump($consulta);
            $tesis = $this->Tesis_model->getFiltrarTesis($consulta);
//            var_dump($tesis);
            $this->setTesis_todasTesis($tesis);
//            $this->mostrar_vista('tesis/index');
        } else {
            $this->setTesis_todasTesis($this->Tesis_model->getTodas($this->admin));
        }
        $this->setTesis_proximasTesis($this->Tesis_model->getProximasDefensas());

        // Si es admin le muestro una vista especial, donde se ven los botones de
        // modificar y eliminar
        $vista = ($this->admin) ? 'index_admin' : 'index';
        $this->mostrar_vista('tesis/' . $vista);
    }

    public function ver($id = NULL) {
        $id = (int) $id;
        if (!$id) {
            $this->redireccionar_msg('tesis', 'No especifico la tesis a mostrar!');
        }
        /*
         * Aca va se le envia los datos para el filtro
         */
        $this->setTesis_categorias($this->Categoria_model->getCategorias());
        $this->setTesis_profesores($this->Profesor_model->getProfesores());
        $this->setTesis_facultades($this->Facultad_model->getFacultades());
        $this->setTesis_carreras($this->Carrera_model->getCarreras());
        /*
         * 
         */
        if ($this->input->get() == true) {
            $consulta = array();
            if ($this->input->get('categoria')) {
                $consulta['categoria.nombre_categoria'] = $this->input->get('categoria');
            }
            if ($this->input->get('facultad')) {
                $consulta['facultad.nombre_facultad'] = $this->input->get('facultad');
            }
            if ($this->input->get('carrera')) {
                $consulta['carrera.nombre_carrera'] = $this->input->get('carrera');
            }
            if ($this->input->get('profesor')) {
                $consulta['tesis.profesor_guia_rut'] = $this->input->get('profesor');
            }
//            var_dump($consulta);
            $tesis = $this->Tesis_model->getFiltrarTesis($consulta);
        }
//            var_dump($tesis);
//            $this->setTesis_todasTesis($tesis);
        $this->setTesis_getTesis($this->Tesis_model->getTesis($id, $this->admin));
        if ($this->tesis_getTesis) { //existe tesis
            $this->setTesis_titulo($this->tesis_getTesis->titulo);
            $this->mostrar_vista('tesis/ver');
        } else {
            $this->redireccionar_msg('tesis', 'Tesis no encontrada');
        }
    }

    public function editar($id = null) {
        if (!$this->ion_auth->is_admin()) {
            redirect('account/login');
        }
        $id = (int) $id;
        if (!$id) {
            $this->redireccionar_msg('tesis', 'Tesis no valida para editar');
        }
        if ($this->input->post()) {
            $this->validation();
            $this->form_validation->set_rules($this->validation);
            if ($this->form_validation->run() == true) {
                $this->getDatosPost();
                $this->getIdPost();

                // Comprobar que el estudiante este en la db
                $this->load->model('Estudiante_model');
                $rut = $this->tesis_datos_post['estudiante_rut'];
                if (!$this->Estudiante_model->checkEstudiante($rut)) { // El rut no esta en la db, se lo pedimos al WS
                    $estudiante = $this->Estudiante_model->getfromWS($rut . calcularDV_rut($rut));
                    if (!$estudiante) {
                        $this->redireccionar_msg('tesis', 'El estudiante no existe en dirdoc, compruebe los datos');
                    }
                }

                $editado = $this->Tesis_model->editar($this->tesis_id_post, $this->tesis_datos_post);
                if ($editado == true) {
                    if ($this->tesis_fichero_ubicacion == null) {
                        $this->redireccionar_msg('tesis', 'Tesis editada, pero no se ha recibido fichero (Debio haberlo olvidado subirlo)');
                    } else {
                        $this->redireccionar_msg('tesis', 'Tesis editada con exito');
                    }
                } else {
                    $this->redireccionar_msg('tesis', 'Vuelva a procesar la peticion');
                }
            }
        }
        $this->setTesis_titulo('Editar | Tesis');
        $this->setTesis_profesores($this->Profesor_model->getProfesores());
        $this->setTesis_categorias($this->Categoria_model->getCategorias());
        $this->setTesis_getTesis($this->Tesis_model->getTesis($id, $this->admin));
        $this->setTesis_acction('Editar/' . $id);
        $this->setTesis_agregar_modificar('Editar');

        if ($this->tesis_getTesis) { //existe tesis
            $this->mostrar_vista('tesis/formulario');
        } else {
            $this->redireccionar_msg('tesis', 'Tesis no encontrada');
        }
    }

    public function agregar() {
        if (!$this->ion_auth->is_admin()) {
            redirect('account/login');
        }
        $this->setTesis_titulo('Agregar | Tesis');
        $this->setTesis_agregar_modificar('Agregar');
        $this->setTesis_acction('Agregar');
        $this->setTesis_profesores($this->Profesor_model->getProfesores());
        $this->setTesis_categorias($this->Categoria_model->getCategorias());
        if ($this->input->post()) {
            $this->validation();
            $this->form_validation->set_rules($this->validation);
            if ($this->form_validation->run() == true) {
                $this->getDatosPost();

                // Comprobar que el estudiante este en la db
                $this->load->model('Estudiante_model');
                $rut = $this->tesis_datos_post['estudiante_rut'];
                if (!$this->Estudiante_model->checkEstudiante($rut)) { // El rut no esta en la db, se lo pedimos al WS
                    $estudiante = $this->Estudiante_model->getfromWS($rut . calcularDV_rut($rut));
                    if (!$estudiante) {
                        $this->redireccionar_msg('tesis', 'El estudiante no existe en dirdoc, compruebe los datos');
                    }
                }

                $guardado = $this->Tesis_model->agregar($this->tesis_datos_post);
                if ($guardado == true) {

                    if ($this->tesis_fichero_ubicacion == null) {
                        $this->redireccionar_msg('tesis', 'Tesis agregada, pero no se ha recibido fichero (Debio haberlo olvidado subirlo)');
                    } else {
                        $this->redireccionar_msg('tesis', 'Se agrego una nueva tesis');
                    }
                } else {
                    $this->redireccionar_msg('tesis', 'Vuelva a intentarlo :(');
                }
            }
        }
        $this->mostrar_vista('tesis/formulario');
    }

    public function eliminar($id) {
        $id = (int) $id;
        $tesis = $this->Tesis_model->getTesis($id, $this->admin);
        if ($tesis) {
            $eliminado = $this->Tesis_model->eliminar($id);
            if ($eliminado == true) {
                $this->redireccionar_msg('tesis', 'Fue exitosamente eliminado!');
            } else {
                $this->redireccionar_msg('tesis', 'Intentelo nuevamente, Ooops :/');
            }
        } else {
            $this->redireccionar_msg('tesis', 'No se enontro la tesis a eliminar');
        }
    }
    
    public function patoh() {
        $this->load->model('Comision_model');
        $this->Comision_model->agregar(array('ruts' => array('5000233', '10471648')));
    }
}
