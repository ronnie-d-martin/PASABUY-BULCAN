<?php   include "connection.php";

    session_start();
  

    $query = "SELECT customer_orderdetails.order_Id,customer_orderdetails.product_Id,customer_orderdetails.total,customer_orderdetails.quantity,customer_orderdetails.add_comment,customer_orderdetails.delivery_fee,customer_orderdetails.date_ordered, customer_order.order_status,customer_order.customer_Id,product.product_Id,product.product_price,product.product_name, product.product_image FROM customer_orderdetails INNER JOIN customer_order ON customer_orderdetails.order_Id = customer_order.order_Id INNER JOIN product ON customer_orderdetails.product_Id = product.product_Id WHERE NOT customer_order.order_status = 'Delivered' ORDER BY field(customer_order.order_status,'Processing', 'Pending Order','Rider Pending', 'Out for Delivery', 'Delivered')";
    $result = mysqli_query($conn,$query);
    
    
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
    <div class="order-container"><br>
        <div class="titleOrder"><h1><strong>Active Orders</strong></h1></div>
        <table class="OrderTable table table-striped table-hover">
            <tr class="fixedTop">
                <th>Order No.</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Product</th>
                <th>Name</th>
                <th>Price</th>      
                <th>Order Date</th>
                <th>Quantity</th>
                <th>Others</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)){ 
                $customerAdmin_Id =$row['customer_Id'];
                $queryCustomer = "SELECT * FROM customer WHERE Customer_Id = '$customerAdmin_Id'";
                $resultCustomer = mysqli_query($conn,$queryCustomer);
                
                 $rowCustomer = mysqli_fetch_assoc($resultCustomer);?>
            <tr class="orders">
                <td><br><?php echo $row['order_Id']?></td>
                <td><br><?php echo $rowCustomer["First_Name"].' '.$rowCustomer["Last_Name"]?></td>
                <td><br><?php echo $rowCustomer["Address"]?></td>
               <td><img src="<?php echo "Product Image/".$row['product_image']?>"></td>
                <td><br><?php echo $row['product_name']?></td>
                <td><br>&#x20B1;<?php echo $row['product_price']?></td>
                <td><br><?php echo $row['date_ordered']?></td>
                <td><br><?php echo $row['quantity']?></td>
                <?php if($row['add_comment']){?>
                <td><br><p><?php echo $row['add_comment'];?></p></td>
                <?php }?>
                <?php if($row['add_comment'] == ""){?>
                <td><br>None</td>
                <?php }?>
                <td class="order_status"><br><?php echo $row['order_status']?></td>
                <td><form action="adminOrdersFunction.php" method="POST">
                <input type="hidden" name="order_Id" value="<?php echo $row['order_Id']?>">
                    <?php if($row['order_status'] == "Pending Order") {?>
                    <input type="button" value="Accept Order" name ="acceptBtn" class="acceptBtn btn btn-info">
                    <?php } else if($row['order_status'] == "Processing") { ?>
                       <br> <input type="button" value="Pick Rider" name ="pickRiderBtn" class="pickRiderBtn btn btn-success">
                        <?php }?>
                </form>
                <?php if($row['order_status'] == "Pending Order") {?>
                <form action="adminDecline.php" method="POST">              
                    <input type="button" value="Decline Order" name ="declineBtn" class="declineBtn btn btn-danger">
                    <input type="hidden" name="order_Id" value="<?php echo $row['order_Id']?>">
                </form> <?php }?></td>
            </tr>
            <?php }?>
        </table>
        
    </div>

    <div class="modal">
        <div class="modal-content">
        <h2 class="closeBtn">&times;</h2> 
        <table class="table table-hover">
            <tr>
                <th>Rider Id</th>
                <th>Rider Picture</th>
                <th>Rider Name</th>
                <th>Address</th>
                <th>Contact No.</th>
                <th>Status</th>
                <th>Action</th>
              
            </tr>
            <?php $riderInfo = "SELECT * FROM rider";
                $riderInfoResult = mysqli_query($conn,$riderInfo);
                while($row2 = mysqli_fetch_assoc($riderInfoResult)){ ?>
            <tr class="modal-items">
               <td><br><?php echo $row2["rider_Id"]?></td>
               <td><img src="<?php echo "Rider Image/".$row2["rider_image"]?>"></td>
               <td><?php echo $row2["first_name"].$row2['last_name']?></td>
               <td><?php echo $row2["address"]?></td>
               <td><?php echo $row2["contact_no"]?></td>
               <td><?php echo $row2["rider_status"]?></td>
               <td><form action="adminOrdersFunction2.php" method="post">
                   <input type="hidden" name ="order_Id" class="modal_order_Id">
                   <input type="hidden" name="rider_Id" value ="<?php echo $row2["rider_Id"]?>">
                   <input type="button" value="Select" name ="select_riderBtn" class="modal_selectBtn btn btn-success">
               </form></td>
            </tr>
                <?php }?>

        </table>
        </div>
      
    </div>
   
    <script src="js/adminOrders.js"></script>
    
</body>
</html>