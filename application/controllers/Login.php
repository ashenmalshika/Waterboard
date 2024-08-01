<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


    public function index() {
        $this->load->view('homepage');
    }

    public function loginUser() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($username && $password) {
            $user = $this->User_model->getUser($username, $password);
            
            if ($user) {
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('role', $user->role);
                if ($user->role == 'admin') {
                    redirect('adminDashboard');
                } else {
                    redirect('Welcome/userDashboard');
                }
            } else {
                $this->session->set_flashdata('msg', 'Invalid username or password');
                redirect('Welcome');
            }
        } else {
            $this->session->set_flashdata('msg', 'Please enter username and password');
            redirect('Welcome');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('role');
        $this->session->sess_destroy();
        redirect('Welcome');
    }
}
