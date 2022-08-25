<?php include "connection.php";

    session_start();
    if(isset( $_POST['product_name'])){
        $product_name = $_POST['product_name'];

        header("location:products.php?product_name=$product_name");
    }

    if(isset( $_POST['category_name'])){
        $category_name = $_POST['category_name'];

        header("location:category.php?category_name=$category_name");
    }
    if(isset( $_POST['merchant_name'])){
        $merchant_name = $_POST['merchant_name'];

        header("location:merchants.php?merchant_name=$merchant_name");
    }
    if(isset( $_POST['rider_name'])){
        $rider_name = $_POST['rider_name'];

        header("location:rider.php?rider_name=$rider_name");
    }

    if(isset( $_POST['transaction_name'])){
        $transaction_name = $_POST['transaction_name'];

        header("location:transaction.php?transaction_name=$transaction_name");
    }

    if(isset( $_POST['customerProduct_name'])){
        $customerProduct_name = $_POST['customerProduct_name'];

        header("location:customerProduct.php?customerProduct_name=$customerProduct_name");
    }
    
    
    
    
    

    if(isset($_POST['refresh'])){
        header("location:products.php?");

    }
    if(isset($_POST['refresh2'])){
        header("location:category.php?");

    }
    if(isset($_POST['refresh3'])){
        header("location:merchants.php?");

    }
    if(isset($_POST['refresh4'])){
        header("location:rider.php?");

    }
    if(isset($_POST['refresh5'])){
        header("location:transaction.php?");

    }
    if(isset($_POST['refresh6'])){
        header("location:customerProduct.php?");

    }



?> 