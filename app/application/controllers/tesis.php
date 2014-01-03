<?php

/*
 * Copyright (C) 2014 Gente Rata S.A
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

/**
 * Description of tesis
 *
 * @author pperez
 */

class Tesis extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Tesis_model');
    }

    public function index() {
        $data['title'] = 'Índice';
        $data['query'] = $this->Tesis_model->getTodas();
        $data['defensas'] = $this->Tesis_model->getProximasDefensas();
        $this->load->view('template/head', $data);
        $this->load->view('tesis/index', $data);
        $this->load->view('template/footer');
    }
    
    public function ver($id = NULL) {
        if($id)
        {
            $tesis = $this->Tesis_model->getTesis($id);
            $data['tesis'] = $tesis;
            $data['title'] = $tesis->titulo;
            
            $this->load->view('template/head', $data);
            $this->load->view('tesis/ver', $data);
            $this->load->view('template/footer');
        }
    }
}