<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar-merchant.php')
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

        <?php
                if(isset($_SESSION['status']))
            {
                echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                unset($_SESSION['status']);
            }         
            ?> 

           
            <div class="card">
                <div class="card-header">
                    <h4>My Profile</h4>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_SESSION['verified_user_id']))
                    {
                        $uid = $_SESSION['verified_user_id'];
                        $user = $auth->getUser($uid);
                        ?>
                       
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="row">
                            <div class="col-md-8 border-end">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Display Name</label>
                                        <input type="text" name="displayName" value="<?=$user->displayName;?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="phone" value="<?=$user->phoneNumber;?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Email Address</label>
                                        <div class="form-control">
                                            <?=$user->email;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Your Role</label>
                                        <div class="form-control">

                                        <?php
                                            $claims = $auth->getUser($user->uid)->customClaims;
                                            if(isset($claims['admin']) == true)
                                            {
                                                echo "Role : Admin";
                                            }elseif(isset($claims['merchant']) == true)
                                            {
                                                echo "Role : Merchant";
                                            }
                                            elseif($claims == null)
                                            {
                                                echo "Role : No Role";
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                    <label for="">Account Status (Disable/Enable)</label>
                                    <div class="form-control">
                                    <?php
                                        if($user->disabled)
                                        {
                                            echo "Disabled";
                                        }
                                        else
                                        {
                                            echo "Enabled";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group border mb-3">
                                    <?php
                                    if($user->photoUrl != NULL)
                                    {
                                        ?>
                                        <img src="<?=$user->photoUrl?>" class="w-100" alt="User Profile">
                                        <?php
                                    }
                                    else
                                    {
                                        echo "Update your profile picture";
                                    }
                                    ?>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Change Profile Image</label>
                                    <input type="file" name="profile" class="file-upload-default">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="form-group mb-3">
                                    <button type="submit" name="update_user_profile" class="btn btn-primary float-end">Update Profile</button>
                                </div>
                            </div>
                            </div>

                        </form>
 
                        <?php
                    }
                    ?>
                </div>
                <div class="card mt-4">
                <div class="card-header">
                    <h4>Change Password</h4>
                </div>
                <div class="card-body">

                        <form action="code.php" method="POST">
                        <?php
                    if(isset($_SESSION['verified_user_id']))
                    {
                        $uid = $_SESSION['verified_user_id'];
                        $user = $auth->getUser($uid);
                        ?>
                                        <input type="hidden" name="change_password_btn" value="<?$user;?>">
                                        </div>
                                        <div class="col-md-6">
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
                                     </div>
                                        <?php

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
</div>

<?php
include('includes/footer.php');
?>