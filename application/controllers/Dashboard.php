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
    public function downloadData(){
        if (!$this->session->userdata('user_id')) {
            redirect('Welcome');
        }

        // Set headers to prevent caching
        $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');

        $data['sessions'] = $this->User_model->getWaterQuality();

        $this->load->view('template/header');
        $this->load->view('template/topmenu');
        $this->load->view('template/sidemenu');
        $this->load->view('template/downloadData', $data);
        $this->load->view('template/footer');
    }
    public function displayData($id){

        $data['sessions'] = $this->User_model->getFormData($id);

        $this->load->view('template/formData', $data);
 
    }
    public function deleteData($id) {
        // Call the delete method from the model
        $result = $this->User_model->deleteRowById($id);

        if ($result) {
            // Successfully deleted
            $this->session->set_flashdata('message', 'Data deleted successfully.');
        } else {
            // Error while deleting
            $this->session->set_flashdata('message', 'Failed to delete data.');
        }

        redirect($_SERVER['HTTP_REFERER']);
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
            $plantId = $this->input->post('plantId');

            // Load your model
            $this->load->model('DataModel');

            // Fetch data from the model
            $data = $this->DataModel->get_diesel_data($date,$plantId);

            // Check if data is available and return it as a table
            if (!empty($data)) {
      
                        // Prepare data for the chart
            $date = [];
            $dieselValues = [];

            foreach ($data as $row) {
                $dateObj = new DateTime($row->date);
                $date[] = $dateObj->format('F');
                $dieselValues[] = $row->diesel;
            }

            // Return data as JSON
            echo json_encode([
                'date' => $date,
                'dieselValues' => $dieselValues
            ]);
            } else {
                echo "No data found for the selected year.";
            }
        }
    }
    public function fetch_electricity_data() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $date = $this->input->post('date'); // Expected format: YYYY
            $plantId = $this->input->post('plantId');
        
            // Load your model
            $this->load->model('DataModel');
    
            // Fetch data from the model
            $data = $this->DataModel->get_unit_by_date($date,$plantId);
        
            $month = array_column($data, 'month');
            $unitValues = array_column($data, 'unitValue');
            // Return data as JSON for charting
            echo json_encode([
                'status' => 'success',
                'month' => $month,
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
            $rawTurbidity = [];
            $rawPh = [];
            $treatedRcl = [];
            $treatedTurbidity = [];
            $treatedPh = [];
            $time = [];
        
            // Loop through the data and prepare arrays
            foreach ($data as $row) {
                $dates[] = $row['date'];
                $rawTurbidity[] = $row['raw_turbidity'];
                $rawPh[] = $row['raw_ph'];
                $treatedRcl[] = $row['treated_rcl'];
                $treatedTurbidity[] = $row['treated_turbidity'];
                $treatedPh[] = $row['treated_ph'];
                 // Convert time to 12-hour AM/PM format
                $dateTime = new DateTime($row['time']); // Create DateTime object
                $time[] = $dateTime->format('h:i A'); // Format to 12-hour format with AM/PM
            }
        
            // Return data as JSON for charting
            echo json_encode([
                'status' => 'success',
                'rawPh' => $rawPh,
                'treatedRcl' => $treatedRcl,
                'treatedTurbidity' => $treatedTurbidity,
                'treatedPh' => $treatedPh,
                'time' => $time,
                'rawTurbidity' => $rawTurbidity
            ]);
        }else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Raw Water & Treated Water Quality Data not found.'
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
    }public function productionChart(){
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
        $this->load->view('template/chartsContentSix');
        $this->load->view('template/footer');
    } 
    public function productionData(){
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $date = $this->input->post('date'); // Expected format: YYYY-MM
            $plantId = $this->input->post('plantId');

            $year = substr($date, 0, 4);  
            $month = substr($date, 5, 2);
    
            // Fetch data from the model
            $productionData = $this->DataModel->getProductionData($year, $month, $plantId);   

            // Check if data is available
            if (!empty($productionData)) {
                // Prepare the response data for chart update
                $day = [];
                $rawDailyValue = [];
                $productionDailyValue = [];
                $plantLost = [];

                foreach ($productionData as $data) {
                    $day[] = $data['day'];
                    $rawDailyValue[] = $data['raw_daily_value'];
                    $productionDailyValue[] = $data['productionDailyValue'];
                    $plantLost[] = $data['plantLost'];
                }

                echo json_encode([
                    'status' => 'success',
                    'data' => [
                        'day' => $day,
                        'rawDailyValue' => $rawDailyValue,
                        'productionDailyValue' => $productionDailyValue,
                        'plantLost' => $plantLost
                    ]
                ]);
            } else {
                // No data found for the selected date and plant
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No production data found for the selected date.'
                ]);
            }     
        }
    }
    public function jarTestData(){
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $date = $this->input->post('date'); // Expected format: YYYY-MM
            $plantId = $this->input->post('plantId');

            $year = substr($date, 0, 4);  
            $month = substr($date, 5, 2);

            $this->load->model('jarTestModel');

            $productionData = $this->jarTestModel->getActualData($year, $month, $plantId);  
            // Check if data is available
            if (!empty($productionData)) {
                // Prepare the response data for chart update
                $day = [];
                $jarTest = [];
                $actualAlum = [];
                $actualPacl = [];

                foreach ($productionData as $data) {
                    $day[] = $data['day'];
                    $jarTest[] = $data['jar_test'];
                    $actualAlum[] = $data['actual_alum'];
                    $actualPacl[] = $data['actual_pacl'];
                }

                echo json_encode([
                    'status' => 'success',
                    'data' => [
                        'day' => $day,
                        'jarTest' => $jarTest,
                        'actualAlum' => $actualAlum,
                        'actualPacl' => $actualPacl
                    ]
                ]);
            } else {
                // No data found for the selected date and plant
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No Jar test, Actual Alum/PaCl data found for the selected date.'
                ]);
            } 
 
           
        }}
}