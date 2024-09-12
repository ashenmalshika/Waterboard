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
        <span><a href="<?php echo base_url('logout'); ?>" class="logout-button">Logout</a></span><br>
        <h1>Water Quality Data Entry - <?php echo $branch_name; ?>  </h1>
        <?php if ($this->session->flashdata('success')): ?>
            <p class="message success" id="successMessage"><?php echo $this->session->flashdata('success'); ?></p>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <p class="message error" id="errorMessage"><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>
        <form id="dataEntryForm" action="<?php echo site_url('addData'); ?>" method="post">
            <div class="section">
                <!-- Hidden inputs for branch details -->
                <input type="hidden" name="branch_id" value="<?php echo htmlspecialchars($branch_id); ?>">
                <input type="hidden" name="branch_name" value="<?php echo htmlspecialchars($branch_name); ?>">     
            </div>
            <label >
                    Select the Correct Form :
                </label><br>
            <div class="form-selection-container">
                
                <label>
                    <input type="radio" name="form_type" value="1" onclick="showSection('2hour')"> Two Hour Form
                </label>
                <label>
                    <input type="radio" name="form_type" value="2" onclick="showSection('daily')"> Per Day Form
                </label>
                <label>
                    <input type="radio" name="form_type" value="3" onclick="showSection('monthly')"> Per Month Form
                </label>
                <label>
                    <input type="radio" name="form_type" value="4" onclick="showSection('8hour')"> Eight Hour Form
                </label>
            </div><br>


            <div id="2hour" class="section hidden">
                <div class="section">
                    <label for="date">Date:<span id="date1Error" class="error" style="color: red; display: none;padding-right:15px">Date is required!</span></label>
                    <input type="date" id="date1" name="date1" >
                    
                  
                    <label for="time">Time:<span id="timeError" class="error" style="color: red; display: none; padding-right:15px">Time is required!</span></label>
                    <input type="time" id="time" name="time">
                    
               
                    <h3>Water Quality</h3>
                    <div class="flex-row">
                        <div class="column">
                            <h4>Raw Water</h4>
                            <label for="raw_turbidity">Turbidity (NTU):<span id="raw_turbidityError" class="error" style="color: red; display: none;padding-right:15px">Turbidity is required!</span></label>
                            <input type="number" step="0.01" id="raw_turbidity" name="raw_turbidity" >
                            
                            
                            <label for="raw_ph">pH:<span id="raw_phError" class="error" style="color: red; display: none; padding-right:15px">pH is required!</span></label>
                            <input type="number" step="0.1" id="raw_ph" name="raw_ph" >
                            

                            <button type="button" id="toggleButton" disabled>Add More Data</button>
                            <div id="additionalFields" style="display: none;">
                                <label for="raw_conductivity">Electrical Conductivity (µS/cm):</label>
                                <input type="number" step="0.1" id="raw_conductivity" name="raw_conductivity" >
                                
                                <label for="raw_salinity">Chloride/Salinity (mg/L):</label>
                                <input type="number" step="1" id="raw_salinity" name="raw_salinity" >
                                
                                <label for="raw_color">Color (Hazen):</label>
                                <input type="number" step="1" id="raw_color" name="raw_color" >
                                
                                <label for="raw_odor">Odor:</label>
                                <input type="text" id="raw_odor" name="raw_odor" >
                            </div>
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
                            <label for="treated_rcl">RCL (mg/L):<span id="treated_rclError" class="error" style="color: red; display: none;  padding-right:15px;">RCL is required!</span></label>
                            <input type="number" step="0.1" id="treated_rcl" name="treated_rcl" >
                              
                            
                            <label for="treated_turbidity">Turbidity (NTU):<span id="treated_turbidityError" class="error" style="color: red; display: none;  padding-right:15px">Turbidity is required!</span></label>
                            <input type="number" step="0.01" id="treated_turbidity" name="treated_turbidity" >
                            
                            
                            <label for="treated_ph">pH:<span id="treated_phError" class="error" style="color: red; display: none;  padding-right:15px">pH is required!</span></label>
                            <input type="number" step="0.1" id="treated_ph" name="treated_ph" >
                            

                            <button type="button" id="treatedToggleButton" disabled>Add More Data</button>
                            <div id="treatedAdditionalFields" style="display: none;">
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
                <div class="button-container" id="submit-container">
                    <button type="submit" onclick="return submitForm()">Submit</button>
                </div>
            </div>

            <div id="daily" class="section hidden">
                <div class="section">
                <label for="date">Date :<span id="date2Error" class="error" style="color: red; display: none;padding-right:15px">Date is required!</span></label>
                <input type="date" id="date2" name="date2">
                    <h3>Production</h3>
            
                <!-- Details for Raw Water -->
                <div class="unique-card">
                    <h4>Raw Water</h4>
                    <div>Select number of Pipes :
                        <div>
                            <button type="button" id="btn_one_pipe" class="form-selection-button" onclick="updateRawPipeVisibility(1)">One</button>
                            <button type="button" id="btn_two_pipes" class="form-selection-button" onclick="updateRawPipeVisibility(2)">Two</button>
                            <button type="button" id="btn_three_pipes" class="form-selection-button" onclick="updateRawPipeVisibility(3)">Three</button>
                        </div>
                    </div><br>
                    <div class="unique-column">
                        <div id="pipe1_raw" class="hidden">
                            <h4>Pipe 1</h4>
                            <label class="unique-label" for="pipe1_raw_diameter">Diameter:</label>
                            <input class="unique-input" type="number" id="pipe1_raw_diameter" name="pipe1_raw_diameter"  pattern="\d+" title="Please enter a whole number">

                            <label class="unique-label" for="pipe1_raw_bulkmeter_id">Bulk Meter ID:</label>
                            <input class="unique-input" type="text" id="pipe1_raw_bulkmeter_id" name="pipe1_raw_bulkmeter_id" >

                            <label class="unique-label" for="pipe1_raw_bulkmeter_reading">Bulk Meter Reading:</label>
                            <input class="unique-input" type="number" id="pipe1_raw_bulkmeter_reading" name="pipe1_raw_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                        </div>
                        <div id="pipe2_raw" class="hidden">
                            <h4>Pipe 2</h4>
                            <label class="unique-label" for="pipe2_raw_diameter">Diameter:</label>
                            <input class="unique-input" type="number" id="pipe2_raw_diameter" name="pipe2_raw_diameter"  pattern="\d+" title="Please enter a whole number">

                            <label class="unique-label" for="pipe2_raw_bulkmeter_id">Bulk Meter ID:</label>
                            <input class="unique-input" type="text" id="pipe2_raw_bulkmeter_id" name="pipe2_raw_bulkmeter_id" >

                            <label class="unique-label" for="pipe2_raw_bulkmeter_reading">Bulk Meter Reading:</label>
                            <input class="unique-input" type="number" id="pipe2_raw_bulkmeter_reading" name="pipe2_raw_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                        </div>
                        <div id="pipe3_raw" class="hidden">
                            <h4>Pipe 3</h4>
                            <label class="unique-label" for="pipe3_raw_diameter">Diameter:</label>
                            <input class="unique-input" type="number" id="pipe3_raw_diameter" name="pipe3_raw_diameter"  pattern="\d+" title="Please enter a whole number">

                            <label class="unique-label" for="pipe3_raw_bulkmeter_id">Bulk Meter ID:</label>
                            <input class="unique-input" type="text" id="pipe3_raw_bulkmeter_id" name="pipe3_raw_bulkmeter_id" >

                            <label class="unique-label" for="pipe3_raw_bulkmeter_reading">Bulk Meter Reading:</label>
                            <input class="unique-input" type="number" id="pipe3_raw_bulkmeter_reading" name="pipe3_raw_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                        </div>
                    </div>
                </div>

                <!-- Details for pumping -->
                <div class="unique-card">
                    <h4>Pumping/Transmission</h4>
                    <div>Select number of Pipes :
                        <div>
                            <button type="button" id="btn_four_pipe" class="form-selection-button" onclick="updatePumpingPipeVisibility(1)">One</button>
                            <button type="button" id="btn_five_pipes" class="form-selection-button" onclick="updatePumpingPipeVisibility(2)">Two</button>
                            <button type="button" id="btn_six_pipes" class="form-selection-button" onclick="updatePumpingPipeVisibility(3)">Three</button>
                        </div>
                    </div><br>
                    <div class="unique-column">
                        <div id="pipe1_pumping" class="hidden">
                            <h4>Pipe 1</h4>
                            <label class="unique-label" for="pipe1_pumping_diameter">Diameter:</label>
                            <input class="unique-input" type="number" id="pipe1_pumping_diameter" name="pipe1_pumping_diameter"  pattern="\d+" title="Please enter a whole number">

                            <label class="unique-label" for="pipe1_pumping_bulkmeter_id">Bulk Meter ID:</label>
                            <input class="unique-input" type="text" id="pipe1_pumping_bulkmeter_id" name="pipe1_pumping_bulkmeter_id" >

                            <label class="unique-label" for="pipe1_pumping_bulkmeter_reading">Bulk Meter Reading:</label>
                            <input class="unique-input" type="number" id="pipe1_pumping_bulkmeter_reading" name="pipe1_pumping_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                        </div>
                        <div id="pipe2_pumping" class="hidden">
                            <h4>Pipe 2</h4>
                            <label class="unique-label" for="pipe2_pumping_diameter">Diameter:</label>
                            <input class="unique-input" type="number" id="pipe2_pumping_diameter" name="pipe2_pumping_diameter"  pattern="\d+" title="Please enter a whole number">

                            <label class="unique-label" for="pipe2_pumping_bulkmeter_id">Bulk Meter ID:</label>
                            <input class="unique-input" type="text" id="pipe2_pumping_bulkmeter_id" name="pipe2_pumping_bulkmeter_id" >

                            <label class="unique-label" for="pipe2_pumping_bulkmeter_reading">Bulk Meter Reading:</label>
                            <input class="unique-input" type="number" id="pipe2_pumping_bulkmeter_reading" name="pipe2_pumping_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                        </div>
                        <div id="pipe3_pumping" class="hidden">
                            <h4>Pipe 3</h4>
                            <label class="unique-label" for="pipe3_pumping_diameter">Diameter:</label>
                            <input class="unique-input" type="number" id="pipe3_pumping_diameter" name="pipe3_pumping_diameter"  pattern="\d+" title="Please enter a whole number">

                            <label class="unique-label" for="pipe3_pumping_bulkmeter_id">Bulk Meter ID:</label>
                            <input class="unique-input" type="text" id="pipe3_pumping_bulkmeter_id" name="pipe3_pumping_bulkmeter_id" >

                            <label class="unique-label" for="pipe3_pumping_bulkmeter_reading">Bulk Meter Reading:</label>
                            <input class="unique-input" type="number" id="pipe3_pumping_bulkmeter_reading" name="pipe3_pumping_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                        </div>
                    </div>
                </div>

                 <!-- Details for distribution -->
                 <div class="unique-card">
                    <h4>Distribution</h4>
                    <div>Select number of Pipes :
                        <div>
                            <button type="button" id="btn_seven_pipe" class="form-selection-button" onclick="updateDistributionPipeVisibility(1)">One</button>
                            <button type="button" id="btn_eight_pipes" class="form-selection-button" onclick="updateDistributionPipeVisibility(2)">Two</button>
                            <button type="button" id="btn_nine_pipes" class="form-selection-button" onclick="updateDistributionPipeVisibility(3)">Three</button>
                        </div>
                    </div><br>
                    <div class="unique-column">
                        <div id="pipe1_distribution" class="hidden">
                            <h4>Pipe 1</h4>
                            <label class="unique-label" for="pipe1_distribution_diameter">Diameter:</label>
                            <input class="unique-input" type="number" id="pipe1_distribution_diameter" name="pipe1_distribution_diameter"  pattern="\d+" title="Please enter a whole number">

                            <label class="unique-label" for="pipe1_bulkmeter_id">Bulk Meter ID:</label>
                            <input class="unique-input" type="text" id="pipe1_bulkmeter_id" name="pipe1_bulkmeter_id" >

                            <label class="unique-label" for="pipe1_bulkmeter_reading">Bulk Meter Reading:</label>
                            <input class="unique-input" type="number" id="pipe1_bulkmeter_reading" name="pipe1_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                        </div>
                        <div id="pipe2_distribution" class="hidden">
                            <h4>Pipe 2</h4>
                            <label class="unique-label" for="pipe2_distribution_diameter">Diameter:</label>
                            <input class="unique-input" type="number" id="pipe2_distribution_diameter" name="pipe2_distribution_diameter"  pattern="\d+" title="Please enter a whole number">

                            <label class="unique-label" for="pipe2_bulkmeter_id">Bulk Meter ID:</label>
                            <input class="unique-input" type="text" id="pipe2_bulkmeter_id" name="pipe2_bulkmeter_id" >

                            <label class="unique-label" for="pipe2_bulkmeter_reading">Bulk Meter Reading:</label>
                            <input class="unique-input" type="number" id="pipe2_bulkmeter_reading" name="pipe2_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
                        </div>
                        <div id="pipe3_distribution" class="hidden">
                            <h4>Pipe 3</h4>
                            <label class="unique-label" for="pipe3_distribution_diameter">Diameter:</label>
                            <input class="unique-input" type="number" id="pipe3_distribution_diameter" name="pipe3_distribution_diameter"  pattern="\d+" title="Please enter a whole number">

                            <label class="unique-label" for="pipe3_bulkmeter_id">Bulk Meter ID:</label>
                            <input class="unique-input" type="text" id="pipe3_bulkmeter_id" name="pipe3_bulkmeter_id" >

                            <label class="unique-label" for="pipe3_bulkmeter_reading">Bulk Meter Reading:</label>
                            <input class="unique-input" type="number" id="pipe3_bulkmeter_reading" name="pipe3_bulkmeter_reading"  pattern="\d+" title="Please enter a whole number">
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
                <div class="button-container" id="submit-container">
                    <button type="submit" onclick="return validateForm2()">Submit</button>
                </div>
            </div>
          
            <div id="monthly" class="section hidden">
                <div class="section">
                <label for="date">Date :<span id="date3Error" class="error" style="color: red; display: none;padding-right:15px">Date is required!</span></label>
                <input type="month" id="date3" name="date3">

                    <h3>Power Consumption</h3>
                    <label for="diesel">Diesel (L) :</label>
                    <input type="number" step="0.01" id="diesel" name="diesel" >
                    
                    <label for="ceb_reading">CEB Reading :</label>
                    <input type="number" step="1" id="ceb_reading" name="ceb_reading" >

                    <label for="generator_reading">Generator Consumption (Kw/h) :</label>
                    <input type="number" step="1" id="generator_consumption" name="generator_consumption" >
                </div>
                <div class="button-container" id="submit-container">
                    <button type="submit" onclick="return validateForm3()">Submit</button>
                </div>
            </div>
            

            <div id="8hour" class="section hidden">
                <div class="section">
                <label for="date">Date :<span id="date4Error" class="error" style="color: red; display: none;padding-right:15px">Date is required!</span></label>
                <input type="date" id="date4" name="date4">
                    <h3>Treated Water</h3>
                    <div class="flex-row">
                        <div class="column">
                            <div>Select number of Shifts :
                                <div>
                                    <button type="button" id="btn_one_shift" class="form-selection-button" onclick="updateShiftVisibility(1)">One</button>
                                    <button type="button" id="btn_two_shift" class="form-selection-button" onclick="updateShiftVisibility(2)">Two</button>
                                    <button type="button" id="btn_three_shift" class="form-selection-button" onclick="updateShiftVisibility(3)">Three</button>
                                </div>
                            </div><br>
                            <div id="shift1_details" class="unique-card hidden">
                                <label for="treated_alum_pacl_jar">Alum/PACl - Jar Test (mg/L): [Shift 1]</label>
                                <input type="number" step="0.1" id="treated_alum_pacl_jar" name="treated_alum_pacl_jar1" >
                            </div>
                            <div id="shift2_details" class="unique-card hidden">
                                <label for="treated_alum_pacl_jar">Alum/PACl - Jar Test (mg/L): [Shift 2]</label>
                                <input type="number" step="0.1" id="treated_alum_pacl_jar" name="treated_alum_pacl_jar2" >
                            </div>
                            <div id="shift3_details" class="unique-card hidden">
                                <label for="treated_alum_pacl_jar">Alum/PACl - Jar Test (mg/L): [Shift 3]</label>
                                <input type="number" step="0.1" id="treated_alum_pacl_jar" name="treated_alum_pacl_jar3" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button-container" id="submit-container">
                    <button type="submit" onclick="return validateForm4()">Submit</button>
                </div>
            </div>
            </form>
            
        
    </div>

    <script src="<?php echo base_url('assets/javascript/userDashboard.js'); ?>"></script>

    <script>      
