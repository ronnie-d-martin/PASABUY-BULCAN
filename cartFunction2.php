<?php 

include "connection.php";
    session_start();

    $customer_Id = $_SESSION["userId"];
    $product_Id = $_POST['product_Id'];
    $product_quantity = $_POST['product_quantity'];
    


    $checkQuery = "SELECT * from cart WHERE product_Id = '$product_Id' AND customer_Id = '$customer_Id'";

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

                $queryCategory = "SELECT * FROM product WHERE product_Id = '$product_Id'";
                $resultCategory = mysqli_query($conn, $queryCategory);

                $row2 = mysqli_fetch_assoc($resultCategory);

                $category_Id = $row2['category_Id'];

                $queryName = "SELECT * FROM category WHERE category_Id ='$category_Id'";
                $resultName = mysqli_query($conn, $queryName);

                $row3 = mysqli_fetch_assoc($resultName);

                $category_name = $row3['category_name'];

                header("location:customerProduct.php?categoryId=$category_Id&categoryName=$category_name");
            }
        }
    }
    else {
    $query = "INSERT INTO cart(customer_Id,product_Id,quantity) VALUES ('$customer_Id','$product_Id','$product_quantity');";
    $result = mysqli_query($conn,$query);

    

    if($result){

                $queryCategory = "SELECT * FROM product WHERE product_Id = '$product_Id'";
                $resultCategory = mysqli_query($conn, $queryCategory);

                $row2 = mysqli_fetch_assoc($resultCategory);

                $category_Id = $row2['category_Id'];

                $queryName = "SELECT * FROM category WHERE category_Id ='$category_Id'";
                $resultName = mysqli_query($conn, $queryName);

                $row3 = mysqli_fetch_assoc($resultName);

                $category_name = $row3['category_name'];
                
        header("location:customerProduct.php?categoryId=$category_Id&categoryName=$category_name");

    }
    }

    


?>
