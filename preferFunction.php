<?php 
 include "connection.php";

 $customer_Id = $_POST['customer_Id'];
 $rider_Id = $_POST['rider_Id'];


    $selectCustomer = "SELECT First_Name, Last_Name FROM customer WHERE customer_Id = '$customer_Id'";
    $resultCustomer = mysqli_query($conn, $selectCustomer);
    $row = mysqli_fetch_assoc($resultCustomer);
    $customerName = $row['First_Name'].' '.$row['Last_Name'];

    $selectRider = "SELECT first_name, last_name FROM rider WHERE rider_Id = '$rider_Id'";
    $resultRider = mysqli_query($conn, $selectRider);
    $row1 = mysqli_fetch_assoc($resultRider);
    $riderName = $row1['first_name'].' '.$row1['last_name'];
    
     $insertPrefer = "INSERT INTO choose_rider(customer_Id,rider_Id,customer_name,rider_name) VALUE ('$customer_Id','$rider_Id','$customerName','$riderName')";
     $resultPrefer = mysqli_query($conn, $insertPrefer);

   
    

      
 if($resultPrefer == true){
        header("location:preferRider.php");
    }
    
  

 
 
 
 ?>