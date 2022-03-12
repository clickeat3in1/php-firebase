<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar-merchant.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
      <?php
        if(isset($_SESSION['status']))
        {
            echo "<h6 class='alert alert-success'>".$_SESSION['status']."</h6>";
            unset($_SESSION['status']);
        }         
        ?>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- total merchant -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">My Products</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
               <?php 
                        include('dbcon.php');
                        $uid = $_SESSION['verified_user_id'];
                        $user = $auth->getUser($uid);
                        $merchantid =  $user->uid;
                        $ref_table = 'item/';
                        $total_count = $database->getReference($ref_table)
                        ->orderByChild('merchantid')->equalTo($merchantid)
                        ->getSnapshot()->numChildren();
                        echo $total_count;
                     ?> 
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- orders -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Orders</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php 
                        include('dbcon.php');
                        $uid = $_SESSION['verified_user_id'];
                        $user = $auth->getUser($uid);
                        
                        $merchantid =  $user->uid;
                        $ref_table = 'storeorder/';
                      
                        $total_count = $database->getReference($ref_table)
                        ->orderByChild('items/merchantid')->equalTo($merchantid)
                        ->getSnapshot()->numChildren();
                     
                        echo '<script>console.log('.json_encode($total_count).')</script>';
                        echo $total_count;
                       
                     
                     ?> 
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">New Order</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                  <?php 
                        include('dbcon.php');
                        $ref_table = 'item/';
                        $total_count = $database->getReference($ref_table)->getSnapshot()->numChildren();
                        echo $total_count;
                     ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    -->
    
  </div>

  <!-- Content Row -->


  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>