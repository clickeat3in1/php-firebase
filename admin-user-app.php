<?php
include('admin_auth.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0 text-gray-800">
                        User App
                    </h1>
                </div>
            </div>

        <div class="card">
        <div class="card-body">
            
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr class="text-center">
                        <th > No.</th>
                        <th > Email</th>
                        <th > Name</th>
                        <th > User's ID</th>
                        <th >Actions</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                        <?php
                        include('dbcon.php');

                        $ref_table = 'user/';
                        $fetchdata = $database->getReference($ref_table)->getValue();

                        if($fetchdata > 0)
                        {
                            $i=1;
                            foreach($fetchdata as $key => $row)
                            {
                                ?>
                                <tr class="text-center">
                                    <td><?=$i++;?></td>
                                    <td><?=$row['email']?></td>
                                    <td><?=$row['name']?></td>
                                    <td>
                                        <form action="code.php" method="POST">
                                            <button type="submit"  name="userapp_delete_btn" value="<?=$key?>" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td colspan="7">No Record Found</td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>   
