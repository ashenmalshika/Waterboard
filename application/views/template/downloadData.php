<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <!-- Include the necessary CSS and JS libraries -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/downloadData.css">
</head>
<body>
    <div class="content-wrapper">
        <br>
        <section class="content-header">
            <label for="yearDropdown">Check Data Availability</label><br>
            <label for="yearDropdown">Select Year:</label>
            <select id="yearDropdown"></select>

            <label for="monthDropdown">Select Month:</label>
            <select id="monthDropdown">
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <button onclick="">Search</button>
            
        </section>
        <section class="error" id="errorContainer" >
            <p id="output"></p>
        </section>
    </div>


<!-- Include necessary JS libraries -->
<script src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
// Initialize the year dropdown when the page loads
window.onload = function() {
    populateYearDropdown();
    initializeChart();
};

// Populate the year dropdown with the last 5 years
function populateYearDropdown() {
    const yearDropdown = document.getElementById('yearDropdown');
    const currentYear = new Date().getFullYear();

    for (let i = 0; i < 5; i++) {
        const year = currentYear - i;
        const option = document.createElement('option');
        option.value = year;
        option.text = year;
        yearDropdown.appendChild(option);
    }
}

// Function to search data based on selected month and year
function searchData() {
    const selectedYear = document.getElementById('yearDropdown').value;
    const selectedMonth = document.getElementById('monthDropdown').value;

    if (selectedYear && selectedMonth) {
        const searchDate = `${selectedYear}-${selectedMonth}`;

        // AJAX request to fetch data from the server
        $.ajax({
            url: '<?= base_url("Excelsheet") ?>',
            type: 'POST',
            data: {date: searchDate},
            dataType: 'json',
            success: function(response) {
                
            },
            error: function(xhr, status, error) {
            
            }
        });
    } else {
        // If no year or month is selected, show an appropriate message
        document.getElementById('errorContainer').style.display = 'block';
        document.getElementById('output').innerText = 'Please select both a month and a year.';
        document.getElementById('chartContainer').style.display = 'none';
    }
}

function showError(message) {
    const errorContainer = document.getElementById('errorContainer');
    const output = document.getElementById('output');

    // Set the error message
    output.innerText = message;

    // Display the error container
    errorContainer.style.display = 'block';

    // Hide the error container after 5 seconds (5000 milliseconds)
    setTimeout(function() {
        errorContainer.style.display = 'none';
    }, 5000);
}


</script>
</body>

</html>
