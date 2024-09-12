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
    public function chemicalUsageChart(){
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
        $this->load->view('template/chartsContentThree');
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
    public function chemical_usage_data() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $date = $this->input->post('date'); // Expected format: YYYY-MM
            $plantId = $this->input->post('plantId');
    
            // Fetch data from the model
            $data = $this->DataModel->getChemicalUsage($date, $plantId);
    
            if (!empty($data)) {
                // Prepare arrays for chart data
                $dates = [];
                $alum = [];
                $pacl = [];
                $lime = [];
                $polymer = [];
                $gas_chlorine = [];
                $salt = [];
                $bleaching_powder = [];
    
                // Loop through the data and prepare arrays
                foreach ($data as $row) {
                    $dates[] = $row->date;
                    $alum[] = $row->alum;
                    $pacl[] = $row->pacl;
                    $lime[] = $row->lime;
                    $polymer[] = $row->polymer;
                    $gas_chlorine[] = $row->gas_chlorine;
                    $salt[] = $row->salt;
                    $bleaching_powder[] = $row->bleaching_powder;
                }
    
                // Return data as JSON for charting
                echo json_encode([
                    'status' => 'success',
                    'dates' => $dates,
                    'alum' => $alum,
                    'pacl' => $pacl,
                    'lime' => $lime,
                    'polymer' => $polymer,
                    'gas_chlorine' => $gas_chlorine,
                    'salt' => $salt,
                    'bleaching_powder' => $bleaching_powder
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No data found for the selected month and year.']);
            }    
        }
    }
    
    public function rawWaterChart(){
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
        $this->load->view('template/chartsContentFour');
        $this->load->view('template/footer');
    }

    public function raw_water_turbidity_data(){
        $date = $this->input->post('date');
        $plantId = $this->input->post('plantId');

        // Validate the input
        if (!$date || !$plantId) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid input data. Please select a valid date and plant.'
            ]);
            return;
        }

        // Fetch data based on the selected date and plant ID
        $data = $this->DataModel->raw_water_turbidity($date, $plantId);

        if (!empty($data)) {
            // Prepare arrays for chart data
            $dates = [];
            $turbidity = [];
            $time = [];
        
            // Loop through the data and prepare arrays
            foreach ($data as $row) {
                $dates[] = $row['date'];
                $turbidity[] = $row['raw_turbidity'];
                 // Convert time to 12-hour AM/PM format
                $dateTime = new DateTime($row['time']); // Create DateTime object
                $time[] = $dateTime->format('h:i A'); // Format to 12-hour format with AM/PM
            }
        
            // Return data as JSON for charting
            echo json_encode([
                'status' => 'success',
                'time' => $time,
                'turbidity' => $turbidity
            ]);
        }else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Raw Turbidity Data not found for the selected date.'
            ]);
        }
    }
    public function jarTestChart(){
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
        $this->load->view('template/chartsContentFive');
        $this->load->view('template/footer');
    }
    public function fetch_jar_data() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $date = $this->input->post('date'); // Expected format: YYYY-MM

            // Fetch data from the model
            $data = $this->DataModel->jar_data($date);

            // Check if data is available and return it as a table
            if (!empty($data)) {
      
            // Prepare data for the chart
            $branchNames = [];
            $values = [];

            foreach ($data as $row) {
                $branchNames[] = $row->branchName;
                $values[] = $row->treated_alum_pacl_jar;
            }

            // Return data as JSON
            echo json_encode([
                'branchNames' => $branchNames,
                'values' => $values
            ]);
            } else {
                echo "No data found for the selected month and year.";
            }
        }
    }

    }

