<?php 

include "connection.php";

    $product_name = $_POST["product_name"];
    $product_description = $_POST["product_description"];
    $product_price = $_POST["product_price"];
 
    $category = $_POST["category"];
    $merchant = $_POST["merchant"];
    
    if(!empty($product_name ) && !empty($product_description) && !empty($product_price) && !empty($category) && !empty($merchant)&& !empty( $filename = $_FILES["product_image"]["name"])){

    $categoryquery = "SELECT * FROM category WHERE category_name = '$category'";
    $categoryresult = mysqli_query($conn,$categoryquery);

    if(mysqli_num_rows($categoryresult) >=1){
        $row = mysqli_fetch_assoc($categoryresult);

        $categoyId = $row["category_Id"]; 
    }
    
    $merchantquery = "SELECT * FROM merchant WHERE merchant_name = '$merchant'";
    $merchantresult = mysqli_query($conn,$merchantquery);

    if(mysqli_num_rows($merchantresult) >=1){
        $row = mysqli_fetch_assoc($merchantresult);
        $merchantId = $row["merchant_Id"]; 
    }

    $filename = $_FILES["product_image"]["name"];
    $tempname = $_FILES["product_image"]["tmp_name"];
    $folder = "Product Image/".$filename;

    $addquery = "INSERT INTO product(product_name,product_description,product_price,product_image,category_Id,merchant_Id) VALUE ('$product_name','$product_description','$product_price','$filename','$categoyId','$merchantId');";

    if(mysqli_query($conn,$addquery)){

        header("location: products.php?message2=Product Sucessfully added!");
        move_uploaded_file($tempname, $folder);

    }
    else {
        header("location: products.php?message=Product failed to add");

    }
} else {
    header("location:products.php?message= Please complete the field!");
}

















?>