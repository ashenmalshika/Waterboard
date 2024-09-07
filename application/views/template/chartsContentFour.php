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
    <link rel="stylesheet" href="<?php echo base_url('assets/css/chartContent.css') ?>">
</head>
<body>
<div class="wrapper">
    <div class="content-wrapper">
        <br>
        <section class="content-header">
            <label for="yearDropdown">Check Raw Water Turbidity of Selected plant</label><br>
            
            <label for="monthDropdown">Select Date:</label>
            <input type="date" id="monthDropdown" name="date" writingsuggestions="true">

            <label for="plantDropdown">Select Plant:</label>
            <select id="plantDropdown">
                <option value="415168">Malimbada Old</option>
                <option value="466192">Malimbada New</option>
                <option value="661055">Hallala Old</option>
                <option value="290645">Hallala New</option>
                <option value="540962">Katuwangoda</option>
                <option value="595956">Akuressa</option>
                <option value="323107">Nadugala</option>
                <option value="915959">Pitabaddara</option>
                <option value="548682">Makandura</option>
                <option value="998709">Radampala</option>
                <option value="999864">Thihagoda</option>
                <option value="522842">Hakmana</option>
                <option value="136679">Karagoda Uyangoda</option>
                <option value="674107">Deniyaya</option>
            </select>


            <button onclick="searchData()">Search</button>
            
        </section>

        <section class="content" id="chartContainer" style="display:none">
            <br><h4>Raw Water Turbidity (NTU)</h4><br>
            <canvas id="dieselChart"></canvas>
        </section><br>
        <section class="error" id="errorContainer" >
            <p id="output"></p>
        </section>
    </div>
</div>

<!-- Include necessary JS libraries -->
<script src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>

window.onload = function() {
    initializeChart();
};

function searchData() {
    const selectedDate = document.getElementById('monthDropdown').value; // This now selects a full date
    const selectedPlant = document.getElementById('plantDropdown').value;

    if (selectedDate && selectedPlant) {
        // AJAX request to fetch data from the server
        $.ajax({
            url: '<?= base_url("dashboard/raw_water_turbidity_data") ?>',
            type: 'POST',
            data: {
                date: selectedDate,
                plantId: selectedPlant
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Show the chart container and update the chart
                    document.getElementById('chartContainer').style.display = 'block';
                    document.getElementById('output').innerText = ''; // Clear any previous messages

                    updateChart(response.time, response.turbidity);
                } else {
                    // No data found, hide the chart and show the message
                    document.getElementById('chartContainer').style.display = 'none';
                    document.getElementById('errorContainer').style.display = 'block';
                    showError(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Hide the chart and clear messages if the fetch fails
                document.getElementById('chartContainer').style.display = 'none';
                document.getElementById('errorContainer').style.display = 'block';
                showError('Raw Turbidity Data not found for the selected date.');
            }
        });
    } else {
        // If no date or plant is selected, show an appropriate message
        document.getElementById('errorContainer').style.display = 'block';
        document.getElementById('output').innerText = 'Please select a plant and date.';
        document.getElementById('chartContainer').style.display = 'none';
    }
}


// Initialize an empty stacked chart
let dieselChart;
function initializeChart() {
    const ctx = document.getElementById('dieselChart').getContext('2d');
    dieselChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Turbidity',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                maxBarThickness: 80
            }]
        },
        options: {
            scales: {
                y: {
                    min: 0  // Ensures the Y-axis starts at 0
                }
            }
        }
    });
}

// Function to update the chart with new data
function updateChart(time, turbidity) {
    dieselChart.data.labels = time;
    dieselChart.data.datasets[0].data = turbidity;
    dieselChart.options.scales.y.min = 0;
    dieselChart.update();
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
