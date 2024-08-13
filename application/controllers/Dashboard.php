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
    public function graphs(){
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
        $this->load->view('template/graphsContent');
        $this->load->view('template/footer');
    }
    public function monthchart(){
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
        $this->load->view('template/chartsContentOne');
        $this->load->view('template/footer');
    }
    public function electricityChart(){
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
        $this->load->view('template/chartsContentTwo');
        $this->load->view('template/footer');
    }
    public function fetch_data() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $date = $this->input->post('date'); // Expected format: YYYY-MM

            // Load your model
            $this->load->model('DataModel');

            // Fetch data from the model
            $data = $this->DataModel->get_data_by_date($date);

            // Check if data is available and return it as a table
            if (!empty($data)) {
      
                        // Prepare data for the chart
            $branchNames = [];
            $dieselValues = [];

            foreach ($data as $row) {
                $branchNames[] = $row->branchName;
                $dieselValues[] = $row->diesel;
            }

            // Return data as JSON
            echo json_encode([
                'branchNames' => $branchNames,
                'dieselValues' => $dieselValues
            ]);
            } else {
                echo "No data found for the selected month and year.";
            }
        }
    }
    public function fetch_electricity_data() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $date = $this->input->post('date'); // Expected format: YYYY-MM
        
            // Load your model
            $this->load->model('DataModel');
    
            // Fetch data from the model
            $data = $this->DataModel->get_unit_by_date($date);
        
            $branchNames = array_column($data, 'branchName');
            $unitValues = array_column($data, 'unitValue');
            // Return data as JSON for charting
            echo json_encode([
                'status' => 'success',
                'branchNames' => $branchNames,
                'unitValues' => $unitValues
            ]);
        }
    }
    
    }