function submitForm() {
    // Array of field IDs and their corresponding error message elements
    const fields = [
        { id: 'date1', errorId: 'date1Error' },
        { id: 'time', errorId: 'timeError' },
        { id: 'raw_ph', errorId: 'raw_phError' },
        { id: 'raw_turbidity', errorId: 'raw_turbidityError' },
        { id: 'treated_rcl', errorId: 'treated_rclError' },
        { id: 'treated_turbidity', errorId: 'treated_turbidityError' },
        { id: 'treated_ph', errorId: 'treated_phError' }
    ];
    
    let allFilled = true;

    // Clear previous error messages
    fields.forEach(field => {
        document.getElementById(field.errorId).style.display = 'none'; // Hide error messages
    });

    // Check each field for input
    fields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value) {
            document.getElementById(field.errorId).style.display = 'inline'; // Show error message
            allFilled = false;
        }
    });

    // If any field is empty, prevent form submission
    if (!allFilled) {
        return false; // Prevent form submission
    }

    // If all fields are filled, return true to allow form submission
    return true;
}

// Function to check if both inputs are filled
function checkInputs() {
    var rawTurbidity = document.getElementById('raw_turbidity').value;
    var rawPH = document.getElementById('raw_ph').value;
    var toggleButton = document.getElementById('toggleButton');

    // Enable the button if both inputs are filled, otherwise disable it
    if (rawTurbidity && rawPH) {
        toggleButton.disabled = false;  // Enable the button
    } else {
        toggleButton.disabled = true;   // Disable the button
    }
}

