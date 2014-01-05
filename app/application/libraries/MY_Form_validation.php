<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mivalidation
 *
 * @author natalia
 */
class MY_Form_validation extends CI_Form_validation {

    
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function validate_fecha_anio_mes_dia_hora_minuto_segundo($str) {
        if ($this->validateDate($str, 'Y-m-d H:i:s') == FALSE) {
            $this->set_message('validate_fecha_anio_mes_dia_hora_minuto_segundo', 'El campo %s esta mal ingresada, intentelo nuevamente');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function validate_fecha_anio_mes_dia($str) {
        if ($this->validateDate($str, 'Y-m-d') == FALSE) {
            $this->set_message('validate_fecha_anio_mes_dia', 'El campo %s esta mal ingresada, intentelo nuevamente');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function comprobar_fichero($str){
        if($str == false){ //Ups no adjunto el fichero!
            $this->set_message('comprobar_fichero','Adjunte el fichero! al parecer se le olvido');
            return FALSE;
        }  else {
            return TRUE;
        }
    }


//    public function value_rut($str) {
//        if (esRut($str) == FALSE) {
//            $this->validation->set_message('value_rut', 'El %s esta mal ingresado, intentelo nuevamente"');
//            return FALSE;
//        } else {
//            return TRUE;
//      }
//    }
}