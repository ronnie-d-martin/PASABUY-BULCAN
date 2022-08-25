<?php 

    include "connection.php";

    session_start();
    
    $date = date("Y-m-d");
    $customer_Id = $_SESSION['userId'];
    $product_Id = $_POST['product_Id'];
    $delivery_fee = 60;
    $order_status = "Pending Order";
    $quantity = $_POST['buyNowquantity'];
    $product_price = $_POST['product_price'];

    $subTotal = (int)$quantity * (int)$product_price;
    
    
    $orderQuery = "INSERT INTO customer_order(customer_Id,order_status) VALUE ('$customer_Id','$order_status')";
    $result = mysqli_query($conn,$orderQuery);
    $order_Id = mysqli_insert_id($conn);  
      
    $orderdetailsQuery = "INSERT INTO customer_orderdetails(order_Id,product_Id,total,quantity,delivery_fee,date_ordered) VALUES('$order_Id','$product_Id','$subTotal','$quantity','$delivery_fee','$date')";
     $orderdetailsResult = mysqli_query($conn,$orderdetailsQuery);
    


   if($result == true && $orderdetailsQuery == true){
    header("location:accountCustomer.php?my_orders");
}
    
    
    
?>