<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prueba
 *
 * @author natalia
 */
class prueba extends CI_Controller {

    //put your code here

    public function index() {
        $this->load->model('Tesis_model');
        $var = $this->Tesis_model->getFiltrarTesis('1231');
        var_dump($var);
    }

}
