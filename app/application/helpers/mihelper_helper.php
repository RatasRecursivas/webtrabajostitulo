<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! function_exists('form_error_small'))
{
	function form_error_small($field)
	{
                return form_error($field, '<small class="error">', '</small>');
	}
}