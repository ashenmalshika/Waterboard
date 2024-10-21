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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
</head>
<body>
    <div class="content-wrapper">
        <br>
        <section class="content-header">
        <form id="dataForm" action="<?php echo base_url("Excelsheet/loadData")?>" method="POST">
            <label for="yearDropdown">Check Data Availability</label><br>
            <label for="yearDropdown">Select Year:</label>
            <select id="yearDropdown" name="year"></select>

            <label for="monthDropdown">Select Month:</label>
            <select id="monthDropdown" name="month">
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
            <select id="plantDropdown" name="plantId">
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

            <button type="submit">Search</button>
</form>
        </section>
 
    </div>
<script>
// Initialize the year dropdown when the page loads
window.onload = function() {
    populateYearDropdown();
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
