<?php 
include "connection.php";

session_start();

    $customer_Id = $_SESSION['userId'];

    $queryCustomer = "SELECT * FROM customer WHERE Customer_Id = '$customer_Id'";
    $resultCustomer = mysqli_query($conn,$queryCustomer);

    $row = mysqli_fetch_assoc($resultCustomer);

    $customer_name = $row['First_Name'].' '.$row['Last_Name'];

    $queryTransaction = "SELECT * FROM transaction WHERE customer_name = '$customer_name'";
    $resultTransaction = mysqli_query($conn, $queryTransaction);

 ?>
<h1>Transactions</h1>
<div class="table-responsive">
        <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Merchant Name</th>
                <th>Product Name</th>
                <th>Others</th>
                <th>Date</th>
                <th>Status</th>

            </tr>
            </thead>
            <?php

             while($rowTransaction = mysqli_fetch_assoc($resultTransaction)){
             ?>
             <tr>
                 <td><?php echo $rowTransaction['transaction_Id'];?></td>
                 <td><?php echo $rowTransaction['merchant_name'];?></td>
                 <td><?php echo $rowTransaction['product_name'];?></td>
                 <?php if($rowTransaction['add_comment']){?>
                <td><p><?php echo $row['add_comment'];?></p></td>
                <?php }?>
                <?php if($rowTransaction['add_comment'] == ""){?>
                <td>None</td>
                <?php }?>
                 <td><?php echo $rowTransaction['date'];?></td>
                 <td>Delivered</td>
           
             </tr>

            <?php }?>  
     
        </table>       
    </div>