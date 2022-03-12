   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
   style="background: #fd7e14">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex " href="admin-index.php">
  <div class="sidebar-brand-text mx-2">CLICKEAT</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="admin-index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Products -->
<li class="nav-item">
  <a class="nav-link" href="admin-products.php">
    <i class="fas fa-fw fa-table"></i>
    <span>Products</span></a>
</li>
<!-- Nav Item - Orders -->
<li class="nav-item">
  <a class="nav-link" href="admin-order.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Orders</span></a>
</li>

<!-- Nav Item - Merchant -->
<li class="nav-item">
  <a class="nav-link" href="admin-merchant-acc.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Merchant</span></a>
</li>

<!-- Nav Item - Delivery Rider -->
<li class="nav-item">
  <a class="nav-link" href="register-rider.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Delivery Rider</span></a>
</li>

<!-- Nav Item - App User -->
<li class="nav-item">
  <a class="nav-link" href="admin-user-app.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>User App</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
          <div class="topbar-divider d-none d-sm-block"></div>

           
        <?php if(!isset($_SESSION['verified_user_id'])) : ?>
        
        <?php else : ?>
          <li class="nav-item dropdown no-arrow">
            <?php
              $uid = $_SESSION['verified_user_id'];
              $user = $auth->getUser($uid); 
            ?>
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600">  <?= $user->displayName; ?> </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item"  href="admin-profile.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a></li>
            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a></li>
          </ul>
        </li>
          <?php endif;?>
          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form action="logout.php" method="POST"> 
          
            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

          </form>


        </div>
      </div>
    </div>
  </div>