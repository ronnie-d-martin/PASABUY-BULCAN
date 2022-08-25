<?php 

include "connection.php";
    session_start();
    $customer_Id = $_SESSION["userId"];
    $product_Id = $_POST['product_Id'];
    $product_quantity = $_POST['product_quantity'];
    $addcomment = $_POST['addcomment'];

    
    
    $checkQuery = "SELECT * from cart WHERE product_Id = '$product_Id' AND customer_Id ='$customer_Id'";
    $checkresult = mysqli_query($conn,$checkQuery);

    if(mysqli_num_rows($checkresult) >= 1){
        $checkrow = mysqli_fetch_assoc($checkresult);

        if($product_Id == $checkrow['product_Id']){
            $newquantity = (int) $checkrow['quantity'];
            $newquantity = (int) $newquantity+ (int) $product_quantity;
            
            $product_quantity = strval($newquantity);
            
            $updateQuery = "UPDATE cart SET quantity = '$product_quantity' WHERE product_id = '$product_Id' AND customer_Id = '$customer_Id'";
            $updateresult = mysqli_query($conn,$updateQuery);

            if($updateresult){
                header("location:productDetails.php?product_Id=$product_Id");
            }
            
        }
    }
    else {

        $query = "INSERT INTO cart(customer_Id,product_Id,quantity,add_comment) VALUES ('$customer_Id','$product_Id','$product_quantity','$addcomment');";
        $result = mysqli_query($conn,$query);
    
        if($result){
    
            header("location:productDetails.php?product_Id=$product_Id");
    
        }
    }
   


?>
