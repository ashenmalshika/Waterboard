<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExcelDataModel extends CI_Model {
    public function getData($date, $plantId){
        $this->db->like('date', $date, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 2);
        $this->db->where('branchID', $plantId);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get('waterqualitydata');
        return $query->result();
    }
    public function getMonthData($date, $plantId){
        $this->db->like('date', $date, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 3);
        $this->db->where('branchID', $plantId);
        $query = $this->db->get('waterqualitydata');
        return $query->result(); 
    }
    public function getEightHourData($date, $plantId){
        $this->db->like('date', $date, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 4);
        $this->db->where('branchID', $plantId);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get('waterqualitydata');
        return $query->result(); 
    }
    public function getTwoHourData($date, $plantId){
        $this->db->like('date', $date, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 1);
        $this->db->where('branchID', $plantId);
        $this->db->order_by('date', 'ASC');
        $this->db->order_by('time', 'ASC');
        $query = $this->db->get('waterqualitydata');
        return $query->result(); 
    }
    public function getPlantName($plantId) {
        // Select the 'branchName' field
        $this->db->select('branchName');
        $this->db->where('branchID', $plantId);
        
        // Execute the query and fetch the result
        $query = $this->db->get('users');
        
        // Check if any row is returned
        if ($query->num_rows() > 0) {
            // Return the 'branchName' field as a string
            return $query->row()->branchName;
        } else {
            // Return a default value or error message if no result found
            return null;
        }
    }
    
}