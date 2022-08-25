<?php include "connection.php";


    $customer_Id = $_SESSION['userId'];
    $query = "SELECT customer_orderdetails.order_Id,customer_orderdetails.product_Id,customer_orderdetails.total,customer_orderdetails.quantity,customer_orderdetails.delivery_fee,customer_orderdetails.date_ordered, customer_order.order_status,product.product_price,product.product_name, product.product_image FROM customer_orderdetails INNER JOIN customer_order ON customer_orderdetails.order_Id = customer_order.order_Id INNER JOIN product ON customer_orderdetails.product_Id = product.product_Id WHERE customer_order.customer_Id = '$customer_Id' ORDER BY field(customer_order.order_status,'Pending Order','Rider Pending','Processing', 'Out for Delivery', 'Delivered')";
    $result = mysqli_query($conn,$query);

    if(isset($_POST['product_Id'])){

        $product_Id = $_POST['product_Id'];
        $order_Id = $_POST['order_Id'];

        $selectQuery = "SELECT * FROM product WHERE product_Id = '$product_Id'";
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
    

        echo("<meta http-equiv='refresh' content='0'>");
           
        
    
    }
    
 

?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
        <thead>
            <tr class="fixedTop">
                <th>Product</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
                <th>Order Status</th>
                <th>Manage</th>
            </tr>
            </thead>
         

            <?php while($row = mysqli_fetch_assoc($result)){
            $order_Id_rating1 = $row['order_Id'];

            $queryRating = "SELECT * FROM rating WHERE order_Id = '$order_Id_rating1'";
            $resultRating = mysqli_query($conn,$queryRating);
               
            $isFeedback = false;
            if(mysqli_num_rows($resultRating)>=1){
                $isFeedback = true;
            }
             ?>
             <tr class="orders">
                <td><img src="<?php echo "Product Image/".$row['product_image'];?>"></td>
                <td><?php echo $row['product_name']?></td>
                <td><?php echo $row['quantity']?></td>
                <td>&#x20B1;<?php  echo$row['product_price']?></td>
                <td><?php echo$row['date_ordered']?></td>
                <td><?php echo $row['order_status']?></td>
                <td><form action="accountCustomer.php?my_orders" method="POST">
                <?php if($row['order_status'] == "Pending Order"){ ?>               
                <button type="button" class="cancelBtn btn btn-danger">Cancel</button>
                <?php }else if($row['order_status'] == "Out for Delivery"){ ?>
                <button type="button" class="showchat btn btn-info" name="chat">Chat</button>                
                <?php }else if($row['order_status'] == "Delivered"){        
                    if($isFeedback == false){                
                        ?>
                <button type="button" class="feedBack btn btn-danger">Feedback</button>                
                <?php }}?>
                <input type="hidden" name="product_Id" value = "<?php echo $row['product_Id'];?>">
                <input type="hidden" name="order_Id" class="order_Id_rating" value ="<?php echo $row['order_Id']?>">
                </form>
              </td>
              </tr>

            <?php }?>  
     
        </table>       
        
        <?php if(mysqli_num_rows($result)<=0){
                
                ?>
               <br><h2> No items Selected</h2> 
               <?php }?>
               <br><br><br>
    </div>

    

 
    
