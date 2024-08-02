<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Quality Data Entry</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/userDashboard.css') ?>">
</head>
<body>
    <div class="container">
        <span><a href="<?php echo base_url('logout'); ?>" class="logout-button">Logout</a></span><br>
        <h1>Water Quality Data Entry</h1>
        <?php if ($this->session->flashdata('success')): ?>
            <p class="message success"><?php echo $this->session->flashdata('success'); ?></p>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <p class="message error"><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>
        <div class="validation-errors">
            <?php echo validation_errors(); ?>
        </div>
        <form id="dataEntryForm" action="<?php echo site_url('addData'); ?>" method="post">
            <div class="section">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>
            </div>

            <div class="button-container">
                <button type="button" id="btn-2hour" class="form-selection-button" onclick="showSection('2hour', this)">2 Hour Form</button>
                <button type="button" id="btn-daily" class="form-selection-button" onclick="showSection('daily', this)">Per Day Form</button>
                <button type="button" id="btn-monthly" class="form-selection-button" onclick="showSection('monthly', this)">Per Month Form</button>
            </div>

            <div id="2hour" class="section hidden">
                <div class="section">
                    <h3>Water Quality</h3>
                    <div class="flex-row">
                        <div class="column">
                            <h4>Raw Water</h4>
                            <label for="raw_turbidity">Turbidity (NTU):</label>
                            <input type="number" step="0.01" id="raw_turbidity" name="raw_turbidity" >
                            
                            <label for="raw_ph">pH:</label>
                            <input type="number" step="0.1" id="raw_ph" name="raw_ph" >
                            
                            <label for="raw_conductivity">Electrical Conductivity (µS/cm):</label>
                            <input type="number" step="0.1" id="raw_conductivity" name="raw_conductivity" >
                            
                            <label for="raw_salinity">Chloride/Salinity (mg/L):</label>
                            <input type="number" step="1" id="raw_salinity" name="raw_salinity" >
                            
                            <label for="raw_color">Color (Hazen):</label>
                            <input type="number" step="1" id="raw_color" name="raw_color" >
                            
                            <label for="raw_odor">Odor:</label>
                            <input type="text" id="raw_odor" name="raw_odor" >
                        </div>
                        <div class="column">
                            <h4>Settling Basin</h4>
                            <label for="settling_rcl">RCL (mg/L):</label>
                            <input type="number" step="0.1" id="settling_rcl" name="settling_rcl" >
                            
                            <label for="settling_turbidity">Turbidity (NTU):</label>
                            <input type="number" step="0.01" id="settling_turbidity" name="settling_turbidity" >
                            
                            <label for="settling_ph">pH:</label>
                            <input type="number" step="0.1" id="settling_ph" name="settling_ph" >
                        </div>
                        <div class="column">
                            <h4>Treated Water</h4>
                            <label for="treated_rcl">RCL (mg/L):</label>
                            <input type="number" step="0.1" id="treated_rcl" name="treated_rcl" >
                            
                            <label for="treated_turbidity">Turbidity (NTU):</label>
                            <input type="number" step="0.01" id="treated_turbidity" name="treated_turbidity" >
                            
                            <label for="treated_ph">pH:</label>
                            <input type="number" step="0.1" id="treated_ph" name="treated_ph" >
                            
                            <label for="treated_conductivity">Electrical Conductivity (µS/cm):</label>
                            <input type="number" step="0.01" id="treated_conductivity" name="treated_conductivity" >
                            
                            <label for="treated_salinity">Chloride/Salinity (mg/L):</label>
                            <input type="number" step="0.1" id="treated_salinity" name="treated_salinity" >
                            
                            <label for="treated_color">Color (Hazen):</label>
                            <input type="number" step="1" id="treated_color" name="treated_color" >
                            
                            <label for="treated_odor">Odor:</label>
                            <input type="text" id="treated_odor" name="treated_odor" >
                            
                            <label for="treated_residual_alum_pacl">Residual Alum/PACl (ppm):</label>
                            <input type="number" step="0.01" id="treated_residual_alum_pacl" name="treated_residual_alum_pacl" >
                        </div>
                        <div class="column">
                            <h4>Filter Effluent</h4>
                            <label for="filter_rcl">RCL (mg/L):</label>
                            <input type="number" step="0.1" id="filter_rcl" name="filter_rcl" >
                            
                            <label for="filter_turbidity">Turbidity (NTU):</label>
                            <input type="number" step="0.01" id="filter_turbidity" name="filter_turbidity" >
                            
                            <label for="filter_ph">pH:</label>
                            <input type="number" step="0.1" id="filter_ph" name="filter_ph" >
                        </div>
                    </div>
                </div>
            </div>

            <div id="daily" class="section hidden">
                <div class="section">
                    <h3>Production</h3>
                    <div>Select number of Pipes :
                        <div>
                            <button type="button" id="btn_one_pipe" class="form-selection-button" onclick="updatePipeVisibility(1)">One</button>
                            <button type="button" id="btn_two_pipes" class="form-selection-button" onclick="updatePipeVisibility(2)">Two</button>
                            <button type="button" id="btn_three_pipes" class="form-selection-button" onclick="updatePipeVisibility(3)">Three</button>
                        </div>
                    </div>
                    <!-- Details for Pipe 1 -->
                    <div id="pipe1_details" class="unique-card hidden">
                        <h4>PIPE 1</h4>
                        <div class="unique-column">
                            <div>
                                <h4>Distribution</h4>
                                <label class="unique-label" for="pipe1_distribution_diameter">Diameter:</label>
                                <input class="unique-input" type="text" id="pipe1_distribution_diameter" name="pipe1_distribution_diameter"  pattern="\d+" title="Please enter a whole number">

                                <label class="unique-label" for="pipe1_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe1_bulkmeter_id" name="pipe1_bulkmeter_id" >

                                <label class="unique-label" for="pipe1_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="text" id="pipe1_bulkmeter_reading" name="pipe1_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                            </div>
                            <div>
                                <h4>Pumping</h4>
                                <label class="unique-label" for="pipe1_pumping_diameter">Diameter:</label>
                                <input class="unique-input" type="text" id="pipe1_pumping_diameter" name="pipe1_pumping_diameter"  pattern="\d+" title="Please enter a whole number">

                                <label class="unique-label" for="pipe1_pumping_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe1_pumping_bulkmeter_id" name="pipe1_pumping_bulkmeter_id" >

                                <label class="unique-label" for="pipe1_pumping_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="text" id="pipe1_pumping_bulkmeter_reading" name="pipe1_pumping_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                            </div>
                            <div>
                                <h4>Raw Water</h4>
                                <label class="unique-label" for="pipe1_raw_diameter">Diameter:</label>
                                <input class="unique-input" type="text" id="pipe1_raw_diameter" name="pipe1_raw_diameter"  pattern="\d+" title="Please enter a whole number">

                                <label class="unique-label" for="pipe1_raw_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe1_raw_bulkmeter_id" name="pipe1_raw_bulkmeter_id" >

                                <label class="unique-label" for="pipe1_raw_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="text" id="pipe1_raw_bulkmeter_reading" name="pipe1_raw_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                            </div>
                        </div>
                    </div>


                    <!-- Details for Pipe 2 -->
                    <div id="pipe2_details" class="unique-card hidden">
                        <h4>PIPE 2</h4>
                        <div class="unique-column">
                            <div>
                                <h4>Distribution</h4>
                                <label class="unique-label" for="pipe2_distribution_diameter">Diameter:</label>
                                <input class="unique-input" type="text" id="pipe2_distribution_diameter" name="pipe2_distribution_diameter"  pattern="\d+" title="Please enter a whole number">

                                <label class="unique-label" for="pipe2_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe2_bulkmeter_id" name="pipe2_bulkmeter_id" >

                                <label class="unique-label" for="pipe2_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="text" id="pipe2_bulkmeter_reading" name="pipe2_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                            </div>
                            <div>
                                <h4>Pumping</h4>
                                <label class="unique-label" for="pipe2_pumping_diameter">Diameter:</label>
                                <input class="unique-input" type="text" id="pipe2_pumping_diameter" name="pipe2_pumping_diameter"  pattern="\d+" title="Please enter a whole number">

                                <label class="unique-label" for="pipe2_pumping_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe2_pumping_bulkmeter_id" name="pipe2_pumping_bulkmeter_id" >

                                <label class="unique-label" for="pipe2_pumping_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="text" id="pipe2_pumping_bulkmeter_reading" name="pipe2_pumping_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                            </div>
                            <div>
                                <h4>Raw Water</h4>
                                <label class="unique-label" for="pipe2_raw_diameter">Diameter:</label>
                                <input class="unique-input" type="text" id="pipe2_raw_diameter" name="pipe2_raw_diameter"  pattern="\d+" title="Please enter a whole number">

                                <label class="unique-label" for="pipe2_raw_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe2_raw_bulkmeter_id" name="pipe2_raw_bulkmeter_id" >

                                <label class="unique-label" for="pipe2_raw_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="text" id="pipe2_raw_bulkmeter_reading" name="pipe2_raw_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                            </div>
                        </div>
                    </div>


                    <!-- Details for Pipe 3 -->
                    <div id="pipe3_details" class="unique-card hidden">
                        <h4>PIPE 3</h4>
                        <div class="unique-column">
                            <div>
                                <h4>Distribution</h4>
                                <label class="unique-label" for="pipe3_distribution_diameter">Diameter:</label>
                                <input class="unique-input" type="text" id="pipe3_distribution_diameter" name="pipe3_distribution_diameter"  pattern="\d+" title="Please enter a whole number">

                                <label class="unique-label" for="pipe3_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe3_bulkmeter_id" name="pipe3_bulkmeter_id" >

                                <label class="unique-label" for="pipe3_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="text" id="pipe3_bulkmeter_reading" name="pipe3_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                            </div>
                            <div>
                                <h4>Pumping</h4>
                                <label class="unique-label" for="pipe3_pumping_diameter">Diameter:</label>
                                <input class="unique-input" type="text" id="pipe3_pumping_diameter" name="pipe3_pumping_diameter"  pattern="\d+" title="Please enter a whole number">

                                <label class="unique-label" for="pipe3_pumping_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe3_pumping_bulkmeter_id" name="pipe3_pumping_bulkmeter_id" >

                                <label class="unique-label" for="pipe3_pumping_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="text" id="pipe3_pumping_bulkmeter_reading" name="pipe3_pumping_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                            </div>
                            <div>
                                <h4>Raw Water</h4>
                                <label class="unique-label" for="pipe3_raw_diameter">Diameter:</label>
                                <input class="unique-input" type="text" id="pipe3_raw_diameter" name="pipe3_raw_diameter"  pattern="\d+" title="Please enter a whole number">

                                <label class="unique-label" for="pipe3_raw_bulkmeter_id">Bulk Meter ID:</label>
                                <input class="unique-input" type="text" id="pipe3_raw_bulkmeter_id" name="pipe3_raw_bulkmeter_id" >

                                <label class="unique-label" for="pipe3_raw_bulkmeter_reading">Bulk Meter Reading:</label>
                                <input class="unique-input" type="text" id="pipe3_raw_bulkmeter_reading" name="pipe3_raw_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                            </div>
                        </div>
                    </div>

                </div>
        

                <div class="section">
                    <h3>Chemical Dosage (Kg/d)</h3>
                    <label for="alum">Alum:</label>
                    <input type="number" step="0.01" id="alum" name="alum" >
                    
                    <label for="pacl">PACl:</label>
                    <input type="number" step="0.01" id="pacl" name="pacl" >
                    
                    <label for="lime">Lime:</label>
                    <input type="number" step="0.01" id="lime" name="lime" >
                    
                    <label for="polymer">Polymer:</label>
                    <input type="number" step="0.01" id="polymer" name="polymer" >
                    
                    <label for="gas_chlorine">Gas Chlorine:</label>
                    <input type="number" step="0.01" id="gas_chlorine" name="gas_chlorine" >
                    
                    <label for="salt">Salt (Iodine Free):</label>
                    <input type="number" step="0.01" id="salt" name="salt" >
                    
                    <label for="bleaching_powder">Bleaching Powder:</label>
                    <input type="number" step="0.01" id="bleaching_powder" name="bleaching_powder" >
                </div>

                <div class="section">
                    <h3>Water Quality</h3>
                    <div class="flex-row">
                        <div class="column">
                            <h4>Treated Water</h4>
                            <label for="treated_alum_pacl_jar">Alum/PACl - Jar Test (mg/L):</label>
                            <input type="number" step="0.1" id="treated_alum_pacl_jar" name="treated_alum_pacl_jar" >
                        </div>
                    </div>
                </div>
            </div>

            <div id="monthly" class="section hidden">
                <div class="section">
                    <h3>Power Consumption</h3>
                    <label for="diesel">Diesel (L) :</label>
                    <input type="number" step="0.01" id="diesel" name="diesel" >
                    
                    <label for="ceb_reading">CEB Reading :</label>
                    <input type="number" step="1" id="ceb_reading" name="ceb_reading" >
                </div>
            </div>

            <div class="button-container hidden" id="submit-container">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script src="<?php echo base_url('assets/javascript/userDashboard.js'); ?>"></script>

</body>
</html>
