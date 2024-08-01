<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('homepage');
	}
	public function userDashboard() {
        // Check if the user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('Welcome');
        }

        // Set headers to prevent caching
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

        $this->load->view('userDashboard');
    }
    public function adminDashboard()
	{
        // Check if the user is logged in
        if (!$this->session->userdata('user_id')) {
            redirect('Welcome');
        }
        
        // Set headers to prevent caching
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

        $this->load->view('template/header');
        $this->load->view('template/topmenu');
        $this->load->view('template/sidemenu');
		$this->load->view('template/adminDashboard');
        $this->load->view('template/footer');
	}
}
