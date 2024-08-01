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
                
                <div class="col-md-6" >
                    <!-- general form elements -->
                    <div style='margin-top: 15px' class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Traning Sessions Register Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php echo form_open('Dashboard/addSessionToDB'); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Session Name</label>
                                    <input type="text" class="form-control" name="sessionname" placeholder="Session Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Date</label>
                                    <input type="Date" class="form-control" name="sessiondate"   placeholder="Date" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Time</label>
                                    <input type="Time" class="form-control" name="sessionTime"  placeholder="Session Time" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lecturer Name</label>
                                    <input type="text" class="form-control" name="lecturername"  placeholder="Lecturer Name" required>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                            <button type="submit" class="btn btn-info" name='generate'>Generate QR</button>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.card -->    
                </div> 

                 
                <!-- Table Start -->
                <div class="col-12">   
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">Details of Training Sessions</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Session Name</th>
                                        <th>Session ID</th>
                                        <th>Date</th>
                                        <th>Lecturer Name</th>
                                        <th>Time</th>  
                                        <th>Session Link</th>
                                        <th>QR Code</th>
                                        <th>QR Download</th>
                                        <th>Delete Session</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <?php foreach($sessions as $row): ?>
                                        <?php
                                            $sessionDate = $row->sessionDate;
                                            $currentDate = date('Y-m-d'); 
                                            
                                            if ($sessionDate >= $currentDate):
                                        ?>
                                            <tr >
                                                <td > <?php echo $row->sessionName; ?></td>
                                                <td> <?php echo $row->SessionID; ?></td>  
                                                <td> <?php echo $row->sessionDate; ?></td>
                                                <td> <?php echo $row->lecturerName; ?></td>
                                                <td> <?php echo $row->sessionTime; ?></td>                                              
                                                <?php $link = "http://localhost/codeigniter/enterserviceid/" .$row->SessionID; ?> 
                                                <td style="max-width: 250px; word-wrap: break-word;"><?php echo "<a href='$link'>$link</a>"; ?></td>
                                                <td>  
                                                        <img style='width: 150px' src="<?php echo base_url('assets/images/'.$row->SessionID.'.png') ?>" alt="QR Code">
                                                </td>
                                                <td >
                                                    <button id="download-button-<?php echo $row->SessionID ?>" class="btn btn-info">Download</button>  
                                                </td>
                                                <!-- <td >
                                                    <button id="delete-button-<?php echo $row->SessionID ?>" class="btn btn-info"> Delete </button>  
                                                </td>   -->
                                                <td>
                                                    <a href="<?php echo base_url('Dashboard/deletesession/'.$row->SessionID); ?>" class="btn btn-info">Delete</a>
                                                </td>   
                                            </tr>
                                            <script>
                                                document.getElementById("download-button-<?php echo $row->SessionID ?>").addEventListener("click", function() {
                                                var link = document.createElement('a');
                                                link.download = '<?php echo $row->SessionID ?>.png';
                                                link.href = '<?php echo base_url('assets/images/'.$row->SessionID.'.png') ?>';
                                                link.click();
                                            });
                                            </script>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
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


