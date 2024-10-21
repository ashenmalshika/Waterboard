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
    <link rel="stylesheet" href="<?php echo base_url('assets/css/chartContent2.css') ?>">
</head>
<body>
<div class="wrapper">
    <div class="content-wrapper">
        <br>
        <section class="content-header">
            <label for="yearDropdown">Check Water Quality data of selected plant</label><br>
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
            <br><h4>Raw pH and Treated pH</h4><br>
            <canvas id="phChart"></canvas>

            <br><h4>Raw Turbidity and Treated Turbidity (NTU)</h4><br>
            <canvas id="turbidityChart"></canvas><br>

            <h4>Treated RCL (mg/L)</h4><br>
            <canvas id="rclChart"></canvas>
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
<script>// Initialize the year dropdown when the page loads
window.onload = function() {
    populateYearDropdown();
    initializeCharts();
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



function searchData() {
    const selectedYear = document.getElementById('yearDropdown').value;
    const selectedMonth = document.getElementById('monthDropdown').value;
    const selectedPlant = document.getElementById('plantDropdown').value;

    if (selectedYear && selectedMonth && selectedPlant) {
        const searchDate = `${selectedYear}-${selectedMonth}`;

        // AJAX request to fetch data from the server
        $.ajax({
            url: '<?= base_url("Dashboard/waterQualityDataIm") ?>',
            type: 'POST',
            data: {
                date: searchDate,
                plantId: selectedPlant
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Show the chart container and update the chart
                    document.getElementById('chartContainer').style.display = 'block';
                    document.getElementById('output').innerText = ''; // Clear any previous messages

                    updateCharts(response.dates, response.rawTurbidity, response.rawPh, response.treatedRcl, response.treatedTurbidity, response.treatedPh);
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
                showError('Raw Water & Treated Water Quality Data not found.');
            }
        });
    } else {
        // If no year, month, or plant is selected, show an appropriate message
        document.getElementById('errorContainer').style.display = 'block';
        document.getElementById('output').innerText = 'Please select a plant, month, and year.';
        document.getElementById('chartContainer').style.display = 'none';
    }
}


let phChart, turbidityChart, rclChart;

function initializeCharts() {
    // Initialize pH Chart
    const ctxPh = document.getElementById('phChart').getContext('2d');
    phChart = new Chart(ctxPh, {
        type: 'bar',
        data: {
            labels: [], // Time labels
            datasets: [{
                label: 'Raw pH',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                maxBarThickness: 80
            }, {
                label: 'Treated pH',
                data: [],
                backgroundColor: 'rgba(255, 99, 71, 0.2)',
                borderColor: 'rgba(255, 9, 8, 0.7)',
                borderWidth: 1,
                maxBarThickness: 80
            }]
        },
        options: {
            scales: {
                y: { min: 0 }
            }
        }
    });

    // Initialize Turbidity Chart
    const ctxTurbidity = document.getElementById('turbidityChart').getContext('2d');
    turbidityChart = new Chart(ctxTurbidity, {
        type: 'bar',
        data: {
            labels: [], // Time labels
            datasets: [{
                label: 'Raw Turbidity',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                maxBarThickness: 80
            }, {
                label: 'Treated Turbidity',
                data: [],
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1,
                maxBarThickness: 80
            }]
        },
        options: {
            scales: {
                y: { min: 0 }
            }
        }
    });

    // Initialize Treated RCL Chart
    const ctxRcl = document.getElementById('rclChart').getContext('2d');
    rclChart = new Chart(ctxRcl, {
        type: 'bar',
        data: {
            labels: [], // Time labels
            datasets: [{
                label: 'Treated RCL',
                data: [],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1,
                maxBarThickness: 80
            }]
        },
        options: {
            scales: {
                y: { min: 0 }
            }
        }
    });
}

// Function to update the charts with new data
function updateCharts(time, rawTurbidity, rawPh, treatedRcl, treatedTurbidity,  treatedPh) {
    // Update pH Chart
    phChart.data.labels = time;
    phChart.data.datasets[0].data = rawPh;
    phChart.data.datasets[1].data = treatedPh;
    phChart.update();

    // Update Turbidity Chart
    turbidityChart.data.labels = time;
    turbidityChart.data.datasets[0].data = rawTurbidity;
    turbidityChart.data.datasets[1].data = treatedTurbidity;
    turbidityChart.update();

    // Update RCL Chart
    rclChart.data.labels = time;
    rclChart.data.datasets[0].data = treatedRcl;
    rclChart.update();
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
