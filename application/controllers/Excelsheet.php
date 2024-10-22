<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excelsheet extends CI_Controller {

    public function loadData(){
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $plantId = $this->input->post('plantId');
    
        // Combine the year and month to form the date
        $date = $year . '-' . $month;

        $this->load->model('ExcelDataModel');
        $plantName= $this->ExcelDataModel->getPlantName($plantId);
        $dailyData = $this->ExcelDataModel->getData($date, $plantId);
        $monthData = $this->ExcelDataModel->getMonthData($date, $plantId);
        $eightHourFormData = $this->ExcelDataModel->getEightHourData($date, $plantId);
        $twoHourFormData = $this->ExcelDataModel->getTwoHourData($date, $plantId);

        
            $data['dailyData'] = $dailyData;
            $data['monthData'] = $monthData;
            $data['eightHourData'] = $eightHourFormData;
            $data['twoHourData'] = $twoHourFormData;
            $data['fileName'] = $date.'-'.$plantName;

            if (!$this->session->userdata('user_id')) {
                redirect('Welcome');
            }
            $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
            $this->output->set_header('Pragma: no-cache');

            $this->load->view('template/header');
            $this->load->view('template/topmenu');
            $this->load->view('template/sidemenu');
            $this->load->view('template/downloadData');
            $this->load->view('template/excelData', $data);
            $this->load->view('template/footer');
            

            

       
    }
}
