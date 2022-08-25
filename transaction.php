<?php 

    include "connection.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="stylesheet" href="css/adminOrders.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/logo_pasabuy.png" type="image/icon type">
    
</head>
<body>
<?php include "sidebarAdmin.php"?>
<form action="searchProduct.php" method="post" enctype="multipart/form-data" class="searchForm">
        <input type="search" id="transaction_search" name="transaction_name" placeholder="Search Customer" class="formSearch">
        <input type="submit" class="btn btn-primary">
        <input type="submit" value="refresh" name="refresh5"  class="btn btn-success">
    </form>
        <div class="containerTransaction">
            <table class="table table-striped table-hover">
                <tr class="transactionTable">
                    <th>Transaction Id</th>
                    <th>Rider_Id</th>
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
         $searchTransaction_name = "";
         if(isset($_GET['transaction_name'])){
             $searchTransaction_name = $_GET['transaction_name'];
         } 
            $queryTransaction = "SELECT * FROM transaction WHERE customer_name LIKE '%$searchTransaction_name%' ORDER BY transaction_Id DESC ";
            $resultTransaction = mysqli_query($conn, $queryTransaction);
            while($row = mysqli_fetch_assoc($resultTransaction)){
           
        ?>
        <tr class="transactionTable">
                <td><br><?php echo $row['transaction_Id']?></td>
                <td><br><?php echo $row['rider_Id']?></td>
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