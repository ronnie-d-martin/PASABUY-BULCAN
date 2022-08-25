<?php  include "connection.php";
    session_start();
    $rider_Id = $_SESSION['userId'];
   

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/riderpage.css?v=<?php echo time(); ?>">
    <title>Rider Page</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
</head>
<body>
    <?php include "sidebarRider.php";?>
    <div class="pending-container" style="overflow-x: auto;">
    <center><h1>Available Orders</h1></center>
        <table class="riderPage table table-striped table-hover" id="tablerider" >   
            <tr>
                <th>Order No.</th>
                <th>Customer Name</th>
                <th>Customer Address</th> 
                <th>Contact No.</th>
                <th>Merchant Name</th>
                <th>Product Name</th>               
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Others</th>
                <th>Action</th>
            </tr>
            <?php 
            $query = "SELECT * FROM rider_pending WHERE rider_Id = '$rider_Id' ";
            $result = mysqli_query($conn,$query);

            $checkDelivery ="SELECT * FROM delivery WHERE rider_Id ='$rider_Id'";
            $resultChecked = mysqli_query($conn, $checkDelivery);

                while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr class="pending-items">
            <td><?php echo $row['order_Id']?></td>
            <td><?php echo $row['customer_name']?></td>
            <td><?php echo $row['customer_address']?></td>
            <td><?php echo $row['customer_contactno']?></td>
            <td><?php echo $row['merchant_name']?></td>
            <td><?php echo $row['product_name']?></td>
            <td>&#x20B1;<?php echo $row['product_price']?></td>
            <td><?php echo $row['quantity']?></td>
            <?php if($row['add_comment']){?>
                <td><p><?php echo $row['add_comment'];?></p></td>
                <?php }?>
                <?php if($row['add_comment'] == ""){?>
                <td>None</td>
                <?php }?>
            <td><form action="riderpageFunction.php" method="post">
                 <input type="hidden" name="order_Id" value ="<?php echo $row['order_Id']?>">
                 <?php 
                    if(mysqli_num_rows($resultChecked) <= 0){
                 ?>
                 <input type="button" value="Accept" name ="acceptBtn" class="acceptBtn btn btn-success">
                 <?php }?>
            </form></td>
        </tr>
        <?php }?>
        </table>
    </div>
    <script src="js/riderpage.js"></script>
</body>
</html>