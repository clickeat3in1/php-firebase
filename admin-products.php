<?php
include('admin_auth.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container">
            <div class="card">
           <!-- <?php
            if(isset($_SESSION['status']))
            {
                echo "<h6 class='alert alert-success'>".$_SESSION['status']."</h6>";
                unset($_SESSION['status']);
            }         
            ?> -->
                <div class="card-header">
                    <h1 class="h3 mb-0 text-gray-800">
                        Products
                    </h1>
                </div>
            </div>

                <div class="card">
                <div class="card-body">
                    
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr class="text-center">
                                <th > No.</th>
                                <th > Product Image</th>
                                <th > Store Name</th>
                                <th > Product Name</th>
                                <th > Price</th>
                                <th > Category</th>
                                <th > Description</th> 
                                <th >Actions</th>
                               
                            </tr>
                        </thead>
                        <tbody>

                             <?php
                                include('dbcon.php');

                                $ref_table = 'item/';
                                $fetchdata = $database->getReference($ref_table)     
                                ->getValue();

                                if($fetchdata > 0)
                                {
                                    $i=1;
                                    foreach($fetchdata as $key => $row)
                                    {
                                        ?>
                                        <tr class="text-center">
                                            <td><?=$i++;?></td>
                                            <td><img src="<?=$row['image']?>"
                                             width="60" height="60"></td>
                                             <td><?=$row['storename']?></td>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['price']?></td>
                                            <td><?=$row['category']?></td>
                                            <td><?=$row['description']?></td> 
                                            <td class="d-flex justify-content-center ">
                                            <!-- <a href="edit-products.php?id=<?=$key;?>" class="btn btn-primary btn-sm mr-2" 
                                            >Edit</a> -->
                                               <form action="code.php" method="POST">
                                                   <button type="submit"  name="delete_btn" value="<?=$key?>" class="btn btn-danger btn-sm">Delete</button>
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
