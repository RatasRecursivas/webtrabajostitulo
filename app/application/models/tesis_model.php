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
		$query = $this->db->order_by('fecha_publicacion', 'asc')->get('tesis');
		return $query->result();
	}
	
	public function editar($id, $data)
	{
		if($this->db->where('id', $id)->update('tesis', $data))
			return true;
		else
			return false;
	}
	
	public function getTesis($id)
	{
		return $this->db->select('*')->from('tesis')->where('id', $id)->get()->row();
	}

	public function eliminar($id)
        {
            if($this->db->delete('tesis',array('id'=>$id )))
                return true;
            else
                return false;
        }
}
