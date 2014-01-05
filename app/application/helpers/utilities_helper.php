<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('calcularDV_rut')) {

    /**
     * Calcula el digito verificador de un RUT.
     * Fuente: http://www.dcc.uchile.cl/~mortega/microcodigos/validarrut/php.php
     * @author Luis Dujovne
     * @param int $r  Un RUT sin DV
     * @return char(1) el digito verificador del RUT
     */
    function calcularDV_rut($rut) {
        $s = 1;
        for ($m = 0; $rut != 0; $rut/=10) {
            $s = ($s + $rut % 10 * (9 - $m++ % 6)) % 11;
        }
        return chr($s ? $s + 47 : 75);
    }

}

if (!function_exists('format_rut')) {

    function format_rut($rut) { // Recibe el rut sin puntos ni digito verificador
        return number_format($rut, 0, '', '.') . '-' . calcularDV_rut($rut);
    }

}

if (!function_exists('decode_rut')) {

    function decode_rut($rut) { // Toma un rut con puntos y guiones y se los quita
        return str_replace(array('.', '-'), '', $rut);
    }

}

if ( ! function_exists('form_error_small'))
{
	function form_error_small($field)
	{
                return form_error($field, '<small class="error">', '</small>');
	}
}