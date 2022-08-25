<?php 

    include "connection.php";

    session_start();

   $date = date("Y-m-d");
   $customer_Id = $_SESSION['userId'];
   $total = $_POST['total'];
   $quantity = $_POST['quantity'];
   $add_comment = $_POST['add_comment'];
   $delivery_fee =60;
   $order_status = "Pending Order";
   $product_Id = $_POST['product_Id'];

   $total = (int) $total + $delivery_fee;
   $newtotal = strval($total);
 
   $orderQuery = "INSERT INTO customer_order(customer_Id,order_status) VALUE ('$customer_Id','$order_status')";
   $result = mysqli_query($conn,$orderQuery);
   $order_Id = mysqli_insert_id($conn);     
    
   for($i = 0; $i <count($quantity); $i++){
        $orderdetailsQuery = "INSERT INTO customer_orderdetails(order_Id,product_Id,total,quantity,add_comment,delivery_fee,date_ordered) VALUES('$order_Id','$product_Id[$i]','$newtotal','$quantity[$i]','$add_comment[$i]','$delivery_fee','$date')";
        $orderdetailsResult = mysqli_query($conn,$orderdetailsQuery);
    
   }

   
    $deleteQuery = "DELETE FROM cart WHERE customer_Id = '$customer_Id'";
    $deleteResult = mysqli_query($conn,$deleteQuery);
    

    if($result == true && $orderdetailsQuery == true){
        header("location:accountCustomer.php?my_orders");
    }
    
    
    
    
    

?>