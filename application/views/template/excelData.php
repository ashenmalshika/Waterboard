<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>

    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
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
        <section class="bttn">
        
        <div style="text-align: center;">
        <?php if (!empty($fileName)) : ?>
            <div class="topic" ><h3 style="font-weight: bold;display: inline-block;"><?php echo $fileName;?>-Form Results</h3></div>
            <?php endif;?>
</div>    
<button class="logout-button" id="downloadExcel">Download</button>
        </section>
        <section class="content" id="content" >
            <div class="container-fluid" >
            <div class="row">
        <div class="col-12" style='margin-top: 15px'>
            <div class="card" id="one">
                <div class="card-header">
                    <h3 class="card-title"><b>Per Day Form Data</b></h3>                      
                </div>
                <div class="card-body">
                    <table id="formTwoData" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Raw Water Pipe 1 Bulk Meter Reading</th>
                                <th>Raw Water Pipe 2 Bulk Meter Reading</th>
                                <th>Raw Water Pipe 3 Bulk Meter Reading</th>
                                <th>Pumping Pipe 1 Bulk Meter Reading</th>
                                <th>Pumping Pipe 2 Bulk Meter Reading</th>
                                <th>Pumping Pipe 3 Bulk Meter Reading</th>
                                <th>Distribution Pipe 1 Bulk Meter Reading</th>
                                <th>Distribution Pipe 2 Bulk Meter Reading</th>
                                <th>Distribution Pipe 3 Bulk Meter Reading</th>
                                <th>Alum</th>
                                <th>PACl</th>
                                <th>Lime</th>
                                <th>Polymer</th>
                                <th>Gas Chlorine</th>
                                <th>Salt</th>
                                <th>Bleaching Powder</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($dailyData)) : ?>
                            <?php foreach ($dailyData as $row) : ?>
                                <tr>
                                    <td><?php echo $row->date; ?></td>
                                    <td><?php echo $row->pipe1_raw_bulkmeter_reading; ?></td>
                                    <td><?php echo $row->pipe2_raw_bulkmeter_reading; ?></td>
                                    <td><?php echo $row->pipe3_raw_bulkmeter_reading; ?></td>
                                    <td><?php echo $row->pipe1_pumping_bulkmeter_reading; ?></td>
                                    <td><?php echo $row->pipe2_pumping_bulkmeter_reading; ?></td>
                                    <td><?php echo $row->pipe3_pumping_bulkmeter_reading; ?></td>
                                    <td><?php echo $row->pipe1_bulkmeter_reading; ?></td>
                                    <td><?php echo $row->pipe2_bulkmeter_reading; ?></td>
                                    <td><?php echo $row->pipe3_bulkmeter_reading; ?></td>
                                    <td><?php echo $row->alum; ?></td>
                                    <td><?php echo $row->pacl; ?></td>
                                    <td><?php echo $row->lime; ?></td>
                                    <td><?php echo $row->polymer; ?></td>
                                    <td><?php echo $row->gas_chlorine; ?></td>
                                    <td><?php echo $row->salt; ?></td>
                                    <td><?php echo $row->bleaching_powder; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>    
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" id="two">
                <div class="card-header">
                    <h3 class="card-title"><b>Monthly Form Data</b></h3>
                </div>
                <div class="card-body">
                    <table id="formThreeData" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Diesel(L)</th>
                                <th>Ceb Reading</th>
                                <th>Generator Consumption(kw/h)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($monthData)) : ?>
                            <?php foreach ($monthData as $row) : ?>
                                <tr>
                                    <td><?= $row->date; ?></td>
                                    <td><?= $row->diesel; ?></td>
                                    <td><?= $row->ceb_reading; ?></td>
                                    <td><?= $row->generator_consumption; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" id="three">
                <div class="card-header">
                    <h3 class="card-title"><b>Eight Hour Form Data</b></h3>
                </div>
                <div class="card-body">
                    <table id="formFourData" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Alum/PACl - Jar Test [Shift 1]</th>
                                <th>Alum/PACl - Jar Test [Shift 2]</th>
                                <th>Alum/PACl - Jar Test [Shift 3]</th>
                            </tr>
                        </thead>
                        <tbody>   
                        <?php if (!empty($eightHourData)) : ?>
                            <?php foreach ($eightHourData as $row) : ?>
                                <tr>
                                    <td><?= $row->date; ?></td>
                                    <td><?= $row->treated_alum_pacl_jar1; ?></td>
                                    <td><?= $row->treated_alum_pacl_jar2; ?></td>
                                    <td><?= $row->treated_alum_pacl_jar3; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>   
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" id="four">
                <div class="card-header">
                    <h3 class="card-title"><b>Two Hour Form Data</b></h3>
                </div>
                <div class="card-body">
                    <table id="formOneData" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Raw Water Turbidity</th>
                                <th>Raw Water pH</th>
                                <th>Raw Water Electrical Conductivity</th>
                                <th>Raw Water Chloride/Salinity</th>
                                <th>Color</th>
                                <th>Odor</th>
                                <th>Settling Basin Rcl</th>
                                <th>Settling Basin Turbidity</th>
                                <th>Settling Basin pH</th>
                                <th>Treated Water RCL</th>
                                <th>Treated Water Turbidity</th>
                                <th>Treated Water pH</th>
                                <th>Treated Water Electrical Conductivity</th>
                                <th>Treated Water Chloride/Salinity</th>
                                <th>Treated Water Color</th>
                                <th>Treated Water Odor</th>
                                <th>Treated Water Residual Alum/PACl</th>
                                <th>Filter Effluent Rcl</th>
                                <th>Filter Effluent Turbidity</th>
                                <th>Filter Effluent pH</th>
                            </tr>
                        </thead>
                        <tbody>  
                        <?php if (!empty($twoHourData)) : ?>
                            <?php foreach ($twoHourData as $row) : ?>
                                <tr>
                                    <td><?= $row->date; ?></td>
                                    <td><?= $row->time; ?></td>
                                    <td><?= $row->raw_turbidity; ?></td>
                                    <td><?= $row->raw_ph; ?></td>
                                    <td><?= $row->raw_conductivity; ?></td>
                                    <td><?= $row->raw_salinity; ?></td>
                                    <td><?= $row->raw_color; ?></td>
                                    <td><?= $row->raw_odor; ?></td>
                                    <td><?= $row->settling_rcl; ?></td>
                                    <td><?= $row->settling_turbidity; ?></td>
                                    <td><?= $row->settling_ph; ?></td>
                                    <td><?= $row->treated_rcl; ?></td>
                                    <td><?= $row->treated_turbidity; ?></td>
                                    <td><?= $row->treated_ph; ?></td>
                                    <td><?= $row->treated_conductivity; ?></td>
                                    <td><?= $row->treated_salinity; ?></td>
                                    <td><?= $row->treated_color; ?></td>
                                    <td><?= $row->treated_odor; ?></td>
                                    <td><?= $row->treated_residual_alum_pacl; ?></td>
                                    <td><?= $row->filter_rcl; ?></td>
                                    <td><?= $row->filter_turbidity; ?></td>
                                    <td><?= $row->filter_ph; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>     
                        </tbody>
                    </table>
                </div>
            </div>
    </div></div></div>
        </section><br>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- Bootstrap 5 JS (bundle includes Popper.js) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

