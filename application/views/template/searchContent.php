<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<head>
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/btns.css">
</head>

<body>

<div class="content-wrapper">
    <section  class="content">
        <div class="container-fluid" >
            <div class="row">
             
                <!-- Table Start -->
                <div class="col-12" style='margin-top: 15px'>   
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Details of All Filled Forms</h3>
                            <div class="float-right" style="display: flex;">
                                    <input type="text" id="searchInput" placeholder="Search..." style="margin-right: 5px;">
                                    <button class='btn btn-info btn-sm' onclick="searchTable()" type="button">Search</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Plant</th>
                                        <th>Form Type</th>
                                        <th>Plant ID</th>
                                        <th>Data Inserted Date</th>
                                        <th>View Details</th>                                       
                                    </tr>
                                </thead>
                                <tbody >
                                <?php if (!empty($sessions)): ?>
                                        <?php foreach ($sessions as $row): ?>
                                            <tr>
                                                <td><?php echo $row->date; ?></td>
                                                <td><?php echo date('h:i A', strtotime($row->time)); ?></td>
                                                <td><?php echo $row->branchName; ?></td>
                                                <td>
                                                    <?php
                                                        if ($row->formNo == 1) {
                                                            echo 'Two Hour';
                                                        } elseif ($row->formNo == 2) {
                                                            echo 'Per Day';
                                                        } elseif ($row->formNo == 3) {
                                                            echo 'Per Month';
                                                        } elseif ($row->formNo == 4) {
                                                            echo 'Eight Hour';
                                                        } else {
                                                            echo 'Unknown Form';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $row->branchID; ?></td>
                                                <td><?php echo $row->dataInsertedDate; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Dashboard/displayData/'.$row->id); ?>" class="btn btn-block btn-info">View</a>
                                                </td>  
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4">No data found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>                       
                            </table>
                            <div id="pagination">
                                <button id="prevBtn" disabled>Prev</button>
                                <span id="pageNumbers" class="page-number"></span>
                                <button id="nextBtn">Next</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<!-- /.card -->

<script src="<?php echo base_url()?>assets/javascript/script1.js"></script>
<script src="<?php echo base_url()?>assets/javascript/script2.js"></script>
</body>

