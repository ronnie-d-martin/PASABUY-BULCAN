<?php 
     include "connection.php";


     session_start();

     $customer_Id = $_SESSION['userId'];

     $notifquery = "SELECT * FROM notification WHERE customer_Id = $customer_Id ";
     $resultnotif = mysqli_query($conn, $notifquery);

     $row = mysqli_fetch_assoc($resultnotif);

     $customer_Id = $row['customer_Id'];
     $customer_name = $row['customer_name'];
     $product_name = $row['product_name'];

    
     echo "Your order.'$product_name'.has been declined.";



?>