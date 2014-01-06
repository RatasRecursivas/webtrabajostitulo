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
 * Description of account
 *
 * @author pperez
 */
class Account extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->database();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->helper('utilities');
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) { // Si no esta loggeado lo redireccionamos al login
            redirect('account/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // Verifico que sea admin, o lo echo
            redirect('/', 'refresh');
        }
    }

    public function login() { // hace el login del usuario
        $this->data['title'] = "Login";

        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            // Desea recordar su contraseña?
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                // Login correcto, redireccionamos
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('/', 'refresh');
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('account/login', 'refresh');
            }
        } else { // La validacion dio un ranazo // Redireccionamos al login
            $this->data['msg'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );
            $this->load->view('template/head', $this->data);
            $this->load->view('account/login', $this->data);
            $this->load->view('template/footer');
        }
    }

    public function logout() {
        $this->data['title'] = "Logout";

        // Deslogueamos al usuario
        $logout = $this->ion_auth->logout();

        // Y lo devolvemos al login
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('/', 'refresh');
    }

    public function cambiar_password() {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect('account/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row(); // Obtenemos la info del usuario logeado

        if ($this->form_validation->run() == false) { // No se valido el form
            // Mostramos los errores de validacion
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
            );
            $this->data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
            );

            //render
            $this->load->view('account/cambiar_password', $this->data);
        } else {
            // El form fue validado
            $identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));
            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) { // Valido si el cambio de pass fue valido
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout(); // Logout :)
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('account/cambiar_password', 'refresh');
            }
        }
    }

    public function recordar_password() {
        $this->data['title'] = 'Olvido su password?';
        $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required');
        if ($this->form_validation->run() == false) { // No se valido el form
            $this->data['email'] = array('name' => 'email',
                'id' => 'email',
            );
            if ($this->config->item('identity', 'ion_auth') == 'username') { // Olvido password via usuario?
                $this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
            } else { // Olvido password via mail?
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            // Mostramos los errores
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->load->view('template/head', $this->data);
            $this->load->view('account/recordar_password', $this->data);
            $this->load->view('template/footer');
        } else {
            $config_tables = $this->config->item('tables', 'ion_auth');

            // Obtener la identidad para ese email
            $identity = $this->db->where('email', $this->input->post('email'))->limit('1')->get($config_tables['users'])->row();

            // Ahora con el modelo hacemos la magia de que le mande el mail al wilson
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) { // Enviado correctamente
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("account/login", 'refresh');
            } else { // Errores, que intente de nuevo
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("account/recordar_password", 'refresh');
            }
        }
    }

    public function reiniciar_password($code = NULL) {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) { // El codigo es valido, le mostramos el form para reiniciar la pass
            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) { // No valido
                // Establecemos el flash_data si es que hay uno
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                $this->load->view('account/reiniciar_password', $this->data);
            } else { // El form se valido
                // Pero es un request valido?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    // El csrf es invalido, quizas de donde venga este request!
                    // Tambien puede ser que hayan vandalizado el user_id en el form
                    $this->ion_auth->clear_forgotten_password_code($code); // f* u!

                    show_error($this->lang->line('error_csrf'));
                } else { // El csrf es valido, tambien el user_id
                    // Cambiamos el pass
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        // Password cambiaba correctamente
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        $this->logout();
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('account/reiniciar_password/' . $code, 'refresh');
                    }
                }
            }
        } else { // El codigo es invalido, que intente de nuevo
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("account/recordar_password", 'refresh');
        }
    }

}
