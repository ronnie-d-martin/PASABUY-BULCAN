<?php  include "connection.php";
    session_start();
    $rider_Id = $_SESSION['userId'];
    
        
        $order_Id = $_POST['order_Id'];

        $selectRiderPending = "SELECT * FROM rider_pending WHERE order_Id = '$order_Id'";
        $selectRiderPendingResult = mysqli_query($conn,$selectRiderPending);
      
        while($row = mysqli_fetch_assoc($selectRiderPendingResult)){
           
            $customer_name =$row['customer_name'];
            $customer_address = $row['customer_address'];
            $customer_contactno = $row['customer_contactno'];
            $merchant_name = $row['merchant_name'];
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $quantity = $row['quantity'];
            $total = $row['total'];
            $add_comment = $row['add_comment'];


            $deliveryQuery = "INSERT INTO delivery(order_Id,rider_Id,customer_name,customer_address,customer_contactno,merchant_name,product_name,product_price,quantity,total,add_comment) VALUES ('$order_Id','$rider_Id','$customer_name','$customer_address','$customer_contactno','$merchant_name','$product_name','$product_price','$quantity','$total','$add_comment')";
            $deliveryResult = mysqli_query($conn,$deliveryQuery);

            
           $updateOrder = "UPDATE customer_order SET order_status = 'Out for Delivery' WHERE order_Id = '$order_Id'";
           $updateResult = mysqli_query($conn,$updateOrder);

            $deletePending = "DELETE FROM rider_pending  WHERE order_Id= '$order_Id'";
            $deleteResult = mysqli_query($conn,$deletePending);

        }

        if($deleteResult == true && $updateResult == true && $deliveryResult == true ){

            header("location:riderpage.php?");
            
        }
        
    


    ?>
