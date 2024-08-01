<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://www.waterboard.lk/" class="brand-link">
      <img src="<?php echo base_url()?>assets/dist/img/nwsdb.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">NWSDB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url()?>assets/dist/img/user2-160x160.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin Login</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               
          <li class="nav-header">Home</li>
          <li class="nav-item">
            <a href=<?php echo base_url('home');?> class="nav-link">
            <i class="nav-icon fa fa-home"></i>
              <p>
                Home
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href=<?php echo base_url('Dashboard/showallsessions');?> class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                All Sessions
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href=<?php echo base_url('Dashboard/settings');?>  class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Settings
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href=<?php echo base_url('logout');?>  class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Logout
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