<script src="<?php echo base_url('assets/javascript/table2excel.js'); ?>"></script>


<script>
    document.getElementById('downloadExcel').addEventListener('click', function () {
        // Get the tables
        let tableTwo = document.querySelector("#formTwoData");
        let tableThree = document.querySelector("#formThreeData");
        let tableFour = document.querySelector("#formFourData");
        let tableOne = document.querySelector("#formOneData");

        var fileName = "<?= $fileName; ?>";
        // Export the tables to Excel
        var table2excel = new Table2Excel();
        table2excel.export([tableTwo, tableThree, tableFour, tableOne], fileName);
    });  
</script>



<script>
$('#formTwoData').DataTable({
    "scrollX": true,
    "paging":true,
    "ordering": false, // Enable/disable sorting
    "searching": true, // Enable/disable searching
});
$('#formThreeData').DataTable({
    "scrollX": true,
    "paging":false,
    "ordering": false, // Enable/disable sorting
    "searching": false, // Enable/disable searching
});
$('#formFourData').DataTable({
    "scrollX": true,
    "paging":true,
    "ordering": false, // Enable/disable sorting
    "searching": true, // Enable/disable searching
});
$('#formOneData').DataTable({
    "scrollX": true,
    "paging":true,
    "ordering": false, // Enable/disable sorting
    "searching": true, // Enable/disable searching
});
</script>
</body>

</html>
