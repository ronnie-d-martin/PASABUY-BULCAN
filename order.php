<?php include "connection.php";

    session_start();

    $customer_Id = $_SESSION['userId'];
    $query = "SELECT customer_orderdetails.order_Id,customer_orderdetails.product_Id,customer_orderdetails.total,customer_orderdetails.quantity,customer_orderdetails.delivery_fee,customer_orderdetails.date_ordered, customer_order.order_status,product.product_price,product.product_name, product.product_image FROM customer_orderdetails INNER JOIN customer_order ON customer_orderdetails.order_Id = customer_order.order_Id INNER JOIN product ON customer_orderdetails.product_Id = product.product_Id WHERE customer_order.customer_Id = '$customer_Id'" ;
    $result = mysqli_query($conn,$query);

    if(isset($_POST['product_Id'])){

        $product_Id = $_POST['product_Id'];
        $order_Id = $_POST['order_Id'];

        $selectQuery = "SELECT * FROM product WHERE product_Id =  '$product_Id'";
        $selectResult = mysqli_query($conn,$selectQuery);
        $selectedTotal = 0;
        $allTotal = 0;
        $row = mysqli_fetch_assoc($selectResult);
        $selectedTotal = (int) $row['product_price'];
        $selectQuery2 = "SELECT * FROM customer_orderdetails WHERE order_Id = '$order_Id' ";
        $selectResult2 = mysqli_query($conn,$selectQuery2);
         $row2 = mysqli_fetch_assoc($selectResult2);
            $allTotal += (int) $row2['total']; 
          

        $newtotal = $allTotal - $selectedTotal;
        



        $updateQuery = "UPDATE customer_orderdetails SET total = '$newtotal' WHERE order_Id = '$order_Id'";
        $updateQueryResult = mysqli_query($conn,$updateQuery);

        $deleteQuery = "DELETE FROM customer_orderdetails WHERE product_Id =  '$product_Id'  AND order_Id = '$order_Id'";
        $deleteQueryResult = mysqli_query($conn,$deleteQuery);
      

        if($deleteQueryResult){
            header("location:order.php");
        }
        
    }
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/order.css">
    <title>Order Page</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
</head>
<body>
<?php include "sidebarCustomer.php";?>
    <div class="order-container">
        <table>
            <tr>
                <th>Product</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
                <th>Order Status</th>
                <th>Manage</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)){

             ?>
             <tr class="orders">
                <td><img src="<?php echo "Product Image/".$row['product_image'];?>"></td>
                <td><?php echo $row['product_name']?></td>
                <td><?php echo $row['quantity']?></td>
                <td>&#x20B1;<?php  echo$row['product_price']?></td>
                <td><?php echo$row['date_ordered']?></td>
                <td><?php echo $row['order_status']?></td>
                <td><form action="order.php" method="POST">
                <button type="button" class="cancelBtn">Cancel</button>
                <input type="hidden" name="product_Id" value = "<?php echo $row['product_Id'];?>">
                <input type="hidden" name="order_Id" value ="<?php echo $row['order_Id']?>">
                </form>
              </td>
              </tr>
                <?php }?>

                        
        </table>
        <?php if(mysqli_num_rows($result)<=0){
                
                ?>

               <br><h2> No items Selected</h2> 
               <?php }?>
    </div>
    <script src="js/order.js"></script>
</body>
</html>