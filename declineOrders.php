<?php   include "connection.php";
    session_start();

    $printQuery = "SELECT * FROM decline_order ORDER BY decline_Id DESC";
    $printResult = mysqli_query($conn, $printQuery);


  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="stylesheet" href="css/declineOrders.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/logo_pasabuy.png" type="image/icon type">
</head>
<body>
    <?php include "sidebarAdmin.php"?>

    <div class="decline-container"><br><br>
        <div class="declineTitle"><center><h1><strong>Decline Orders</strong></h1></center></div><br>
        <table class="declineTable table table-striped table-hover">
            <tr class="fixedTop">
                <th>Order No.</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Product</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Others</th>
                <th>Order Date</th>
                <th>Status</th>
            
            </tr>
            <?php while($row = mysqli_fetch_assoc($printResult)){ 
                 $customerAdmin_Id =$row['customer_Id'];
                 $queryCustomer = "SELECT * FROM customer WHERE Customer_Id = '$customerAdmin_Id'";
                 $resultCustomer = mysqli_query($conn,$queryCustomer);
                 $rowCustomer = mysqli_fetch_assoc($resultCustomer);?>
            <tr class="declineTr">
                <td><br><br><?php echo $row['order_Id']?></td>
                <td><br><br><?php echo $rowCustomer["First_Name"].' '.$rowCustomer["Last_Name"]?></td>
                <td><br><br><?php echo $rowCustomer["Address"]?></td>
                <td><br><img src="<?php echo $row['product_image']?>"></td>
                <td><br><br><?php echo $row['product_name']?></td>
                <td><br><br>&#x20B1;<?php echo $row['product_price']?></td>
                <td><br><br><?php echo $row['product_quantity']?></td>
                <?php if($row['add_comment']){?>
                <td><br><p><br><?php echo $row['add_comment'];?></p></td>
                <?php }?>
                <?php if($row['add_comment'] == ""){?>
                <td><br><br>None</td>
                <?php }?>
                <td><br><br><?php echo $row['order_date']?></td>
                <td class="order_status"><br><br><?php echo $row['product_status']?></td>
                
   
            </tr>
            <?php }?>
        </table>
        
    </div>
</body>
</html>