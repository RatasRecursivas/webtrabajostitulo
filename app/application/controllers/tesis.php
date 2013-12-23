<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tesis extends CI_Controller {

    public function index() {
        $data['title'] = 'Index';
        $this->load->model('Tesis_Model');
        $query = $this->Tesis_Model->mostrar();
        $this->load->view('templates/head', compact('data'));
        $this->load->view('tesis/index_body', compact("query"));
        $this->load->view('templates/footer');
    }

    public function agregar() {
        if ($this->input->post()) {
            $this->load->model('Tesis_Model');
            $tesis = array(
                'titulo' => $this->input->post('titulo', true),
                'fecha_publicacion' => $this->input->post('fecha_publicacion', true),
                'fecha_disponibilidad' => $this->input->post('fecha_disponibilidad', true),
                'abstract' => $this->input->post('abstract', true),
                'ubicacion_fichero' => $this->input->post('ubicacion_fichero', true)
            );
            if ($this->Tesis_Model->insertar($tesis))
                redirect('tesis');
        }
        else {
            $data['title'] = "Agregar";
            $this->load->view('templates/head', compact('data'));
            $this->load->view('tesis/nueva');
            $this->load->view('templates/footer');
        }
    }

    public function editar($id = NULL) {
        $data['title'] = 'Edición';
        $this->load->model('Tesis_Model');
        if ($this->input->post()) {
            $tesis = array(
                'titulo' => $this->input->post('titulo', true),
                'fecha_publicacion' => $this->input->post('fecha_publicacion', true),
                'fecha_disponibilidad' => $this->input->post('fecha_disponibilidad', true),
                'abstract' => $this->input->post('abstract', true),
                'ubicacion_fichero' => $this->input->post('ubicacion_fichero', true)
            );
            if ($this->Tesis_Model->editar($this->input->post('id', true), $tesis)) {
                redirect('tesis');
            } else {
                $this->load->view('templates/head', compact('data'));
                $this->load->view('tesis/error');
                $this->load->view('templates/footer');
            }
        } else {
            $query = $this->Tesis_Model->getTesis($id);
            if ($query) {
                $this->load->view('templates/head', compact('data'));
                $this->load->view('tesis/editar_body', compact('query', 'id'));
                $this->load->view('templates/footer');
            } else {
                $this->load->view('templates/head', compact('data'));
                $this->load->view('tesis/error');
                $this->load->view('templates/footer');
            }
        }
    }

    public function eliminar($id) {
        $this->load->model('Tesis_Model');
        $query = $this->Tesis_Model->getTesis($id);
        if ($query) {
            $this->Tesis_Model->eliminar($id);
            //Buscando como mostrar un mensaje bonito en home que se elimino
            redirect('tesis');
        } else {
            $this->load->view('templates/head', compact('data'));
            $this->load->view('tesis/error');
            $this->load->view('templates/footer');
        }
    }

}

/* End of file tesis.php */
/* Location: ./application/controllers/tesis.php */
