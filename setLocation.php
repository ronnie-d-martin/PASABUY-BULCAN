<?php 
    include "connection.php";

    session_start();

    $customer_Id = $_SESSION['userId'];
    $value = $_POST["city"];
    $text = $_POST["make_text"];
    $value1 = $_POST["barangay"];
    $text1 = $_POST["make_text1"];
    $street = $_POST["street"];

    $newLoc = $street.', '.$text.', '.$text1.', '."Bulacan";

    $updateLocation = "UPDATE customer SET Address = '$newLoc' WHERE customer_Id = '$customer_Id'";
    $resultLoc = mysqli_query($conn,$updateLocation);
  
    $selectShipping = "SELECT * FROM shipping WHERE municipality_name LIKE '%$text%'";
    $shipResult = mysqli_query($conn,$selectShipping);
    $row = mysqli_fetch_assoc($shipResult);
    $shipping = $row['shipping_cost'];

       if($resultLoc){
       header("location:cart.php?shippingfee=$shipping");
        }


?>
