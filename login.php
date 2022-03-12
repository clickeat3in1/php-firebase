<?php
session_start();
if(isset($_SESSION['verified_user_id']))
{
    $_SESSION['status'] ="You are already Logged in";
    header('Location: index.php');
    exit();
}
include('includes/header.php'); 
?>


<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-5 ">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <?php

                    if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                    {
                        echo '<h6 class="alert alert-success"> '.$_SESSION['status'].' </h6>';
                        unset($_SESSION['status']);
                    }
                ?>
                <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                
              </div>

                <form class="user" action="logincode.php" method="POST" autocomplete="off">

                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                    </div>
            
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login </button>
                    <hr>
                </form>
                    <!-- <div class="text-center">
                        <a class="small" href="#">Forgot Password?</a>
                    </div> -->
                    <div class="text-center">
                        <a class="small" href="register.html">Create an Account!</a>
                    </div>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>


<?php
include('includes/scripts.php'); 
?>