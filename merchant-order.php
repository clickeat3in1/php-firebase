<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h1 class="h3 mb-0 text-gray-800">Orders</h1>
                </div>
                
                <div class="card-body">
                <div class="table-responsive">
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr style="text-align:center;">
                                <th> No.</th>
                                <th > Order ID</th>
                                <th > Customer Name</th>
                                <th > No. of Items</th>
                                <th>Status</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                include('dbcon.php');
                                $uid = $_SESSION['verified_user_id'];
                                $user = $auth->getUser($uid);
                                $merchantid =  $user->displayName;

                                $ref_table = 'orders/';
                                $fetchdata = $database->getReference($ref_table)
                                ->orderByChild('items/merchantid')->equalTo($merchantid)
                                ->getValue();
                                echo $fetchdata;

                                if($fetchdata > 0)
                                {
                                    $i=1;
                                    foreach($fetchdata as $key => $row)
                                    {
                                       
                                        ?>
                                        <tr style="text-align:center;">
                                            <td><?=$i++;?></td>
                                            <td><?=$key?></td>
                                            <td><?=$row['deliveryinfo']['name']?></td>
        
                                            <td> <?php 
                                            $result=0;
                                            foreach ($row['items'] as $task) {
                                              $result+=$task['quantity'];
                                            }
                                            echo  $result;
                                            ?> </td>
                                            
                                            <td><?=$row['status']?></td>
                            
                                            <td class="d-grid gap-2 d-md-flex justify-content-center ">
                                                <a class="btn btn-primary btn-sm mr-1" href="merchant-orderview.php?id=<?=$key;?>">View</a>
                                            </td>
                                            
                                            <!-- <td> 
                                                <form action="code.php" method="POST">
                                                    <input type="hidden" name="status_id" value="<?=$key;?>"> 
                                                    <div class="form-group mb-3">
                                                        <select name="status" class="form-control" onchange="form.submit()" required>
                                                            <option value=" "><?=$row['status']?></option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Transporting">Transporting</option>
                                                            <option value="Completed"> Completed</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </td> -->
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


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>