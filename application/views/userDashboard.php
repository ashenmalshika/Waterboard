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
                        <input type="number" step="0.01" id="raw_turbidity" name="raw_turbidity" required>
                        
                        <label for="raw_ph">pH:</label>
                        <input type="number" step="0.1" id="raw_ph" name="raw_ph" required>
                        
                        <label for="raw_conductivity">Electrical Conductivity (µS/cm):</label>
                        <input type="number" step="0.1" id="raw_conductivity" name="raw_conductivity" required>
                        
                        <label for="raw_salinity">Chloride/Salinity (mg/L):</label>
                        <input type="number" step="1" id="raw_salinity" name="raw_salinity" required>
                        
                        <label for="raw_color">Color (Hazen):</label>
                        <input type="number" step="1" id="raw_color" name="raw_color" required>
                        
                        <label for="raw_odor">Odor:</label>
                        <input type="text" id="raw_odor" name="raw_odor" required>
                    </div>
                    <div class="column">
                        <h4>Settling Basin</h4>
                        <label for="settling_rcl">RCL (mg/L):</label>
                        <input type="number" step="0.1" id="settling_rcl" name="settling_rcl" required>
                        
                        <label for="settling_turbidity">Turbidity (NTU):</label>
                        <input type="number" step="0.01" id="settling_turbidity" name="settling_turbidity" required>
                        
                        <label for="settling_ph">pH:</label>
                        <input type="number" step="0.1" id="settling_ph" name="settling_ph" required>
                    </div>
                    <div class="column">
                        <h4>Treated Water</h4>
                        <label for="treated_rcl">RCL (mg/L):</label>
                        <input type="number" step="0.1" id="treated_rcl" name="treated_rcl" required>
                        
                        <label for="treated_turbidity">Turbidity (NTU):</label>
                        <input type="number" step="0.01" id="treated_turbidity" name="treated_turbidity" required>
                        
                        <label for="treated_ph">pH:</label>
                        <input type="number" step="0.1" id="treated_ph" name="treated_ph" required>
                        
                        <label for="treated_conductivity">Electrical Conductivity (µS/cm):</label>
                        <input type="number" step="0.01" id="treated_conductivity" name="treated_conductivity" required>
                        
                        <label for="treated_salinity">Chloride/Salinity (mg/L):</label>
                        <input type="number" step="0.1" id="treated_salinity" name="treated_salinity" required>
                        
                        <label for="treated_color">Color (Hazen):</label>
                        <input type="number" step="1" id="treated_color" name="treated_color" required>
                        
                        <label for="treated_odor">Odor:</label>
                        <input type="text" id="treated_odor" name="treated_odor" required>
                        
                        <label for="treated_residual_alum_pacl">Residual Alum/PACl (ppm):</label>
                        <input type="number" step="0.01" id="treated_residual_alum_pacl" name="treated_residual_alum_pacl" required>
                    </div>
                    <div class="column">
                        <h4>Filter Effluent</h4>
                        <label for="filter_rcl">RCL (mg/L):</label>
                        <input type="number" step="0.1" id="filter_rcl" name="filter_rcl" required>
                        
                        <label for="filter_turbidity">Turbidity (NTU):</label>
                        <input type="number" step="0.01" id="filter_turbidity" name="filter_turbidity" required>
                        
                        <label for="filter_ph">pH:</label>
                        <input type="number" step="0.1" id="filter_ph" name="filter_ph" required>
                    </div>
                </div>
            </div>
            </div>

            <div id="daily" class="section hidden">
                <div class="section">
                    <h3>Production</h3>
                    <h4>Distribution</h4>
                    <label for="distribution_diameter">Diameter :</label>
                    <input type="text" id="distribution_diameter" name="distribution_diameter" required pattern="\d+" title="Please enter a whole number">

                    <label for="bulkmeter_id">Bulk Meter ID :</label>
                    <input type="text" id="bulkmeter_id" name="bulkmeter_id" required>

                    <label for="bulkmeter_reading">Bulk Meter Reading :</label>
                    <input type="text" id="bulkmeter_reading" name="bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
                </div>

                <div class="section">
                    <h4>Pumping</h4>
                    <label for="pumping_diameter">Diameter :</label>
                    <input type="text" id="pumping_diameter" name="pumping_diameter" required pattern="\d+" title="Please enter a whole number">

                    <label for="pumping_bulkmeter_id">Bulk Meter ID :</label>
                    <input type="text" id="pumping_bulkmeter_id" name="pumping_bulkmeter_id" required>

                    <label for="pumping_bulkmeter_reading">Bulk Meter Reading :</label>
                    <input type="text" id="pumping_bulkmeter_reading" name="pumping_bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
                </div>

                <div class="section">
                    <h4>Raw Water</h4>
                    <label for="raw_diameter">Diameter :</label>
                    <input type="text" id="raw_diameter" name="raw_diameter" required pattern="\d+" title="Please enter a whole number">

                    <label for="raw_bulkmeter_id">Bulk Meter ID :</label>
                    <input type="text" id="raw_bulkmeter_id" name="raw_bulkmeter_id" required>

                    <label for="raw_bulkmeter_reading">Bulk Meter Reading :</label>
                    <input type="text" id="raw_bulkmeter_reading" name="raw_bulkmeter_reading" required pattern="\d+" title="Please enter a whole number">
                </div>

                <div class="section">
                    <h3>Chemical Dosage (Kg/d)</h3>
                    <label for="alum">Alum:</label>
                    <input type="number" step="0.01" id="alum" name="alum" required>
                    
                    <label for="pacl">PACl:</label>
                    <input type="number" step="0.01" id="pacl" name="pacl" required>
                    
                    <label for="lime">Lime:</label>
                    <input type="number" step="0.01" id="lime" name="lime" required>
                    
                    <label for="polymer">Polymer:</label>
                    <input type="number" step="0.01" id="polymer" name="polymer" required>
                    
                    <label for="gas_chlorine">Gas Chlorine:</label>
                    <input type="number" step="0.01" id="gas_chlorine" name="gas_chlorine" required>
                    
                    <label for="salt">Salt (Iodine Free):</label>
                    <input type="number" step="0.01" id="salt" name="salt" required>
                    
                    <label for="bleaching_powder">Bleaching Powder:</label>
                    <input type="number" step="0.01" id="bleaching_powder" name="bleaching_powder" required>
                </div>

                <div class="section">
                    <h3>Water Quality</h3>
                    <div class="flex-row">
                        <div class="column">
                            <h4>Treated Water</h4>
                            <label for="treated_alum_pacl_jar">Alum/PACl - Jar Test (mg/L):</label>
                            <input type="number" step="0.1" id="treated_alum_pacl_jar" name="treated_alum_pacl_jar" required>
                        </div>
                    </div>
                </div>
            </div>

            <div id="monthly" class="section hidden">
                <div class="section">
                    <h3>Power Consumption</h3>
                    <label for="diesel">Diesel (L) :</label>
                    <input type="number" step="0.01" id="diesel" name="diesel" required>
                    
                    <label for="ceb_reading">CEB Reading :</label>
                    <input type="number" step="1" id="ceb_reading" name="ceb_reading" required>
                </div>
            </div>

            <div class="button-container hidden" id="submit-container">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        function showSection(sectionId, btn) {
            // Hide all sections
            document.getElementById('2hour').classList.add('hidden');
            document.getElementById('daily').classList.add('hidden');
            document.getElementById('monthly').classList.add('hidden');
            // Show the selected section
            document.getElementById(sectionId).classList.remove('hidden');

            // Reset button colors
            document.getElementById('btn-2hour').classList.remove('active');
            document.getElementById('btn-daily').classList.remove('active');
            document.getElementById('btn-monthly').classList.remove('active');

            // Set the clicked button to active (green)
            btn.classList.add('active');

            // Show the submit button
            document.getElementById('submit-container').classList.remove('hidden');
        }
    </script>
</body>
</html>


