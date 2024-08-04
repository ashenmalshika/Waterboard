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
</head>

<body>

<div class="content-wrapper">
    <section  class="content">
        <div class="container-fluid" >
            <div class="row">
            <!-- left column -->
                
                 
                <!-- Table Start -->
                <div class="col-12"><br>  
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">Details of User Accounts</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Plant ID</th>
                                        <th>Plant Name</th>
                                        <th>Username</th>
                                        <th>Password</th>
 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($sessions)): ?>
                                        <?php foreach ($sessions as $row): ?>
                                            <tr>
                                                <td><?php echo $row->branchID; ?></td>
                                                <td><?php echo $row->branchName; ?></td>
                                                <td><?php echo $row->username; ?></td>
                                                <td><?php echo $row->password; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4">No users found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>                     
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>


<!-- /.card -->


</body>


