<?php 
    include "connection.php";

    session_start();

 
    $order_Id = $_POST['order_Id'];
    $updateQuery = "UPDATE customer_order SET order_status ='Declined' WHERE order_Id = '$order_Id'";
    $result = mysqli_query($conn,$updateQuery);

    $query = "SELECT customer_orderdetails.order_Id,customer_orderdetails.product_Id,customer_orderdetails.total,customer_orderdetails.quantity, customer_orderdetails.add_comment,customer_orderdetails.delivery_fee,customer_orderdetails.date_ordered, customer_order.order_status,customer_order.customer_Id,product.product_Id,product.product_price,product.product_name, product.product_image FROM customer_orderdetails INNER JOIN customer_order ON customer_orderdetails.order_Id = customer_order.order_Id INNER JOIN product ON customer_orderdetails.product_Id = product.product_Id WHERE customer_order.order_Id = '$order_Id'";
    $result1 = mysqli_query($conn,$query);

    $row = mysqli_fetch_assoc($result1);

    $customer_Id = $row['customer_Id'];
    $product_Id = $row['product_Id'];
    $product_image = "Product Image/".$row['product_image'];
    $product_name = $row['product_name'];
    $product_price = $row['product_price'];
    $product_quantity =$row['quantity'];
    $status = $row['order_status'];
    $date = $row['date_ordered'];
    $add_comment = $row['add_comment'];

    $insertDecline = "INSERT INTO  decline_order (order_Id,customer_Id,product_Id,product_image,product_name,product_price,product_quantity,product_status,order_date,add_comment) VALUES ('$order_Id','$customer_Id','$product_Id','$product_image','$product_name','$product_price','$product_quantity','$status','$date','$add_comment');";
    $ResultDecline = mysqli_query($conn,$insertDecline);

    $queryCustomer = "SELECT * FROM customer WHERE Customer_Id = '$customer_Id'";
    $resultCustomer = mysqli_query($conn,$queryCustomer);
    $customerRow = mysqli_fetch_assoc($resultCustomer);

    $customer_name = $customerRow['First_Name'].' '.$customerRow['Last_Name'];

    $insertNotif = "INSERT INTO notification (customer_Id,customer_name,product_name) VALUES ('$customer_Id','$customer_name', '$product_name');";
    $resultNotif = mysqli_query($conn, $insertNotif);


    $declineQuery = "DELETE FROM customer_orderdetails WHERE order_id = '$order_Id'";
    $declineResult = mysqli_query($conn,$declineQuery);

    $declineQuery1 = "DELETE FROM customer_order WHERE order_id = '$order_Id'";
    $declineResult1 = mysqli_query($conn,$declineQuery1);



    if($result){
       header("location:adminOrders.php");
    }
    
?>