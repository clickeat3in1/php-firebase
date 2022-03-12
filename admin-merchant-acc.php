<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
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
                    <h1 class="h3 mb-0 text-gray-800">
                       Merchants
                    </h1>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th> No.</th>
                                <th> Owner Name</th> 
                                <th> Store Name</th>
                                <th> Email</th>
                                <th> Phone number</th>
                                <th> Address</th>
                                <th>Actions</th> 
                               
                            </tr>
                        </thead>
                        <tbody>


                        
                             <?php
                                include('dbcon.php');

                                $ref_table = 'merchant/';
                                $fetchdata = $database->getReference($ref_table)->getValue();

                                if($fetchdata > 0)
                                {
                                    $i=1;
                                    foreach($fetchdata as $key => $row)
                                    {
                                        ?>
                                        <tr class="text-center">
                                            <td><?=$i++;?></td>
                                            <td><?=$row['ownerName']?></td>
                                            <td><?=$row['storeName']?></td>
                                            <td><?=$row['email']?></td>
                                            <td><?=$row['phone']?></td>
                                            <td><?=$row['address']?></td>
                                            <td><form action="code.php" method="POST">
                                                   <button type="submit"  name="merchant_delete_btn" value="<?=$key?>" class="btn btn-danger btn-sm">Delete</button>
                                               </form></td>
                                            <!--  <td class="d-grid gap-2 d-md-flex justify-content-center ">
                                                <a href="edit-products.php?id=<?=$key;?>" class="btn btn-primary btn-sm mr-1">Edit</a>
                                            
                                              <a href="delete-product.php" class="btn btn-danger btn-sm">Delete</a> 
                                               <form action="code.php" method="POST">
                                                   <button type="submit"  name="delete_btn" value="<?=$key?>" class="btn btn-danger btn-sm">Delete</button>
                                               </form>
                                            </td>-->
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