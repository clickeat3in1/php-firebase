<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar-merchant.php');
?>

<div class="container">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0 text-gray-800">
                        My Products
                        <a href="#" class="btn btn-primary float-right" 
                        data-toggle="modal" data-target="#addproducts"> Add Products</a>
                    </h1>
                </div>
            </div>

                <div class="card">
                <div class="card-body">
                    
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr class="text-center">
                                <th> No.</th>
                                <th> Product Image</th>
                                <th> Product Name</th>
                                <th> Price</th>
                                <th> Category</th>
                                <th> Description</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                             <?php
                                include('dbcon.php');
                                $uid = $_SESSION['verified_user_id'];
                                $user = $auth->getUser($uid);
                                $merchantid =  $user->uid;

                                $ref_table = 'item/';
                                $fetchdata = $database->getReference($ref_table)
                               ->orderByChild('merchantid')->equalTo($merchantid)
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
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['price']?></td>
                                            <td><?=$row['category']?></td>
                                            <td><?=$row['description']?></td> 
                                            <td class="d-flex justify-content-center ">
                                            <a href="edit-products.php?id=<?=$key;?>" class="btn btn-primary btn-sm mr-2" 
                                            >Edit</a>
                                                <!--<a href="edit-products.php?id=<?=$key;?>" class="btn btn-primary btn-sm mr-2" 
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
  
<!-- Modal Add Product -->
<div class="modal fade" id="addproducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="code.php" method="POST" autocomplete="off" enctype="multipart/form-data">

                    <div class="modal-body">
              
                    <div class="form-group">
                            <label>Product Category</label>
                            <input type="hidden" name="status_id" value=""> 
                        <div class="form-group ">
                            <select name="category" class="form-control"  required>
                                <option value=" ">Select Category</option>
                                <option value="Restaurant">Restaurant</option>
                                <option value="Milktea">Milktea</option>
                                <option value="Burger">Burger</option>
                                <option value="Pizza">Pizza</option>
                                <option value="Beverage">Beverage</option>
                                <option value="Cake">Cake</option>
                            </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group" style="display:inline">
                            <label for="">Description</label>
                            <textarea rows="3" name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <div class="form-group">
                                <input type="file" name="image" class="file-upload-default">
                            </div>
                        </div>
                      

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save_btn" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>   
