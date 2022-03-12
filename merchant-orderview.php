<?php
include('authentication.php');
include('includes/header.php');
include('includes/navbar-merchant.php');
?>
<div class="card shadow mb-4">
        <?php
            include('dbcon.php');

            if(isset($_GET['id']))
            {
                $key_child = $_GET['id'];

                $ref_table= 'orders/';
                $getdata = $database->getReference($ref_table)->getChild($key_child)->getValue();

                if($getdata > 0)
                {
                ?> 
            <div class="card-body">
              <div class="form-group row text-left mb-0">
                <div class="col-sm-9">
                  <h5 class="font-weight-bold">
                    Transaction Details
                  </h5>
                  <h6>
                    OrderID: <?=$key_child?>
                  </h6>
                  <h6>
                    Status: <?=$getdata['status']?>
                  </h6>

                </div>
                <div class="col-sm-3 py-1">
                    
                  <h6>
                    Date: <?=$getdata['date']?>
                  </h6>
                </div>
              </div>
<hr>
              <div class="form-group row text-left">
                <div class="col-sm-5 py-1">
                  <h6>
                    Customer's Name: <?=$getdata['deliveryinfo']['name']?>
                  </h6>
                  <h6>
                    Phone: <?=$getdata['deliveryinfo']['pnumber']?>
                  </h6>
                  <h6>
                    Address: <?=$getdata['deliveryinfo']['detailadd']?>
                  </h6>
                </div>
              </div>

          <table class="table table-bordered" width="50%" cellspacing="0">
            <thead>
              <tr style="text-align:center;">
                <th width="20%">Products</th>
                <th width="20%">Quantity</th>
                <th width="20%">Price</th>
                <th width="20%">Subtotal</th>
              </tr>
            </thead>
            <tbody>
            <tr style="text-align:center;">
                    <td><?php foreach ($getdata['items'] as $task) {
                            echo $task['name'] .'<br>' .'<br>';
                      }?></td>
                    <td><?php foreach ($getdata['items'] as $task) {
                            echo $task['quantity'] .'<br>' .'<br>';
                      }?></td>
                    <td><?php foreach ($getdata['items'] as $task) {
                            echo $task['price'] .'<br>' .'<br>';
                      }?></td>
                    <td><?php 
                        $subtotal=0;
                        foreach ($getdata['items'] as $task) {
                          $subtotal = $task['price'] * $task['quantity'];
                          echo  $subtotal.'<br>' .'<br>';
                      }?></td>
            </tr>
            </tbody>
          </table>
          
            <div class="form-group row text-left mb-0 py-2">
                <div class="col-sm-4 py-1"></div>
                <div class="col-sm-3 py-1"></div>
                <div class="col-sm-4 py-1">
                 <!-- <h4>
                    Cash Amount: ₱ <?php foreach ($getdata['items'] as $task) {
                            echo $task['name'];
                    }?>
                  </h4> -->
                  <table width="100%">
                    <tr>
                      <td class="font-weight-bold">Subtotal</td>
                      <td class="text-right">
                        ₱ <?php 
                          $total=0;
                          foreach ($getdata['items'] as $task) {
                            $subtotal = $task['price'] * $task['quantity'];
                            $total += $subtotal;
                          }
                          echo $total;
                          ?>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Delivery Fee</td>
                      <td class="text-right">₱ <?=$getdata['deliveryfee']?> </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Total</td>
                      <td class="font-weight-bold text-right text-warning">₱ <?=$getdata['total']?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-sm-1 py-1"></div>
              </div>
            </div>
            <?php
                }   
                else
                {
                    $_SESSION['status'] = "Invalid Id"; 
              
                    exit();           
                }
            }
            else
            {
                    $_SESSION['status'] = "No Found"; 
                   
                    exit();           
                }
            
            
            ?>  
          </div>
