<?php 
    include "connection.php";
    session_start();

    $order_Id = $_POST["product_Id"];
    $food = $_POST["food"];
    $rider = $_POST["rider"];
    $overall = $_POST["overall"];

    $selectRider = "SELECT * FROM transaction WHERE order_Id = '$order_Id'";
    $resultRider = mysqli_query($conn, $selectRider);

    $row = mysqli_fetch_assoc($resultRider);
    $rider_Id = $row["rider_Id"];

    $insertRating = "INSERT INTO rating (product_rating,rider_rating,overall_rating,rider_Id,order_Id) VALUES ('$food','$rider','$overall','$rider_Id','$order_Id');";
    $resultRating = mysqli_query($conn,$insertRating);

    if($resultRating){
        header("location:accountCustomer.php?my_orders");
    }

?>
