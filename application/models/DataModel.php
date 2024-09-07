<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

    public function get_data_by_date($date) {
        $this->db->like('date', $date, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 3); // Matches formNo = 3
        $query = $this->db->get('waterqualitydata');
        return $query->result();
    }
    public function get_unit($date) {
        // Set current and previous month in 'YYYY-MM' format
        $currentMonth = $date;
        $previousMonth = date('Y-m', strtotime("-1 month", strtotime($currentMonth)));
    
        // Query to get data within the date range
        $this->db->select('branchName, ceb_reading, date');
        $this->db->from('waterqualitydata');
        $this->db->where('date >=', $previousMonth . '-01');
        $this->db->where('date <=', date("Y-m-t", strtotime($currentMonth))); // Get last day of the month
        $this->db->order_by('branchName, date');
    
        $query = $this->db->get();
    
        $result = array();
        foreach ($query->result() as $row) {
            $branchName = $row->branchName;
            $cebReading = $row->ceb_reading;
            $date = $row->date;
    
            if (!isset($result[$branchName])) {
                $result[$branchName] = array(
                    'current' => null,
                    'previous' => null,
                );
            }
    
            if (substr($date, 0, 7) == $currentMonth) {
                $result[$branchName]['current'] = $cebReading;
            } elseif (substr($date, 0, 7) == $previousMonth) {
                $result[$branchName]['previous'] = $cebReading;
            }
        }
    
        $finalResult = array();
        foreach ($result as $branchName => $readings) {
            if ($readings['current'] !== null && $readings['previous'] !== null) {
                $unitValue = $readings['current'] - $readings['previous'];
                $finalResult[] = array(
                    'branchName' => $branchName,
                    'unitValue' => $unitValue,
                );
            }
        }
    
        return $finalResult;
    }
    public function get_unit_by_date($date) {
        // Set current and previous month in 'YYYY-MM' format
        $currentMonth = $date;
        $previousMonth = date('Y-m', strtotime("-1 month", strtotime($currentMonth)));
    
        // Query to get data within the date range
        $this->db->select('branchName, ceb_reading, date');
        $this->db->from('waterqualitydata');
        $this->db->where('date >=', $previousMonth . '-01');
        $this->db->where('date <=', date("Y-m-t", strtotime($currentMonth))); // Get last day of the month
        $this->db->order_by('branchName, date');
    
        $query = $this->db->get();
    
        $result = array();
        foreach ($query->result() as $row) {
            $branchName = $row->branchName;
            $cebReading = $row->ceb_reading;
            $date = $row->date;
    
            if (!isset($result[$branchName])) {
                $result[$branchName] = array(
                    'current' => null,
                    'previous' => null,
                );
            }
    
            if (substr($date, 0, 7) == $currentMonth) {
                $result[$branchName]['current'] = $cebReading;
            } elseif (substr($date, 0, 7) == $previousMonth) {
                $result[$branchName]['previous'] = $cebReading;
            }
        }
    
        $finalResult = array();
        foreach ($result as $branchName => $readings) {
            if ($readings['current'] !== null && $readings['current'] != 0 &&
                $readings['previous'] !== null && $readings['previous'] != 0) {
                $unitValue = $readings['current'] - $readings['previous'];
                $finalResult[] = array(
                    'branchName' => $branchName,
                    'unitValue' => $unitValue,
                );
            }
        }
    
        return $finalResult;
    }
    public function getChemicalUsage($date, $plantId) {
        $this->db->select('date, alum, pacl, lime, polymer, gas_chlorine, salt, bleaching_powder');
        $this->db->like('date', $date, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 2); // Matches formNo = 2
        $this->db->where('branchID', $plantId);
        $query = $this->db->get('waterqualitydata');
        return $query->result();
    }
    public function raw_water_turbidity($date, $plantId) {
        $this->db->select('date, raw_turbidity, time');
        $this->db->from('waterqualitydata');
        $this->db->where('formNo', 1);
        $this->db->where('date', $date); // Assuming the 'date' field is in 'YYYY-MM-DD' format
        $this->db->where('branchID', $plantId);
    
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function jar_data($date) {
        $this->db->select('branchName, treated_alum_pacl_jar');
        $this->db->like('date', $date, 'after');
        $this->db->where('formNo', 2);
        $query = $this->db->get('waterqualitydata');
        return $query->result();
    }
    
}
