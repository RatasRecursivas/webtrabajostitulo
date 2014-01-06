<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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

if (!function_exists('form_error_small')) {

    function form_error_small($field) {
        return form_error($field, '<small class="error">', '</small>');
    }

}
if (!function_exists('esRut')) {

    function esRut($r = false) {
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

}

if (!function_exists('form_label_vandalizado')) {

    function form_label_vandalizado($label_text = '', $id = '', $attributes = array(), $tooltip = '') {
        $label = '<label';

        if ($id != '') {
            $label .= " for=\"$id\"";
        }

        if (is_array($attributes) AND count($attributes) > 0) {
            foreach ($attributes as $key => $val) {
                $label .= ' ' . $key . '="' . $val . '"';
            }
        }

        $label .= ">";

        if ($tooltip != '') {
            $label .= "<span data-tooltip class=\"has-tip\" title=\"" . $tooltip . "\">";
        }
        $label .= "</span>$label_text</label>";
//         $label_text</label>";

        return $label;
    }

}