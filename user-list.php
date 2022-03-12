<?php
include('admin_auth.php');
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
        <div class="row">
            <div class="col-md-12">
                
                <div class="card">
                    <div class="card-header">
                    <h4>
                        Registered User
                    </h4>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered" id='dataTable'>
                        <thead>
                            <tr class="text-center">
                                <th>Sl.no</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email Id</th>
                                <th>Role as</th>
                                <th>Disable/Enable</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            include('dbcon.php');
                            $users = $auth->listUsers();

                            $i=1;
                            foreach ($users as $user) 
                            {
                                ?>
                                <tr class="text-center">
                                    <td><?=$i++;?></td>
                                    <td><?=$user->displayName ?></td>
                                    <td><?=$user->phoneNumber ?></td>
                                    <td><?=$user->email ?></td>
                                    <td>
                                    <span>
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
                                        ?>
                                    </span>
                                </td>
                                    <td>
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
                                    </td>
                                    <td class="d-flex justify-content-center ">
                                        <a href="user-edit.php?id=<?=$user->uid;?> " class="btn btn-primary btn-sm mr-2">Edit</a>
                                    
                                        <!--<a href="user-delete.php" class="btn btn-danger btn-sm">Delete</a> -->
                                        <form action="code.php" method="POST">
                                            <button type="submit" name="reg_user_delete_btn" 
                                            value="<?=$user->uid; ?>" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>