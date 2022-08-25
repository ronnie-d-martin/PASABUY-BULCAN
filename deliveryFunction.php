<?php 

    include "connection.php";

    session_start();

    $rider_Id = $_SESSION['userId'];
    $date = date("Y-m-d");
    $order_Id = $_POST['order_Id'];

    $selectQuery = "SELECT * FROM delivery WHERE order_Id= '$order_Id' AND rider_Id = '$rider_Id'";
    $selectResult = mysqli_query($conn,$selectQuery);
    $filename = $_FILES["proof_image"]["name"];
    $tempname = $_FILES["proof_image"]["tmp_name"];
    $folder = "Proof Image/".$filename;

    if($filename != ""){
        $row = mysqli_fetch_assoc($selectResult);
        $customer_name = $row['customer_name'];
        $customer_address = $row['customer_address'];
        $customer_contactno = $row['customer_contactno'];
        $total = $row['total'];
        $add_comment = $row['add_comment'];
        $selectQuery2 = "SELECT * FROM delivery WHERE order_Id= '$order_Id'";
        $selectResult2 = mysqli_query($conn,$selectQuery2);
       
        
    while($row2 = mysqli_fetch_assoc($selectResult2)){
        $merchant_name = $row['merchant_name'];
        $newmerchant_name = "";
        $product_name = $row['product_name'];
        $newproduct_name ="";
       
        if($merchant_name == $row2['merchant_name']){
            $newmerchant_name = $merchant_name;
        }
        else {
            if(strlen($merchant_name) >=1){
                $newmerchant_name = $merchant_name.", ".$row2['merchant_name'];
            }
   
        }
        
        $merchant_name = $row2['merchant_name'];

        if($product_name == $row2['product_name']){
            $newproduct_name = $product_name;
        }
        else {
            if(strlen($product_name) >=1){
                $newproduct_name = $product_name.", ".$row2['product_name'];
            }
   
        }

        $product_name = $row['product_name'];

        if($add_comment == $row2['add_comment']){
            $new_add_comment = $add_comment;
        }
        else {
            if(strlen($add_comment) >=1){
                $new_add_comment = $add_comment.", ".$row2['add_comment'];
            }
   
        }
        $add_comment = $row2['add_comment'];

        
    }
    
   $insertQuery = "INSERT INTO transaction (order_Id,rider_Id,proof_image,customer_name,customer_address,customer_contactno,merchant_name,product_name,total,date,add_comment) VALUES ('$order_Id','$rider_Id','$filename','$customer_name','$customer_address','$customer_contactno','$newmerchant_name','$newproduct_name','$total','$date','$add_comment')";

    $insertResult = mysqli_query($conn,$insertQuery);
    
    if($insertResult == true){
        $deleteQuery = "DELETE FROM delivery WHERE order_Id ='$order_Id'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        $updateQuery = "UPDATE customer_order Set order_status='Delivered' WHERE order_Id ='$order_Id'";
        $result3 = mysqli_query($conn,$updateQuery);

        move_uploaded_file($tempname, $folder);
        header("location:delivery.php");    

                    
    }
    
    }
    else {
        header("location:delivery.php?message='Error'");

    }
    





?>