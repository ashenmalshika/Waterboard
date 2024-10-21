<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

    public function get_diesel_data($date,$plantId) {
        $this->db->like('date', $date, 'after'); // Matches 'YYYY-MM%' format
        $this->db->where('formNo', 3); // Matches formNo = 3
        $this->db->where('branchID', $plantId);
        $this->db->order_by('date', 'ASC');
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
    public function get_unit_by_date($year, $plantId) {
        // Set the start and end date for the given year, including December of the previous year
        $startDate = ($year - 1) . '-12-01'; // Start from December of the previous year
        $endDate = ($year + 1) . '-01-01'; // Query till the first day of the next year
        
        // Query to get data for the selected year and surrounding months (December of the previous year and January of the next year)
        $this->db->select('branchName, ceb_reading, date');
        $this->db->from('waterqualitydata');
        $this->db->where('formNo', 3);
        $this->db->where('branchID', $plantId);
        $this->db->where('date >=', $startDate);
        $this->db->where('date <', $endDate); // Query till the first day of the next year
        $this->db->order_by('date', 'ASC'); // Order by date in ascending order
        
        $query = $this->db->get();
        
        // Initialize an array to store data
        $result = array();
        
        // Organize the data by branch and by month
        foreach ($query->result() as $row) {
            $branchName = $row->branchName;
            $cebReading = $row->ceb_reading;
            $date = $row->date;
            
            // Get the month in 'YYYY-MM' format
            $month = substr($date, 0, 7);
    
            // Initialize the branch if not already in the array
            if (!isset($result[$branchName])) {
                $result[$branchName] = array();
            }
    
            // Store the ceb reading for the month
            $result[$branchName][$month] = $cebReading;
        }
    
        // Now calculate the differences between months
        $finalResult = array();
        
        foreach ($result as $branchName => $monthlyData) {
            $months = array_keys($monthlyData); // Get all the months for that branch
    
            for ($i = 1; $i < count($months); $i++) {
                $currentMonth = $months[$i];
                $previousMonth = $months[$i - 1];
                
                // Ensure there are readings for both the current and previous month
                if (isset($monthlyData[$previousMonth]) && isset($monthlyData[$currentMonth]) &&
                    $monthlyData[$previousMonth] != 0 && $monthlyData[$currentMonth] != 0) {
                    
                    // Subtract the previous month's ceb reading from the current month's reading
                    $unitValue = $monthlyData[$currentMonth] - $monthlyData[$previousMonth];
                    
                    // Store the result
                    $finalResult[] = array(
                        'branchName' => $branchName,
                        'month' => $currentMonth,
                        'unitValue' => $unitValue
                    );
                }
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
        $this->db->select('date, raw_turbidity, raw_ph, treated_rcl, treated_turbidity, treated_ph, time');
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
    public function getProductionData($year, $month, $plantId) {
        // Set the start date for the month and the end date as the first day of the next month
        $startDate = $year . '-' . $month . '-01'; // Start from the first day of the selected month
        $endDate = date('Y-m-d', strtotime("+1 month", strtotime($startDate))); // Till the first day of the next month
    
        // Get the last day of the previous month
        $prevMonthLastDay = date('Y-m-d', strtotime($startDate . " -1 day")); // Last day of the previous month
    
        // Query to get data for the selected month, including the last day of the previous month
        $this->db->select('branchName, pipe1_raw_bulkmeter_reading, pipe2_raw_bulkmeter_reading, pipe3_raw_bulkmeter_reading,
            pipe1_pumping_bulkmeter_reading, pipe2_pumping_bulkmeter_reading, pipe3_pumping_bulkmeter_reading,
            pipe1_bulkmeter_reading, pipe2_bulkmeter_reading, pipe3_bulkmeter_reading, date');
        $this->db->from('waterqualitydata');
        $this->db->where('branchID', $plantId);
        $this->db->where('formNo', 2);
        $this->db->where('date >=', $prevMonthLastDay); // Start from the last day of the previous month
        $this->db->where('date <', $endDate); // Till the first day of the next month
        $this->db->order_by('date', 'ASC'); // Order by date in ascending order
    
        $query = $this->db->get();
    
        // Initialize an array to store daily data
        $result = array();
    
        // Organize the data by branch and by day
        foreach ($query->result() as $row) {
            $branchName = $row->branchName;
            $pipe1RawReading = $row->pipe1_raw_bulkmeter_reading;
            $pipe2RawReading = $row->pipe2_raw_bulkmeter_reading;
            $pipe3RawReading = $row->pipe3_raw_bulkmeter_reading;
    
            $pipe1PumpingReading = $row->pipe1_pumping_bulkmeter_reading;
            $pipe2PumpingReading = $row->pipe2_pumping_bulkmeter_reading;
            $pipe3PumpingReading = $row->pipe3_pumping_bulkmeter_reading;
    
            $pipe1DistributionReading = $row->pipe1_bulkmeter_reading;
            $pipe2DistributionReading = $row->pipe2_bulkmeter_reading;
            $pipe3DistributionReading = $row->pipe3_bulkmeter_reading;
    
            $date = $row->date;
    
            // Get the day from the date
            $day = substr($date, 8, 2);
    
            // Initialize the branch if not already in the array
            if (!isset($result[$branchName])) {
                $result[$branchName] = array();
            }
    
            // Store the readings for the day (sum of all three pipes for raw, pumping, and distribution)
            $result[$branchName][$day] = array(
                'pipe1_raw' => $pipe1RawReading,
                'pipe2_raw' => $pipe2RawReading,
                'pipe3_raw' => $pipe3RawReading,
                'raw_total' => $pipe1RawReading + $pipe2RawReading + $pipe3RawReading, // Total raw reading for the day
    
                'pipe1_pumping' => $pipe1PumpingReading,
                'pipe2_pumping' => $pipe2PumpingReading,
                'pipe3_pumping' => $pipe3PumpingReading,
                'pumping_total' => $pipe1PumpingReading + $pipe2PumpingReading + $pipe3PumpingReading, // Total pumping reading for the day
    
                'pipe1_distribution' => $pipe1DistributionReading,
                'pipe2_distribution' => $pipe2DistributionReading,
                'pipe3_distribution' => $pipe3DistributionReading,
                'distribution_total' => $pipe1DistributionReading + $pipe2DistributionReading + $pipe3DistributionReading // Total distribution reading for the day
            );
        }
    
        // Now calculate the differences between days
        $finalResult = array();
    
        foreach ($result as $branchName => $dailyData) {
            $days = array_keys($dailyData); // Get all the days for that branch
    
            // Loop through the days starting from the 1st day of the selected month
            for ($i = 1; $i < count($days); $i++) {
                $currentDay = $days[$i];
                $previousDay = $days[$i - 1];
    
                // Ensure there are readings for both the current and previous day
                if (isset($dailyData[$previousDay]) && isset($dailyData[$currentDay])) {
                    // Subtract the previous day's total reading from the current day's total reading for raw
                    $rawDailyValue = $dailyData[$currentDay]['raw_total'] - $dailyData[$previousDay]['raw_total'];
    
                    // Subtract the previous day's total reading from the current day's total reading for pumping
                    $pumpingDailyValue = $dailyData[$currentDay]['pumping_total'] - $dailyData[$previousDay]['pumping_total'];
    
                    // Subtract the previous day's total reading from the current day's total reading for distribution
                    $distributionDailyValue = $dailyData[$currentDay]['distribution_total'] - $dailyData[$previousDay]['distribution_total'];
    
                    $productionDailyValue=$pumpingDailyValue+$distributionDailyValue;
                    $plantLost=$productionDailyValue-$rawDailyValue;

                    // Store the result
                    $finalResult[] = array(
                        'branchName' => $branchName,
                        'day' => $currentDay,
                        'pipe1_raw' => $dailyData[$currentDay]['pipe1_raw'], // Pipe 1 raw value for the day
                        'pipe2_raw' => $dailyData[$currentDay]['pipe2_raw'], // Pipe 2 raw value for the day
                        'pipe3_raw' => $dailyData[$currentDay]['pipe3_raw'], // Pipe 3 raw value for the day
                        'raw_daily_value' => $rawDailyValue, // Total raw daily value
    
                        'pipe1_pumping' => $dailyData[$currentDay]['pipe1_pumping'], // Pipe 1 pumping value for the day
                        'pipe2_pumping' => $dailyData[$currentDay]['pipe2_pumping'], // Pipe 2 pumping value for the day
                        'pipe3_pumping' => $dailyData[$currentDay]['pipe3_pumping'], // Pipe 3 pumping value for the day
                        'pumping_daily_value' => $pumpingDailyValue, // Total pumping daily value
    
                        'pipe1_distribution' => $dailyData[$currentDay]['pipe1_distribution'], // Pipe 1 distribution value for the day
                        'pipe2_distribution' => $dailyData[$currentDay]['pipe2_distribution'], // Pipe 2 distribution value for the day
                        'pipe3_distribution' => $dailyData[$currentDay]['pipe3_distribution'], // Pipe 3 distribution value for the day
                        'distribution_daily_value' => $distributionDailyValue, // Total distribution daily value

                        "productionDailyValue" =>$productionDailyValue,
                        "plantLost" =>$plantLost
                    );
                }
            }
        }
    
        return $finalResult;
    }
    public function getWaterQualityDataI($year, $month, $plantId) {
        // Step 1: Retrieve all rows for the given year, month, and plant
        $this->db->select('DATE(date) as day, raw_turbidity, raw_ph, treated_rcl, treated_turbidity, treated_ph');
        $this->db->from('waterqualitydata');
        $this->db->where('formNo', 1);
        $this->db->where('branchID', $plantId);
        $this->db->where('YEAR(date)', $year);
        $this->db->where('MONTH(date)', $month);
        $this->db->order_by('DATE(date)', 'ASC');
        
        $query = $this->db->get();
        $results = $query->result_array();
        
        // Step 2: Process the data to calculate daily averages ignoring zero values
        $dailyData = [];
        
        foreach ($results as $row) {
            $day = $row['day'];
            
            // Initialize the day if not already in the array
            if (!isset($dailyData[$day])) {
                $dailyData[$day] = [
                    'raw_turbidity' => [],
                    'raw_ph' => [],
                    'treated_rcl' => [],
                    'treated_turbidity' => [],
                    'treated_ph' => []
                ];
            }
            
            // Add only non-zero values to the corresponding arrays for that day
            if ($row['raw_turbidity'] > 0) {
                $dailyData[$day]['raw_turbidity'][] = $row['raw_turbidity'];
            }
            if ($row['raw_ph'] > 0) {
                $dailyData[$day]['raw_ph'][] = $row['raw_ph'];
            }
            if ($row['treated_rcl'] > 0) {
                $dailyData[$day]['treated_rcl'][] = $row['treated_rcl'];
            }
            if ($row['treated_turbidity'] > 0) {
                $dailyData[$day]['treated_turbidity'][] = $row['treated_turbidity'];
            }
            if ($row['treated_ph'] > 0) {
                $dailyData[$day]['treated_ph'][] = $row['treated_ph'];
            }
        }
        
        // Step 3: Calculate averages for each valid day, ignoring zero values
        $finalData = [];
        
        foreach ($dailyData as $day => $values) {
            // Skip the day if no valid values exist in any field
            if (empty($values['raw_turbidity']) && empty($values['raw_ph']) && empty($values['treated_rcl']) && 
                empty($values['treated_turbidity']) && empty($values['treated_ph'])) {
                continue;
            }
            
            // Calculate averages for fields that have non-zero values
            $finalData[] = [
                'day' => $day,
                'avg_raw_turbidity' => !empty($values['raw_turbidity']) ? array_sum($values['raw_turbidity']) / count($values['raw_turbidity']) : null,
                'avg_raw_ph' => !empty($values['raw_ph']) ? array_sum($values['raw_ph']) / count($values['raw_ph']) : null,
                'avg_treated_rcl' => !empty($values['treated_rcl']) ? array_sum($values['treated_rcl']) / count($values['treated_rcl']) : null,
                'avg_treated_turbidity' => !empty($values['treated_turbidity']) ? array_sum($values['treated_turbidity']) / count($values['treated_turbidity']) : null,
                'avg_treated_ph' => !empty($values['treated_ph']) ? array_sum($values['treated_ph']) / count($values['treated_ph']) : null
            ];
        }
        
        return $finalData;
    }
    public function getWaterQualityDataIm($year, $month, $plantId) {
        // Step 1: Retrieve all rows for the given year, month, and plant
        $this->db->select('DATE(date) as day, raw_turbidity, raw_ph, treated_rcl, treated_turbidity, treated_ph');
        $this->db->from('waterqualitydata');
        $this->db->where('formNo', 1);
        $this->db->where('branchID', $plantId);
        $this->db->where('YEAR(date)', $year);
        $this->db->where('MONTH(date)', $month);
        $this->db->order_by('DATE(date)', 'ASC');
        
        $query = $this->db->get();
        $results = $query->result_array();
    
        // Step 2: Process the results to prepare the final array
        $finalData = [];
    
        foreach ($results as $row) {
            // Check if any value is zero
            if ($row['raw_turbidity'] > 0 && $row['raw_ph'] > 0 && 
                $row['treated_rcl'] > 0 && $row['treated_turbidity'] > 0 && 
                $row['treated_ph'] > 0) {
    
                $day = $row['day'];
                
                // Initialize the day if not already in the array
                if (!isset($finalData[$day])) {
                    $finalData[$day] = [
                        'raw_turbidity' => [],
                        'raw_ph' => [],
                        'treated_rcl' => [],
                        'treated_turbidity' => [],
                        'treated_ph' => []
                    ];
                }
                
                // Store values directly into the corresponding arrays for that day
                $finalData[$day]['raw_turbidity'][] = $row['raw_turbidity'];
                $finalData[$day]['raw_ph'][] = $row['raw_ph'];
                $finalData[$day]['treated_rcl'][] = $row['treated_rcl'];
                $finalData[$day]['treated_turbidity'][] = $row['treated_turbidity'];
                $finalData[$day]['treated_ph'][] = $row['treated_ph'];
            }
        }
    
        // Step 3: Calculate averages for each day
        $averagedData = [];
        
        foreach ($finalData as $day => $values) {
            // Only calculate averages if there are multiple entries
            if (count($values['raw_turbidity']) > 0) {
                $averagedData[$day] = [
                  'avg_raw_turbidity' => floor(array_sum($values['raw_turbidity']) / count($values['raw_turbidity']) * 100) / 100,
                    'avg_raw_ph' => floor(array_sum($values['raw_ph']) / count($values['raw_ph']) * 100) / 100,
                    'avg_treated_rcl' => floor(array_sum($values['treated_rcl']) / count($values['treated_rcl']) * 100) / 100,
                    'avg_treated_turbidity' => floor(array_sum($values['treated_turbidity']) / count($values['treated_turbidity']) * 100) / 100,
                    'avg_treated_ph' => floor(array_sum($values['treated_ph']) / count($values['treated_ph']) * 100) / 100,
                ];
            }
        }
    
        return $averagedData; // Return the array with daily averages
    }
    
    
    
    
}
