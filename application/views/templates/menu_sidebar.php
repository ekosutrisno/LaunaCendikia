 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
       <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          <img src="<?= base_url('assets/img/icon/full-w.png'); ?>" width="40" height="40">
       </div>
       <div class="sidebar-brand-text mx-3">LC MTSN 2</div>
    </a>

    <div class="sidebar-heading">
       Administrator
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
       <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
       User
    </div>

    <!-- Nav Item - my rpfile -->
    <li class="nav-item">
       <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-user"></i>
          <span>My Profile</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
       <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
       <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

 </ul>
 <!-- End of Sidebar -->