// Add event listeners to check inputs when they change
document.getElementById('raw_turbidity').addEventListener('input', checkInputs);
document.getElementById('raw_ph').addEventListener('input', checkInputs);

// Function to toggle additional fields
document.getElementById('toggleButton').addEventListener('click', function() {
    var additionalFields = document.getElementById('additionalFields');
    
    if (additionalFields.style.display === 'none') {
        additionalFields.style.display = 'block';  // Show additional fields
        this.textContent = 'Collapse Data';        // Change button text
    } else {
        additionalFields.style.display = 'none';   // Hide additional fields
        this.textContent = 'Add More Data';        // Reset button text
    }
});


function validateForm2() {
    const fields = [
        { id: 'date2', errorId: 'date2Error' }
    ];
    
    let allFilled = true;

    // Clear previous error messages
    fields.forEach(field => {
        document.getElementById(field.errorId).style.display = 'none'; // Hide error messages
    });

    // Check each field for input
    fields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value) {
            document.getElementById(field.errorId).style.display = 'inline'; // Show error message
            allFilled = false;
        }
    });

    // If any field is empty, prevent form submission
    if (!allFilled) {
        return false; // Prevent form submission
    }

    // If all fields are filled, return true to allow form submission
    return true;
    }
function validateForm3() {
    const fields = [
        { id: 'date3', errorId: 'date3Error' }
    ];
    
    let allFilled = true;

    // Clear previous error messages
    fields.forEach(field => {
        document.getElementById(field.errorId).style.display = 'none'; // Hide error messages
    });

    // Check each field for input
    fields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value) {
            document.getElementById(field.errorId).style.display = 'inline'; // Show error message
            allFilled = false;
        }
    });

    // If any field is empty, prevent form submission
    if (!allFilled) {
        return false; // Prevent form submission
    }

    // If all fields are filled, return true to allow form submission
    return true;
}
function validateForm4() {
    const fields = [
        { id: 'date4', errorId: 'date4Error' }
    ];
    
    let allFilled = true;

    // Clear previous error messages
    fields.forEach(field => {
        document.getElementById(field.errorId).style.display = 'none'; // Hide error messages
    });

    // Check each field for input
    fields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value) {
            document.getElementById(field.errorId).style.display = 'inline'; // Show error message
            allFilled = false;
        }
    });

    // If any field is empty, prevent form submission
    if (!allFilled) {
        return false; // Prevent form submission
    }

    // If all fields are filled, return true to allow form submission
    return true;
}
// Check if the error message exists
var errorMessage = document.getElementById('errorMessage');
    if (errorMessage) {
        // Set a timeout to hide the message after 5 seconds
        setTimeout(function() {
            errorMessage.style.display = 'none'; // Hide the message
        }, 5000); // 5000 milliseconds = 5 seconds
    }

