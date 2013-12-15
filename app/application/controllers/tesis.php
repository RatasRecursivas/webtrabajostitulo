<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tesis extends CI_Controller {
	public function index()
	{
		$this->load->model('Tesis_Model');
		$query = $this->Tesis_Model->mostrar();
		$this->load->view('tesis/index', compact("query"));
	}
	
	public function agregar()
	{
		if($this->input->post())
		{
			$this->load->model('Tesis_Model');
			$tesis = array(
					'titulo' => $this->input->post('titulo', true),
					'fecha_publicacion' => $this->input->post('fecha_publicacion', true),
					'fecha_disponibilidad' => $this->input->post('fecha_disponibilidad', true),
					'abstract' => $this->input->post('abstract', true),
					'ubicacion_fichero' => $this->input->post('ubicacion_fichero', true)
			);
			if($this->Tesis_Model->insertar($tesis))
				redirect('tesis');
		}
		else
		{
			$this->load->view('tesis/nueva');
		}
		
	}
}

/* End of file tesis.php */
/* Location: ./application/controllers/tesis.php */