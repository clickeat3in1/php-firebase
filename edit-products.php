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
                <h1 class="h3 mb-0 text-gray-800">Edit Product </h1>
                </div>
                <div class="card-body">

                    <?php
                        include('dbcon.php');

                        if(isset($_GET['id']))
                        {
                            $key_child = $_GET['id'];

                            $ref_table= 'item/';
                            $getdata = $database->getReference($ref_table)->getChild($key_child)->getValue();

                            if($getdata > 0)
                            {
                                ?>   
                                <form action="code.php" method="POST">
                                
                                <input type="hidden" name="key" value="<?=$key_child;?>">
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <input type="hidden" name="status_id" value=""> 
                                    <div class="form-group ">
                                    <select name="category"  class="form-control"  required>
                                        <option value="<?=$getdata['category'];?>" ><?=$getdata['category'];?></option>
                                        <option value="Restaurant">Restaurant</option>
                                        <option value="Milktea">Milktea</option>
                                        <option value="Burger">Burger</option>
                                        <option value="Pizza">Pizza</option>
                                        <option value="Beverage">Beverage</option>
                                        <option value="Cake">Cake</option>
                                    </select>
                                </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Product Name</label>
                                    <input type="text" name="name"  value="<?=$getdata['name'];?>" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea  rows="3" name="description"  class="form-control">
                                        <?=$getdata['description'];?>
                                    </textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Price</label>
                                    <input type="number" name="price" value="<?=$getdata['price'];?>" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                   <a href="merchant-products.php" class="btn btn-danger float-left mr-3"> Cancel</a>
                                   <button type="submit" name="updated_btn" class="btn btn-primary">Update</button>
                                    
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