// Check if the error message exists
var successMessage = document.getElementById('successMessage');
    if (successMessage) {
        // Set a timeout to hide the message after 5 seconds
        setTimeout(function() {
            successMessage.style.display = 'none'; // Hide the message
        }, 5000); // 5000 milliseconds = 5 seconds
    }

// Function to check if the first three inputs are filled
function checkTreatedInputs() {
    var treatedRCL = document.getElementById('treated_rcl').value;
    var treatedTurbidity = document.getElementById('treated_turbidity').value;
    var treatedPH = document.getElementById('treated_ph').value;
    var treatedToggleButton = document.getElementById('treatedToggleButton');

    // Enable the button if all three inputs are filled
    if (treatedRCL && treatedTurbidity && treatedPH) {
        treatedToggleButton.disabled = false;  // Enable the button
    } else {
        treatedToggleButton.disabled = true;   // Keep the button disabled
    }
}

// Add event listeners to check inputs when they change
document.getElementById('treated_rcl').addEventListener('input', checkTreatedInputs);
document.getElementById('treated_turbidity').addEventListener('input', checkTreatedInputs);
document.getElementById('treated_ph').addEventListener('input', checkTreatedInputs);

// Function to toggle additional fields when button is clicked
document.getElementById('treatedToggleButton').addEventListener('click', function() {
    var treatedAdditionalFields = document.getElementById('treatedAdditionalFields');
    
    if (treatedAdditionalFields.style.display === 'none') {
        treatedAdditionalFields.style.display = 'block';  // Show the additional fields
        this.textContent = 'Collapse Data';                // Change button text
    } else {
        treatedAdditionalFields.style.display = 'none';   // Hide the additional fields
        this.textContent = 'Add More Data';               // Reset button text
    }
});

</script>

</body>
</html>
