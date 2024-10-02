<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JarTestModel extends CI_Model {
    public function getActualData($year, $month, $plantId) {
        // Set the start and end dates for the month
        $startDate = $year . '-' . $month . '-01';
        $endDate = date('Y-m-d', strtotime("+1 month", strtotime($startDate)));
    
        // Get the last day of the previous month
        $prevMonthLastDay = date('Y-m-d', strtotime($startDate . " -1 day"));
    
        // Query to get data for the selected month, including the last day of the previous month
        $this->db->select('branchName, pipe1_raw_bulkmeter_reading, pipe2_raw_bulkmeter_reading, pipe3_raw_bulkmeter_reading, alum, pacl, date');
        $this->db->from('waterqualitydata');
        $this->db->where('branchID', $plantId);
        $this->db->where('formNo', 2);
        $this->db->where('date >=', $prevMonthLastDay);
        $this->db->where('date <', $endDate);
        $this->db->order_by('date', 'ASC');
    
        $query = $this->db->get();
        $result = [];
    
        foreach ($query->result() as $row) {
            $branchName = $row->branchName;
            $pipe1Raw = $row->pipe1_raw_bulkmeter_reading;
            $pipe2Raw = $row->pipe2_raw_bulkmeter_reading;
            $pipe3Raw = $row->pipe3_raw_bulkmeter_reading;
            $date = $row->date;
            $day = substr($date, 8, 2);
    
            if (!isset($result[$branchName])) {
                $result[$branchName] = [];
            }
    
            $result[$branchName][$day] = [
                'pipe1_raw' => $pipe1Raw,
                'pipe2_raw' => $pipe2Raw,
                'pipe3_raw' => $pipe3Raw,
                'raw_total' => $pipe1Raw + $pipe2Raw + $pipe3Raw,
                'alum' => $row->alum,
                'pacl' => $row->pacl
            ];
        }
    
        // Fetch jar test data using the separate method
        $jarTestData = $this->getJarTestData($year, $month, $plantId);
    
        // Calculate daily differences
        $finalResult = [];
    
        foreach ($result as $branchName => $dailyData) {
            $days = array_keys($dailyData);
    
            for ($i = 1; $i < count($days); $i++) {
                $currentDay = $days[$i];
                $previousDay = $days[$i - 1];
    
                if (isset($dailyData[$previousDay]) && isset($dailyData[$currentDay])) {
                    $rawDailyValue = $dailyData[$currentDay]['raw_total'] - $dailyData[$previousDay]['raw_total'];
    
                    $alum = $dailyData[$currentDay]['alum'];
                    $pacl = $dailyData[$currentDay]['pacl'];
                    $actualAlum = ($alum > 0 && $rawDailyValue > 0) ? ($alum / $rawDailyValue) * 1000 : null;
                    $actualPACL = ($pacl > 0 && $rawDailyValue > 0) ? ($pacl / $rawDailyValue) * 1000 : null;
    
                    // Get the jar test value from the jarTestData array
                    $jarTestValue = isset($jarTestData[$currentDay]) ? $jarTestData[$currentDay] : null;
    
                    $finalResult[] = [
                        'branchName' => $branchName,
                        'day' => $currentDay,
                        'pipe1_raw' => $dailyData[$currentDay]['pipe1_raw'],
                        'pipe2_raw' => $dailyData[$currentDay]['pipe2_raw'],
                        'pipe3_raw' => $dailyData[$currentDay]['pipe3_raw'],
                        'raw_daily_value' => $rawDailyValue,
                        'alum' => $alum,
                        'pacl' => $pacl,
                        'jar_test' => $jarTestValue, // Include jar test value
                        'actual_alum' => $actualAlum,
                        'actual_pacl' => $actualPACL
                    ];
                }
            }
        }
    
        return $finalResult;
    }
    
    // Separate method to get jar test data
    public function getJarTestData($year, $month, $plantId) {
        $startDate = $year . '-' . $month . '-01';
        $endDate = date('Y-m-d', strtotime("+1 month", strtotime($startDate)));
        $prevMonthLastDay = date('Y-m-d', strtotime($startDate . " -1 day"));
    
        $this->db->select('treated_alum_pacl_jar1, date');
        $this->db->from('waterqualitydata');
        $this->db->where('branchID', $plantId);
        $this->db->where('formNo', 4);
        $this->db->where('date >=', $prevMonthLastDay);
        $this->db->where('date <', $endDate);
        $this->db->order_by('date', 'ASC');
    
        $query = $this->db->get();
        $jarTestData = [];
    
        foreach ($query->result() as $row) {
            $date = $row->date;
            $day = substr($date, 8, 2);
            $jarTestData[$day] = $row->treated_alum_pacl_jar1;
        }
    
        return $jarTestData;
    }
    
    

}