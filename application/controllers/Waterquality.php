<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waterquality extends CI_Controller {
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Colombo'); // Change to your timezone
    }

	public function addDataToDatabase()
	{
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        $date3 = $this->input->post('date3');
        $date4 = $this->input->post('date4');
        $date = null;  // Initialize $date

        if (!empty($date1)) {
            $date = $date1;
        }
        if (!empty($date2)) {
            $date = $date2;
        }
        if (!empty($date3)) {
            if (strpos($date3, '-') !== false) {
                // If the input is in YYYY-MM format, treat it as the first of the month
                $date = $date3 . '-01';
            } else {
                // If the input includes a day, keep it as is (format YYYY-MM-DD)
                $date = $date3;
            }
        }
        if (!empty($date4)) {
            $date = $date4;
        }
        

        $branch_id = $this->input->post('branch_id');
        $branch_name = $this->input->post('branch_name');

        $data = array(
            'date' => $date,
            'time' => $this->input->post('time'),
            'raw_turbidity' => $this->input->post('raw_turbidity'),
            'raw_ph' => $this->input->post('raw_ph'),
            'raw_conductivity' => $this->input->post('raw_conductivity'),
            'raw_salinity' => $this->input->post('raw_salinity'),
            'raw_color' => $this->input->post('raw_color'),
            'raw_odor' => $this->input->post('raw_odor'),
            'settling_rcl' => $this->input->post('settling_rcl'),
            'settling_turbidity' => $this->input->post('settling_turbidity'),
            'settling_ph' => $this->input->post('settling_ph'),
            'treated_rcl' => $this->input->post('treated_rcl'),
            'treated_turbidity' => $this->input->post('treated_turbidity'),
            'treated_ph' => $this->input->post('treated_ph'),
            'treated_conductivity' => $this->input->post('treated_conductivity'),
            'treated_salinity' => $this->input->post('treated_salinity'),
            'treated_color' => $this->input->post('treated_color'),
            'treated_odor' => $this->input->post('treated_odor'),
            'treated_residual_alum_pacl' => $this->input->post('treated_residual_alum_pacl'),
            'filter_rcl' => $this->input->post('filter_rcl'),
            'filter_turbidity' => $this->input->post('filter_turbidity'),
            'filter_ph' => $this->input->post('filter_ph'),
            'alum' => $this->input->post('alum'),
            'pacl' => $this->input->post('pacl'),
            'lime' => $this->input->post('lime'),
            'polymer' => $this->input->post('polymer'),
            'gas_chlorine' => $this->input->post('gas_chlorine'),
            'salt' => $this->input->post('salt'),
            'bleaching_powder' => $this->input->post('bleaching_powder'),
            'diesel' => $this->input->post('diesel'),
            'ceb_reading' => $this->input->post('ceb_reading'),
            'generator_consumption' => $this->input->post('generator_consumption'),
            'treated_alum_pacl_jar1' => $this->input->post('treated_alum_pacl_jar1'),
            'treated_alum_pacl_jar2' => $this->input->post('treated_alum_pacl_jar2'),
            'treated_alum_pacl_jar3' => $this->input->post('treated_alum_pacl_jar3'),
            // Ensure you include fields for pipe1, pipe2, pipe3 if they're needed
            // Pipe 1
            'pipe1_distribution_diameter' => $this->input->post('pipe1_distribution_diameter'),
            'pipe1_bulkmeter_id' => $this->input->post('pipe1_bulkmeter_id'),
            'pipe1_bulkmeter_reading' => $this->input->post('pipe1_bulkmeter_reading'),
            'pipe1_pumping_diameter' => $this->input->post('pipe1_pumping_diameter'),
            'pipe1_pumping_bulkmeter_id' => $this->input->post('pipe1_pumping_bulkmeter_id'),
            'pipe1_pumping_bulkmeter_reading' => $this->input->post('pipe1_pumping_bulkmeter_reading'),
            'pipe1_raw_diameter' => $this->input->post('pipe1_raw_diameter'),
            'pipe1_raw_bulkmeter_id' => $this->input->post('pipe1_raw_bulkmeter_id'),
            'pipe1_raw_bulkmeter_reading' => $this->input->post('pipe1_raw_bulkmeter_reading'),

            // Pipe 2
            'pipe2_distribution_diameter' => $this->input->post('pipe2_distribution_diameter'),
            'pipe2_bulkmeter_id' => $this->input->post('pipe2_bulkmeter_id'),
            'pipe2_bulkmeter_reading' => $this->input->post('pipe2_bulkmeter_reading'),
            'pipe2_pumping_diameter' => $this->input->post('pipe2_pumping_diameter'),
            'pipe2_pumping_bulkmeter_id' => $this->input->post('pipe2_pumping_bulkmeter_id'),
            'pipe2_pumping_bulkmeter_reading' => $this->input->post('pipe2_pumping_bulkmeter_reading'),
            'pipe2_raw_diameter' => $this->input->post('pipe2_raw_diameter'),
            'pipe2_raw_bulkmeter_id' => $this->input->post('pipe2_raw_bulkmeter_id'),
            'pipe2_raw_bulkmeter_reading' => $this->input->post('pipe2_raw_bulkmeter_reading'),

            // Pipe 3
            'pipe3_distribution_diameter' => $this->input->post('pipe3_distribution_diameter'),
            'pipe3_bulkmeter_id' => $this->input->post('pipe3_bulkmeter_id'),
            'pipe3_bulkmeter_reading' => $this->input->post('pipe3_bulkmeter_reading'),
            'pipe3_pumping_diameter' => $this->input->post('pipe3_pumping_diameter'),
            'pipe3_pumping_bulkmeter_id' => $this->input->post('pipe3_pumping_bulkmeter_id'),
            'pipe3_pumping_bulkmeter_reading' => $this->input->post('pipe3_pumping_bulkmeter_reading'),
            'pipe3_raw_diameter' => $this->input->post('pipe3_raw_diameter'),
            'pipe3_raw_bulkmeter_id' => $this->input->post('pipe3_raw_bulkmeter_id'),
            'pipe3_raw_bulkmeter_reading' => $this->input->post('pipe3_raw_bulkmeter_reading'),
            'branchID' => $branch_id,
            'branchName' => $branch_name,
            'formNo' => $this->input->post('form_type'),
            'dataInsertedDate' => date('Y-m-d H:i:s')
        );
        

        if ($this->WaterQualityModel->insertWaterquality($data)) {
            $this->session->set_flashdata('success', 'Data inserted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Data insertion failed!');
        }

        redirect('Welcome/userDashboard');
        
    }

}
