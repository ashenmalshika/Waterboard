<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

    public function get_data_by_date($date) {
        $this->db->like('date', $date, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 3); // Matches formNo = 3
        $query = $this->db->get('waterqualitydata');
        return $query->result();
    }
    public function get_unit_by_date($date) {
        // Parse the date to extract the year and month
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
    
        // Prepare the current month date in 'YYYY-MM' format
        $currentMonth = "$year-$month";
    
        // Prepare the previous month date in 'YYYY-MM' format
        $previousMonth = date('Y-m', strtotime("-1 month", strtotime($currentMonth)));
    
        // Query to sum the cebreading value for the current month
        $this->db->select_sum('cebreading');
        $this->db->like('date', $currentMonth, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 3); // Assuming formNo = 3 is a condition
        $currentQuery = $this->db->get('waterqualitydata');
        $currentResult = $currentQuery->row();
    
        // Query to sum the cebreading value for the previous month
        $this->db->select_sum('cebreading');
        $this->db->like('date', $previousMonth, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 3); // Assuming formNo = 3 is a condition
        $previousQuery = $this->db->get('waterqualitydata');
        $previousResult = $previousQuery->row();
    
        // Check if both values are available
        if ($currentResult && $previousResult) {
            $currentReading = $currentResult->cebreading;
            $previousReading = $previousResult->cebreading;
    
            // Calculate the unit value (difference between current and previous month readings)
            $unitValue = $currentReading - $previousReading;
    
            return $unitValue;
        } else {
            // Handle the case where data is missing for either month
            return null; // Or return 0, an error message, or handle it as needed
        }
    }
    
}
