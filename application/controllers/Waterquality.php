<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waterquality extends CI_Controller {

	public function addDataToDatabase()
	{
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('distribution_bulkmeter', 'Distribution Bulk Meter Reading', 'required');
        $this->form_validation->set_rules('distribution_pumping', 'Pumping Bulk Meter Reading', 'required');
        $this->form_validation->set_rules('raw_turbidity', 'Raw Water Turbidity', 'required');
        $this->form_validation->set_rules('raw_ph', 'Raw Water pH', 'required');
        $this->form_validation->set_rules('raw_salinity', 'Raw Water Salinity', 'required');
        $this->form_validation->set_rules('settling_turbidity', 'Settling Water Turbidity', 'required');
        $this->form_validation->set_rules('settling_ph', 'Settling Water pH', 'required');
        $this->form_validation->set_rules('settling_salinity', 'Settling Water Salinity', 'required');
        $this->form_validation->set_rules('treated_turbidity', 'Treated Water Turbidity', 'required');
        $this->form_validation->set_rules('treated_ph', 'Treated Water pH', 'required');
        $this->form_validation->set_rules('treated_salinity', 'Treated Water Salinity', 'required');
        $this->form_validation->set_rules('treated_rcl', 'Treated Water RCL', 'required');
        $this->form_validation->set_rules('pacl', 'PACL', 'required');
        $this->form_validation->set_rules('lime', 'Lime', 'required');
        $this->form_validation->set_rules('cl', 'Cl', 'required');
        $this->form_validation->set_rules('diesel', 'Diesel', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('userDashboard');
        } else {
            $data = array(
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),
                'distribution_bulkmeter' => $this->input->post('distribution_bulkmeter'),
                'distribution_pumping' => $this->input->post('distribution_pumping'),
                'raw_turbidity' => $this->input->post('raw_turbidity'),
                'raw_ph' => $this->input->post('raw_ph'),
                'raw_salinity' => $this->input->post('raw_salinity'),
                'settling_turbidity' => $this->input->post('settling_turbidity'),
                'settling_ph' => $this->input->post('settling_ph'),
                'settling_salinity' => $this->input->post('settling_salinity'),
                'treated_turbidity' => $this->input->post('treated_turbidity'),
                'treated_ph' => $this->input->post('treated_ph'),
                'treated_salinity' => $this->input->post('treated_salinity'),
                'treated_rcl' => $this->input->post('treated_rcl'),
                'pacl' => $this->input->post('pacl'),
                'lime' => $this->input->post('lime'),
                'cl' => $this->input->post('cl'),
                'diesel' => $this->input->post('diesel')
            );

            if ($this->WaterQualityModel->insertWaterquality($data)) {
                $this->session->set_flashdata('success', 'Data inserted successfully!');
            } else {
                $this->session->set_flashdata('error', 'Data insertion failed!');
            }

            $this->load->view('userDashboard');
        }
    }
}
