<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                <h1 class="h3 mb-0 text-gray-800">Edit Rider Details </h1>
                </div>
                <div class="card-body">

                    <?php
                        include('dbcon.php');

                        if(isset($_GET['id']))
                        {
                            $key_child = $_GET['id'];

                            $ref_table= 'rider/';
                            $getdata = $database->getReference($ref_table)->getChild($key_child)->getValue();

                            if($getdata > 0)
                            {
                                ?>   
                                <form action="ridercode.php" method="POST">
                                <input type="hidden" name="key" value="<?=$key_child;?>">
                                
                                <div class="form-group mb-3">
                                    <label for="">Rider Name</label>
                                    <input type="text" name="ridername"  value="<?=$getdata['ridername'];?>" class="form-control">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="<?=$getdata['email'];?>" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Phone Number</label>
                                    <input type="number" name="phonenumber" value="<?=$getdata['phonenumber'];?>" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Address</label>
                                    <input type="text" name="address" value="<?=$getdata['address'];?>" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                   <a href="register-rider.php" class="btn btn-danger float-right mr-3"> Cancel</a>
                                   <button type="submit" name="rider_update_btn" class="btn btn-primary float-right mr-3">Update</button>
                                </div>
                            </form>
                        <?php
                            }   
                            else
                            {
                                $_SESSION['status'] = "Invalid Id"; 
                                header('Location: index.php');  
                                exit();           
                            }
                        }
                        else
                        {
                                $_SESSION['status'] = "No Found"; 
                                header('Location: index.php');  
                                exit();           
                            }
                        
                        
                        ?>               


                </div>   
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>