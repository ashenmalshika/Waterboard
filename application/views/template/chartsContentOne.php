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
    <style>
       
        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .content-header {
    background-color: #d9d9d9;
    padding: 20px;
    border-radius: 8px;
    max-width: 600px;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.content-header label {
    font-weight: bold;
    margin-right: 10px;
    font-size: 14px;
    color: #333;
}

.content-header select {
    padding: 8px;
    font-size: 14px;
    border-radius: 4px;
    border: 1px solid #ccc;
    margin-right: 20px;
    background-color: #fff;
    cursor: pointer;
}

.content-header button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.content-header button:hover {
    background-color: #0056b3;
}

#output {
    margin-top: 20px;
    font-size: 16px;
    color: #333;
    font-weight: normal;
}
.content {
   
    padding: 20px;
    border-radius: 8px;
    max-width: 800px;
    margin: auto;

}

#dieselChart {
    width: 100%;
    height: auto;
    max-height: 400px;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.05);
    padding:20px;
}
/* Error Message Container */
#errorContainer {
    display: none; /* Initially hidden */
    margin: auto;
    padding: 10px;
    border: 1px solid #ff4d4d;
    background-color: #ffe6e6;
    color: #cc0000;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    max-width:80%;
}
h4{
    text-align: center;
}

/* Error Text */
#errorContainer p {
    margin: 0;
    font-size: 16px;
}

@media screen and (max-width: 600px) {
    .content {
        padding: 15px;
        max-width: 100%;
    }

    #dieselChart {
        max-height: 300px;
    }
}

@media screen and (max-width: 600px) {
    .content-header {
        padding: 15px;
    }

    .content-header label, .content-header select, .content-header button {
        display: block;
        width: 100%;
        margin-bottom: 15px;
    }

    .content-header select, .content-header button {
        margin-right: 0;
    }
}

    </style>
</head>
<body>
<div class="wrapper">
    <div class="content-wrapper">
        <br>
        <section class="content-header">
            <label for="yearDropdown">Check Power Consumption of Different plants</label><br>
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

            <button onclick="searchData()">Search</button>
            
        </section>

        <section class="content" id="chartContainer" style="display: none;">
            <br><h4>Diesel Consumption</h4><br>
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
<script src="<?php echo base_url()?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>

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
            url: '<?= base_url("Dashboard/fetch_data") ?>',
            type: 'POST',
            data: {date: searchDate},
            dataType: 'json',
            success: function(response) {
                if (response.branchNames.length > 0) {
                    // Show the chart container and update the chart
                    document.getElementById('chartContainer').style.display = 'block';
                    document.getElementById('output').innerText = ''; // Clear any previous messages
                    updateChart(response.branchNames, response.dieselValues);
                } else {
                    // No data found, hide the chart and show the message
                    document.getElementById('chartContainer').style.display = 'none';
                    document.getElementById('errorContainer').style.display = 'block';
                    showError('Diesel Consumption Data not found for the selected month and year.');

                }
            },
            error: function(xhr, status, error) {
                // Hide the chart and clear messages if the fetch fails
                document.getElementById('chartContainer').style.display = 'none';
                document.getElementById('errorContainer').style.display = 'block';
                showError('Diesel Consumption Data not found for the selected month and year.');
 // No error message needed
            }
        });
    } else {
        // If no year or month is selected, show an appropriate message
        document.getElementById('errorContainer').style.display = 'block';
        document.getElementById('output').innerText = 'Please select both a month and a year.';
        document.getElementById('chartContainer').style.display = 'none';
    }
}

// Initialize an empty chart
let dieselChart;

function initializeChart() {
    const ctx = document.getElementById('dieselChart').getContext('2d');
    dieselChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Diesel Usage',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Function to update the chart with new data
function updateChart(branchNames, dieselValues) {
    dieselChart.data.labels = branchNames;
    dieselChart.data.datasets[0].data = dieselValues;
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
