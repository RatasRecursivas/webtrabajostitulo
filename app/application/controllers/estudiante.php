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
 * Description of estudiante
 *
 * @author pperez
 */

class Estudiante extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Estudiante_model');
    }
    
    public function index() {
//        $data['estudiantes'] = $this->Estudiante_model->getEstudiantes();
//        $this->load->library('ws_dirdoc');
//        $estudiante = $this->ws_dirdoc->getEstudiante('178763075');
//        echo var_dump($estudiante);
        $this->Estudiante_model->getfromWS('178763075');
        $test = $this->Estudiante_model->getEstudiante('17876307');
        echo var_dump($test);
    }
}
