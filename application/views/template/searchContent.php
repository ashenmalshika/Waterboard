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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                              <!-- Date range filter -->    
                        <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Plant</th>
                                        <th>Form Type</th>
                                        <th>Plant ID</th>
                                        <th>Data Inserted Date</th>
                                        <th>View Details</th> 
                                        <th>Delete Data</th>                                      
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
                                                    <a href="<?php echo base_url('Dashboard/displayData/'.$row->id); ?>" class="btn btn-info btn-block">View</a>
                                                </td>  
                                                <td>
                                                    <a href="<?php echo base_url('Dashboard/deleteData/'.$row->id); ?>" class="btn btn-block btn-danger">Delete</a>
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
                            <!-- <div id="pagination">
                                <button id="prevBtn" disabled>Prev</button>
                                <span id="pageNumbers" class="page-number"></span>
                                <button id="nextBtn">Next</button>
                            </div> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<?php if ($this->session->flashdata('message')): ?>
    <div id="notification">
        <?php echo $this->session->flashdata('message'); ?>
    </div>

    <script>
        // Show the notification and hide it after 5 seconds
        setTimeout(function() {
            var notification = document.getElementById('notification');
            notification.style.opacity = '0';  // Fade out

            // After the fade-out effect, hide the notification
            setTimeout(function() {
                notification.style.display = 'none';
            }, 600); // Time for the fade-out effect (600ms)
        }, 3000); // 2000ms = 5 seconds
    </script>
<?php endif; ?>

<!-- /.card -->
<!-- <script src="<?php echo base_url()?>assets/javascript/script1.js"></script> -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- Bootstrap 5 JS (bundle includes Popper.js) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

<script>
$('#example').DataTable({
    "paging":true,
    "order": [0, 'desc'], // Enable/disable sorting
    "searching": true, // Enable/disable searching
});
</script>

</body>

