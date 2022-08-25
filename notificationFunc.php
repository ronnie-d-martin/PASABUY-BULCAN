<?php 
     include "connection.php";

     session_start();

     $customer_Id = $_SESSION['userId'];

     $notifquery = "SELECT * FROM notification WHERE customer_Id = $customer_Id";
     $resultnotif = mysqli_query($conn, $notifquery);


     if($resultnotif){
          echo $resultnotif -> num_rows;
     }
     



?>