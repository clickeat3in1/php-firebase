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
                <h1 class="h3 mb-0 text-gray-800">Add Product </h1>
                </div>
                <div class="card-body">
                
                    <form action="code.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                   
                        <div class="form-group mb-3">
                            <label for="">Product Category</label>
                            <input type="text" name="category" placeholder="Resto / Milktea /Burger / Pizza"  
                            class="form-control">
                        </div>
                       <!--  <div class="form-group mb-3">
                            <label for="">Product Image</label>
                            <input type="text" name="name" class="form-control">
                        </div>-->
                        <div class="form-group mb-3">
                            <label for="">Product Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                     <!--   <div class="form-group mb-3">
                             <label for="">Description</label>
                             <input type="text" name="description" class="form-control">
                        </div>-->
                        <div class="form-group mb-3">
                            <label for="">Price</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                        
                        <div class="form-group">
                        <label>Upload Image</label>
                      </div>
                      <div class="form-group">
                        <input type="file" name="image" class="file-upload-default">
                      </div>
                      
                        <div class="form-group mb-3">
                        <a href="norole.php" class="btn btn-danger float-left mr-3"> Cancel</a>
                            <button type="submit" name="save_btn" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                    

                </div>   
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>