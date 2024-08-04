<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Quality Data Entry</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/userDashboard.css') ?>">
    
</head>
<body>
        <?php
        // Access session data
        $branch_id = $this->session->userdata('branch_id');
        $branch_name = $this->session->userdata('branch_name');
        ?>
    <div class="container">
    <span><a href="javascript:void(0);" class="logout-button" onclick="goBack()">Back</a></span><br>
        <h1>Water Quality Data Entry - <?php echo $sessions->branchName; ?>  </h1>
        
        <form id="dataEntryForm" action="<?php echo site_url('addData'); ?>" method="post">
            <div class="section">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?php echo $sessions->date; ?>" readonly>
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" value="<?php echo $sessions->time; ?>" readonly>
            </div>

            <?php if ($sessions->formNo == 1): ?>
            <div  >
                <div class="section">
                    <h3>Water Quality</h3>
                    <div class="flex-row">
                        <div class="column">
                            <h4>Raw Water</h4>
                            <label for="raw_turbidity">Turbidity (NTU):</label>
                            <input type="number" step="0.01" id="raw_turbidity" name="raw_turbidity" value="<?php echo $sessions->raw_turbidity; ?>" readonly>
                            
                            <label for="raw_ph">pH:</label>
                            <input type="number" step="0.1" id="raw_ph" name="raw_ph" value="<?php echo $sessions->raw_ph; ?>" readonly>
                            
                            <label for="raw_conductivity">Electrical Conductivity (µS/cm):</label>
                            <input type="number" step="0.1" id="raw_conductivity" name="raw_conductivity" value="<?php echo $sessions->raw_conductivity; ?>" readonly>
                            
                            <label for="raw_salinity">Chloride/Salinity (mg/L):</label>
                            <input type="number" step="1" id="raw_salinity" name="raw_salinity" value="<?php echo $sessions->raw_salinity; ?>" readonly>
                            
                            <label for="raw_color">Color (Hazen):</label>
                            <input type="number" step="1" id="raw_color" name="raw_color" value="<?php echo $sessions->raw_color; ?>" readonly>
                            
                            <label for="raw_odor">Odor:</label>
                            <input type="text" id="raw_odor" name="raw_odor" value="<?php echo $sessions->raw_odor; ?>" readonly>
                        </div>
                        <div class="column">
                            <h4>Settling Basin</h4>
                            <label for="settling_rcl">RCL (mg/L):</label>
                            <input type="number" step="0.1" id="settling_rcl" name="settling_rcl" value="<?php echo $sessions->settling_rcl; ?>" readonly>
                            
                            <label for="settling_turbidity">Turbidity (NTU):</label>
                            <input type="number" step="0.01" id="settling_turbidity" name="settling_turbidity" value="<?php echo $sessions->settling_turbidity; ?>" readonly>
                            
                            <label for="settling_ph">pH:</label>
                            <input type="number" step="0.1" id="settling_ph" name="settling_ph" value="<?php echo $sessions->settling_ph; ?>" readonly>
                        </div>
                        <div class="column">
                            <h4>Treated Water</h4>
                            <label for="treated_rcl">RCL (mg/L):</label>
                            <input type="number" step="0.1" id="treated_rcl" name="treated_rcl" value="<?php echo $sessions->treated_rcl; ?>" readonly>
                            
                            <label for="treated_turbidity">Turbidity (NTU):</label>
                            <input type="number" step="0.01" id="treated_turbidity" name="treated_turbidity" value="<?php echo $sessions->treated_turbidity; ?>" readonly>
                            
                            <label for="treated_ph">pH:</label>
                            <input type="number" step="0.1" id="treated_ph" name="treated_ph" value="<?php echo $sessions->treated_ph; ?>" readonly>
                            
                            <label for="treated_conductivity">Electrical Conductivity (µS/cm):</label>
                            <input type="number" step="0.01" id="treated_conductivity" name="treated_conductivity" value="<?php echo $sessions->treated_conductivity; ?>" readonly>
                            
                            <label for="treated_salinity">Chloride/Salinity (mg/L):</label>
                            <input type="number" step="0.1" id="treated_salinity" name="treated_salinity" value="<?php echo $sessions->treated_salinity; ?>" readonly>
                            
                            <label for="treated_color">Color (Hazen):</label>
                            <input type="number" step="1" id="treated_color" name="treated_color" value="<?php echo $sessions->treated_color; ?>" readonly>
                            
                            <label for="treated_odor">Odor:</label>
                            <input type="text" id="treated_odor" name="treated_odor" value="<?php echo $sessions->treated_odor; ?>" readonly>
                            
                            <label for="treated_residual_alum_pacl">Residual Alum/PACl (ppm):</label>
                            <input type="number" step="0.01" id="treated_residual_alum_pacl" name="treated_residual_alum_pacl" value="<?php echo $sessions->treated_residual_alum_pacl; ?>" readonly>
                        </div>
                        <div class="column">
                            <h4>Filter Effluent</h4>
                            <label for="filter_rcl">RCL (mg/L):</label>
                            <input type="number" step="0.1" id="filter_rcl" name="filter_rcl" value="<?php echo $sessions->filter_rcl; ?>" readonly>
                            
                            <label for="filter_turbidity">Turbidity (NTU):</label>
                            <input type="number" step="0.01" id="filter_turbidity" name="filter_turbidity" value="<?php echo $sessions->filter_turbidity; ?>" readonly>
                            
                            <label for="filter_ph">pH:</label>
                            <input type="number" step="0.1" id="filter_ph" name="filter_ph" value="<?php echo $sessions->filter_ph; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($sessions->formNo == 2): ?>
            <div >
                <div class="section">
                    <h3>Production</h3>
                    <!-- Details for Pipe 1 -->
                    <div id="pipe1_details" class="unique-card">
                        <h4>PIPE 1</h4>
                        <div class="unique-column">
                            <div>
                                <h4>Distribution</h4>
                                <label class="unique-label" for="pipe1_distribution_diameter">Diameter:</label>
                                <input class="unique-input" type="number" id="pipe1_distribution_diameter" name="pipe1_distribution_diameter"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe1_distribution_diameter; ?>" readonly>

                                <label class="unique-label" for="pipe1_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe1_bulkmeter_id" name="pipe1_bulkmeter_id" value="<?php echo $sessions->pipe1_bulkmeter_id; ?>" readonly>

                                <label class="unique-label" for="pipe1_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="number" id="pipe1_bulkmeter_reading" name="pipe1_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe1_bulkmeter_reading; ?>" readonly>
                            </div>
                            <div>
                                <h4>Pumping</h4>
                                <label class="unique-label" for="pipe1_pumping_diameter">Diameter:</label>
                                <input class="unique-input" type="number" id="pipe1_pumping_diameter" name="pipe1_pumping_diameter"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe1_pumping_diameter; ?>" readonly>

                                <label class="unique-label" for="pipe1_pumping_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe1_pumping_bulkmeter_id" name="pipe1_pumping_bulkmeter_id" value="<?php echo $sessions->pipe1_pumping_bulkmeter_id; ?>" readonly>

                                <label class="unique-label" for="pipe1_pumping_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="number" id="pipe1_pumping_bulkmeter_reading" name="pipe1_pumping_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe1_pumping_bulkmeter_reading; ?>" readonly>
                            </div>
                            <div>
                                <h4>Raw Water</h4>
                                <label class="unique-label" for="pipe1_raw_diameter">Diameter:</label>
                                <input class="unique-input" type="number" id="pipe1_raw_diameter" name="pipe1_raw_diameter"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe1_raw_diameter; ?>" readonly>

                                <label class="unique-label" for="pipe1_raw_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe1_raw_bulkmeter_id" name="pipe1_raw_bulkmeter_id" value="<?php echo $sessions->pipe1_raw_bulkmeter_id; ?>" readonly>

                                <label class="unique-label" for="pipe1_raw_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="number" id="pipe1_raw_bulkmeter_reading" name="pipe1_raw_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe1_raw_bulkmeter_reading; ?>" readonly>
                            </div>
                        </div>
                    </div>


                    <!-- Details for Pipe 2 -->
                    <div id="pipe2_details" class="unique-card">
                        <h4>PIPE 2</h4>
                        <div class="unique-column">
                            <div>
                                <h4>Distribution</h4>
                                <label class="unique-label" for="pipe2_distribution_diameter">Diameter:</label>
                                <input class="unique-input" type="number" id="pipe2_distribution_diameter" name="pipe2_distribution_diameter"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe2_distribution_diameter; ?>" readonly>

                                <label class="unique-label" for="pipe2_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe2_bulkmeter_id" name="pipe2_bulkmeter_id" value="<?php echo $sessions->pipe2_bulkmeter_id; ?>" readonly>

                                <label class="unique-label" for="pipe2_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="number" id="pipe2_bulkmeter_reading" name="pipe2_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe2_bulkmeter_reading; ?>" readonly>
                            </div>
                            <div>
                                <h4>Pumping</h4>
                                <label class="unique-label" for="pipe2_pumping_diameter">Diameter:</label>
                                <input class="unique-input" type="number" id="pipe2_pumping_diameter" name="pipe2_pumping_diameter"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe2_pumping_diameter; ?>" readonly>

                                <label class="unique-label" for="pipe2_pumping_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe2_pumping_bulkmeter_id" name="pipe2_pumping_bulkmeter_id" value="<?php echo $sessions->pipe2_pumping_bulkmeter_id; ?>" readonly>

                                <label class="unique-label" for="pipe2_pumping_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="number" id="pipe2_pumping_bulkmeter_reading" name="pipe2_pumping_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe2_pumping_bulkmeter_reading; ?>" readonly>
                            </div>
                            <div>
                                <h4>Raw Water</h4>
                                <label class="unique-label" for="pipe2_raw_diameter">Diameter:</label>
                                <input class="unique-input" type="number" id="pipe2_raw_diameter" name="pipe2_raw_diameter"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe2_raw_diameter; ?>" readonly>

                                <label class="unique-label" for="pipe2_raw_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe2_raw_bulkmeter_id" name="pipe2_raw_bulkmeter_id" value="<?php echo $sessions->pipe2_raw_bulkmeter_id; ?>" readonly>

                                <label class="unique-label" for="pipe2_raw_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="number" id="pipe2_raw_bulkmeter_reading" name="pipe2_raw_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe2_raw_bulkmeter_reading; ?>" readonly>
                            </div>
                        </div>
                    </div>


                    <!-- Details for Pipe 3 -->
                    <div id="pipe3_details" class="unique-card">
                        <h4>PIPE 3</h4>
                        <div class="unique-column">
                            <div>
                                <h4>Distribution</h4>
                                <label class="unique-label" for="pipe3_distribution_diameter">Diameter:</label>
                                <input class="unique-input" type="number" id="pipe3_distribution_diameter" name="pipe3_distribution_diameter"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe3_distribution_diameter; ?>" readonly>

                                <label class="unique-label" for="pipe3_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe3_bulkmeter_id" name="pipe3_bulkmeter_id" value="<?php echo $sessions->pipe3_bulkmeter_id; ?>" readonly>

                                <label class="unique-label" for="pipe3_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="number" id="pipe3_bulkmeter_reading" name="pipe3_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe3_bulkmeter_reading; ?>" readonly>
                            </div>
                            <div>
                                <h4>Pumping</h4>
                                <label class="unique-label" for="pipe3_pumping_diameter">Diameter:</label>
                                <input class="unique-input" type="number" id="pipe3_pumping_diameter" name="pipe3_pumping_diameter"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe3_pumping_diameter; ?>" readonly>

                                <label class="unique-label" for="pipe3_pumping_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe3_pumping_bulkmeter_id" name="pipe3_pumping_bulkmeter_id" value="<?php echo $sessions->pipe3_pumping_bulkmeter_id; ?>" readonly>

                                <label class="unique-label" for="pipe3_pumping_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="number" id="pipe3_pumping_bulkmeter_reading" name="pipe3_pumping_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe3_pumping_bulkmeter_reading; ?>" readonly>
                            </div>
                            <div>
                                <h4>Raw Water</h4>
                                <label class="unique-label" for="pipe3_raw_diameter">Diameter:</label>
                                <input class="unique-input" type="number" id="pipe3_raw_diameter" name="pipe3_raw_diameter"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe3_raw_diameter; ?>" readonly>

                                <label class="unique-label" for="pipe3_raw_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe3_raw_bulkmeter_id" name="pipe3_raw_bulkmeter_id" value="<?php echo $sessions->pipe3_raw_bulkmeter_id; ?>" readonly>

                                <label class="unique-label" for="pipe3_raw_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="number" id="pipe3_raw_bulkmeter_reading" name="pipe3_raw_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number" value="<?php echo $sessions->pipe3_raw_bulkmeter_reading; ?>" readonly>
                            </div>
                        </div>
                    </div>

                </div>
        

                <div class="section">
                    <h3>Chemical Dosage (Kg/d)</h3>
                    <label for="alum">Alum:</label>
                    <input type="number" step="0.01" id="alum" name="alum" value="<?php echo $sessions->alum; ?>" readonly>
                    
                    <label for="pacl">PACl:</label>
                    <input type="number" step="0.01" id="pacl" name="pacl" value="<?php echo $sessions->pacl; ?>" readonly>
                    
                    <label for="lime">Lime:</label>
                    <input type="number" step="0.01" id="lime" name="lime" value="<?php echo $sessions->lime; ?>" readonly>
                    
                    <label for="polymer">Polymer:</label>
                    <input type="number" step="0.01" id="polymer" name="polymer" value="<?php echo $sessions->polymer; ?>" readonly>
                    
                    <label for="gas_chlorine">Gas Chlorine:</label>
                    <input type="number" step="0.01" id="gas_chlorine" name="gas_chlorine" value="<?php echo $sessions->gas_chlorine; ?>" readonly>
                    
                    <label for="salt">Salt (Iodine Free):</label>
                    <input type="number" step="0.01" id="salt" name="salt" value="<?php echo $sessions->salt; ?>" readonly>
                    
                    <label for="bleaching_powder">Bleaching Powder:</label>
                    <input type="number" step="0.01" id="bleaching_powder" name="bleaching_powder" value="<?php echo $sessions->bleaching_powder; ?>" readonly>
                </div>

                <div class="section">
                    <h3>Water Quality</h3>
                    <div class="flex-row">
                        <div class="column">
                            <h4>Treated Water</h4>
                            <label for="treated_alum_pacl_jar">Alum/PACl - Jar Test (mg/L):</label>
                            <input type="number" step="0.1" id="treated_alum_pacl_jar" name="treated_alum_pacl_jar" value="<?php echo $sessions->treated_alum_pacl_jar; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($sessions->formNo == 3): ?>
            <div id="monthly" class="section">
                <div class="section">
                    <h3>Power Consumption</h3>
                    <label for="diesel">Diesel (L) :</label>
                    <input type="number" step="0.01" id="diesel" name="diesel" value="<?php echo $sessions->diesel; ?>" readonly>
                    
                    <label for="ceb_reading">CEB Reading :</label>
                    <input type="number" step="1" id="ceb_reading" name="ceb_reading" value="<?php echo $sessions->ceb_reading; ?>" readonly>
                </div>
            </div>
            <?php endif; ?>
        </form>
    </div>

    <script src="<?php echo base_url('assets/javascript/userDashboard.js'); ?>"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>
</html>
