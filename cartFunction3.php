<?php 

include "connection.php";
    session_start();

    $customer_Id = $_SESSION["userId"];
    $product_Id = $_POST['product_Id'];
    $product_quantity = $_POST['product_quantity'];
    $merchant_Id = $_POST['merchant_Id'];
    


    $checkQuery = "SELECT * from cart WHERE product_Id = '$product_Id'";

    $checkresult = mysqli_query($conn,$checkQuery);

    if(mysqli_num_rows($checkresult) >= 1){
        $checkrow = mysqli_fetch_assoc($checkresult);
     

        if($product_Id == $checkrow['product_Id']){
            $newquantity = (int) $checkrow['quantity'];
            $newquantity++;

            $newquantity = strval($newquantity);
          

            $updateQuery = "UPDATE cart SET quantity = '$newquantity' WHERE product_id = '$product_Id' AND customer_Id = '$customer_Id'";
            $updateresult = mysqli_query($conn,$updateQuery);

            if($updateresult){
                header("location:customerMerchants.php?merchant_Id=$merchant_Id");
            }
        }
    }
    else {
    $query = "INSERT INTO cart(customer_Id,product_Id,quantity) VALUES ('$customer_Id','$product_Id','$product_quantity');";
    $result = mysqli_query($conn,$query);

    

    if($result){

        header("location:customerMerchants.php?merchant_Id=$merchant_Id");

    }
    }

    


?>
