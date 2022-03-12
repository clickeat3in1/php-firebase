<?php
include('admin_auth.php');
include('dbcon.php');
include('includes/header.php');
include('includes/navbar.php');
?>

    <div class="container">  
            <?php
                if(isset($_SESSION['status']))
                {
                    echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                    unset($_SESSION['status']);
                }     
            ?>  
        <div class="row justify-content-center">

            <div class="col-md-5"> 
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit & Update User Data
                        </h4>
                    </div>
                    <div class="card-body">
                        
                        <form action="code.php" method="POST" autocomplete="OFF">
                        <?php
                            if(isset($_GET['id']))
                            {
                                $uid = $_GET['id'];    
                            
                                try {
                                    $user = $auth->getUser($uid);
                                    ?>
                                        <input type="hidden" name="user_id" value="<?=$user->uid;?>">
                                        <div class="form-group mb-3" >
                                            <label for="">Display Name</label>
                                            <input type="text" name="display_name" value="<?=$user->displayName;?>" class="form-control" readonly>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Phone Number</label>
                                            <input type="text" name="phone" value="<?=$user->phoneNumber;?>"class="form-control">
                                        </div>
                                    
                                        <input type="hidden" name="ena_dis_user_id" value="<?= $uid; ?>">
                                        <div class="input-group mb-1">
                                            <label for="">Enable/Disable</label><br>
                                        </div>
                                        <div class="input-group mb-1">
                                            <select name="select_enable_disable" class="form-control" >
                                                <option value=""><?php
                                                if($user->disabled)
                                                {
                                                    echo "Disabled";
                                                }
                                                else
                                                {
                                                    echo "Enabled";
                                                }
                                        ?></option>
                                                <option value="disable">Disable</option>
                                                <option value="enable">Enable</option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="claims_user_id" value="<?=$uid;?>"> 
                                        <div class="input-group mb-1">
                                            <label for="">User Claims</label><br>
                                        </div>
                                        <div class="form-group mb-1">
                                            <select name="role_as" class="form-control">
                                                <option value="">
                                                <?php
                                            $claims = $auth->getUser($user->uid)->customClaims;
                                            if(isset($claims['admin']) == true)
                                            {
                                                echo "Admin";
                                            }
                                            if(isset($claims['merchant']) == true)
                                            {
                                                echo "Merchant";
                                            }
                                            elseif($claims == null)
                                            {
                                                echo "No Role";
                                            }
                                        ?></option>
                                                <option value="admin">Admin</option>
                                                <option value="merchant">Merchant</option>
                                                <option value="norole"> Remove Role</option>
                                            </select>
                                        </div>
                                            <div class="form-group mb-1">
                                            <button type="submit" name="update_acc" class="btn btn-primary ">Update User</button>
                                            </div>
                                    <?php
                                } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                                echo $e->getMessage();
                              }
                            }
                            
                        ?>
                   
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Change Password</h4>
                </div>
                <div class="card-body">

                        <form action="code.php" method="POST">

                            <?php
                            if(isset($_GET['id']))
                            {
                                    $uid = $_GET['id'];
                                    try {
                                        $user = $auth->getUser($uid);
                                        ?>
                                        <input type="hidden" name="change_password_btn" value="<?=$uid;?>">
                                            <div class="form-group mb-3">
                                                <label for="">New Password</label>
                                                <input type="password" name="new_password" required class="form-control">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="">Re-type Password</label>
                                                <input type="password" name="retype_password" required class="form-control">
                                            </div>
                                            <div class="form-group mb-3">
                                                <button type="submit" name="change_password_btn" class="btn btn-primary">Submit</button>
        
                                            </div>
                                    
                                        <?php

                                    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                                        echo $e->getMessage();
                                    }
                                }
                                else
                                {
                                    echo "No Id found";
                                }
                                ?>
                        </form>
                </div>
            </div>          
        </div>

    </div>
</div>   