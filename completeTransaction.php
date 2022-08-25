<?php 

    include "connection.php";
    session_start();

    $rider_Id = $_SESSION['userId'];
        
    $query = "SELECT * FROM delivery WHERE rider_Id = '$rider_Id'";
    $result = mysqli_query($conn, $query);

    $queryTransaction1 = "SELECT * FROM transaction WHERE rider_Id = '$rider_Id'";
    $resultTransaction1 = mysqli_query($conn, $queryTransaction1);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="icon" href="images/logo_pasabuy.png" type="image/icon type">
    <link rel="stylesheet" href="css/adminOrders.css">
    
</head>
<body>
<?php include "sidebarRider.php"?>
        <div class="containerTransaction"  style="overflow-x: auto;">          
        <center><h1>Transaction History</h1></center>
            <table class="table table-striped table-hover">
                <tr class="transactionTable">
                    <th>Transaction Id</th>
                    <th>Proof Image</th>
                    <th>Customer Name</th>
                    <th>Customer Address</th>
                    <th>Customer Contact No.</th>
                    <th>Merchant Name</th>
                    <th>Product Name</th>
                    <th>Others</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
            
        <?php
            while($row = mysqli_fetch_assoc($resultTransaction1)){
           
        ?>
        <tr class="transactionTable">
                <td><br><?php echo $row['transaction_Id']?></td>
                <td><img src="<?php echo "Proof Image/".$row['proof_image']?>"></td>
                <td><br><?php echo $row['customer_name']?></td>
                <td><br><?php echo $row['customer_address']?></td>
                <td><br><?php echo $row['customer_contactno']?></td>
                <td><br><?php echo $row['merchant_name']?></td>
                <td><br><?php echo $row['product_name']?></td>
                <?php if($row['add_comment']){?>
                <td><br><p><?php echo $row['add_comment'];?></p></td>
                <?php }?>
                <?php if($row['add_comment'] == ""){?>
                <td><br>None</td>
                <?php }?>
                <td><br><?php echo $row['total']?></td>
                <td><br><?php echo $row['date']?></td>
                
            </tr> 
                <?php }?>
            </table>

            
        </div>

</body>
</html>