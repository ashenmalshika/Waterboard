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

            $this->load->view('template/header');
            $this->load->view('template/topmenu');
            $this->load->view('template/sidemenu');
            $this->load->view('template/downloadData');
            $this->load->view('template/excelData', $data);
            $this->load->view('template/footer');

       
    }
}
