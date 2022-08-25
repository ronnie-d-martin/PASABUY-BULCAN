<?php 
    include "connection.php";

    session_start();

  
    $order_Id = $_POST['order_Id'];
    $updateQuery = "UPDATE customer_order SET order_status ='Processing' WHERE order_Id = '$order_Id'";
    $result = mysqli_query($conn,$updateQuery);

    if($result){
       header("location:adminOrders.php");
    }

  
 
  
    
  
   


?>