<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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

    public function validate_hora_minuto_segundo($str) {
        if ($this->validateDate($str, 'H:i:s') == FALSE) {
            $this->set_message('validate_hora_minuto_segundo', 'El campo %s esta mal ingresada, intentelo nuevamente');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function existe_DB($str, $field) {
        list($table, $field) = explode('.', $field);
        $query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
        if ($query->num_rows() != 1) {
            $this->set_message('existe_DB','Esta seleccionando un rango no permitido en %s');
            return FALSE;
        }  else {
            return TRUE;
        }
    }

    public function compararFecha($fecha_dis, $otra_fecha_pu) {

        $dispo = strptime($fecha_dis, '%Y-%m-%d');
        $publ = strptime($otra_fecha_pu, '%Y-%m-%d');

        $mes_dis = (int) $dispo['tm_mon'] + 1;
        $anio_dis = (int) $dispo['tm_year'] + 1900;
        $mes_pub = (int) $publ['tm_mon'] + 1;
        $anio_pub = (int) $publ['tm_year'] + 1900;

        $fecha_dis = $dispo['tm_mday'] . '-' . $mes_dis . '-' . $anio_dis;
        $fecha_pu = $publ['tm_mday'] . '-' . $mes_pub . '-' . $anio_pub;

//        var_dump($fecha_dis);
        $fecha_disponibilidad = strtotime($fecha_dis);
        $fecha_publica = strtotime($fecha_pu);
//        var_dump($fecha_disponibilidad);
//        var_dump($fecha_publica <= $fecha_disponibilidad);
        if ($fecha_publica > $fecha_disponibilidad) {
            $this->set_message('compararFecha', 'NO el campo debe ser mayor que el de fecha de publicación');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function valide_fichero($fichero, $fecha_publicacion) {
        redirect($fecha_publicacion);
    }

    public function validate_fecha_anio_mes_dia($str) {
        if ($this->validateDate($str, 'Y-m-d') == FALSE) {
            $this->set_message('validate_fecha_anio_mes_dia', 'El campo %s esta mal ingresada, intentelo nuevamente');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function esRut($r = false) {
        if ((!$r) or (is_array($r)))
            return false; /* Hace falta el rut */

        if (!$r = preg_replace('|[^0-9kK]|i', '', $r))
            return false; /* Era código basura */

        if (!((strlen($r) == 8) or (strlen($r) == 9)))
            return false; /* La cantidad de carácteres no es válida. */

        $v = strtoupper(substr($r, -1));
        if (!$r = substr($r, 0, -1))
            return false;

        if (!((int) $r > 0))
            return false; /* No es un valor numérico */

        $x = 2;
        $s = 0;
        for ($i = (strlen($r) - 1); $i >= 0; $i--) {
            if ($x > 7)
                $x = 2;
            $s += ($r[$i] * $x);
            $x++;
        }
        $dv = 11 - ($s % 11);
        if ($dv == 10)
            $dv = 'K';
        if ($dv == 11)
            $dv = '0';
        if ($dv == $v)
            return number_format($r, 0, '', '.') . '-' . $v; /* Formatea el RUT */
        return false;
    }

    public function value_rut($str) {
        if ($this->esRut($str) == FALSE) {
            $this->set_message('value_rut', 'El %s esta mal ingresado, intentelo nuevamente');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
