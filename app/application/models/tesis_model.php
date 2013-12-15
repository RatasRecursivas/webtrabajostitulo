<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tesis_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function insertar($data)
	{
		if($this->db->insert('tesis', $data))
			return true;
		else
			return false;
	}
	
	public function mostrar()
	{
		$query = $this->db->get('tesis');
		return $query->result();
	}
}