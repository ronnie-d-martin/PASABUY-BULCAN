<?php 
     include "connection.php";

     session_start();

     $customer_Id = $_SESSION['userId'];

     $notifquery = "SELECT * FROM notification WHERE customer_Id = $customer_Id";
     $resultnotif = mysqli_query($conn, $notifquery);

    while($row = mysqli_fetch_assoc($resultnotif)){
     $notification_Id = $row['notification_Id'];
     $customer_name = $row['customer_name'];
     $product_name = $row['product_name'];

     echo ' <div>__________________________________________________________________</div>
     <div id="customername">'.$customer_name.'</div>
     <div id="description">Your Order '.$product_name.' has been Declined</span></div> ';
    } 

  




?>