<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function home(){
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
    public function settings(){
        if (!$this->session->userdata('user_id')) {
            redirect('Welcome');
        }

        // Set headers to prevent caching
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

        $data['sessions'] = $this->User_model->getUsersData();


        $this->load->view('template/header');
        $this->load->view('template/topmenu');
        $this->load->view('template/sidemenu');
        $this->load->view('template/settingsContent', $data);
        $this->load->view('template/footer');
    }
    public function searchData(){
        if (!$this->session->userdata('user_id')) {
            redirect('Welcome');
        }

        // Set headers to prevent caching
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

        $data['sessions'] = $this->User_model->getWaterQuality();

        // Check if data was returned
        if ($data['sessions'] === false) {
            // Handle the case where no data was found
            $data['message'] = 'No data found.';
        }

        $this->load->view('template/header');
        $this->load->view('template/topmenu');
        $this->load->view('template/sidemenu');
        $this->load->view('template/searchContent', $data);
        $this->load->view('template/footer');
    }
    public function displayData($id){

        $data['sessions'] = $this->User_model->getFormData($id);

        $this->load->view('template/formData', $data);
 
    }

}