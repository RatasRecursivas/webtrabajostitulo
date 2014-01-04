<?php

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
class mivalidation extends CI_Form_validation {

    
    public function __construct() {
        parent::__construct();
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function value_fecha_hora($str) {
        if ($this->validateDate($str, 'Y-m-d h:i:s') == FALSE) {
            $this->validation->set_message('value_fecha_hora', 'la fecha %s esta mal ingresada, intentelo nuevamente"');
            return FALSE;
        } else {
            return TRUE;
        }
    }
   
    private function validate($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    
    public function value_fecha($str) {
        if ($this->validateDate($str, 'Y-m-d') == FALSE) {
            $this->validation->set_message('value_fecha', 'la fecha %s esta mal ingresada, intentelo nuevamente"');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function value_rut($str) {
        if (esRut($str) == FALSE) {
            $this->validation->set_message('value_rut', 'El %s esta mal ingresado, intentelo nuevamente"');
            return FALSE;
        } else {
            return TRUE;
      }
    }
}