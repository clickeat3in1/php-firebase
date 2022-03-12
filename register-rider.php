<?php
include('admin_auth.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container">

            <div class="card">
            <?php
            if(isset($_SESSION['status']))
            {
                echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                unset($_SESSION['status']);
            }         
            ?>
          
                <div class="card-header">
                    <h1 class="h3 mb-0 text-gray-800">
                        Rider
                       <a href="#" class="btn btn-primary float-right" 
                        data-toggle="modal" data-target="#addrider"> Add Rider</a> 
                    </h1>
                </div>
            </div>

                <div class="card">
                <div class="card-body">
                    
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr class="text-center">
                                <th > No.</th>
                                <th > Rider Image</th>
                                <th > Rider Name</th>
                                <th > Email</th>
                                <th > Phone Number</th>
                                <th > Address</th>
                                <th >Actions</th>
                               
                            </tr>
                        </thead>
                        <tbody>

                             <?php
                                include('dbcon.php');
                              


                                $ref_table = 'rider/';
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
                                            <td><?=$row['ridername']?></td>
                                            <td><?=$row['email']?></td>
                                            <td><?=$row['phonenumber']?></td> 
                                            <td><?=$row['address']?></td>
                              
                                            <td class="d-flex justify-content-center ">
                                            <a href="edit-rider.php?id=<?=$key;?>" class="btn btn-primary btn-sm mr-2" 
                                            >Edit</a>
                                               <form action="ridercode.php" method="POST">
                                                   <button type="submit"  name="rider_delete_btn" value="<?=$key?>" class="btn btn-danger btn-sm">Delete</button>
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
<div class="modal fade" id="addrider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Rider </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="ridercode.php" method="POST" autocomplete="off" enctype="multipart/form-data">

                    <div class="modal-body">
              
                        <div class="form-group">
                            <label> Rider Name </label>
                            <input type="text" name="ridername" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" name="phonenumber" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
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
                        <button type="submit" name="rider_register_btn" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>   
