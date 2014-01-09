<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of comision_model
 *
 * @author pperez
 */
class Comision_model extends CI_Model {
    var $ruts_profes;
    var $tabla_comision = 'comision';
    var $tabla_comision_profesor = 'comision_profesor';
    
    function __construct() {
        parent::__construct();
    }
    
    public function agregar($data) // En data deberian venir los ruts de los profes como array
    {
        // data['ruts'] es un array de ruts de profesores
        $this->load->helper('date'); // Para traerme la fecha actual
        $now = now();
        
        // Inserto un registro en la tabla comision
        $insert_comision = $this->db->insert($this->tabla_comision, array('created_on' => $now));
        // Obtengo el id del insert en la tabla comision
        $id_comision = $this->db->select('last_value')
                ->from('comision_id_seq')
                ->get()->row()->last_value;;
        $ok = $insert_comision;
        
        if($insert_comision)
        {
            $datos['id_comision'] = $id_comision;
            foreach ($data['ruts_profesores_comision'] as $rut) // Itero y voy haciendo inserts
            {
                $datos['rut_profesor'] = $rut;
                $insert_comision_profesor = $this->db->insert($this->tabla_comision_profesor, $datos);
                $ok = $ok and $insert_comision_profesor;
            }
        }
        return $ok; // Probablemente seria bueno que revirtiera algun insert, pero que va
    }
}
