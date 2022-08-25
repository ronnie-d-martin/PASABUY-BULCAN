<?php
    include "connection.php";

    session_start();
     
    
        $order_Id = $_POST['order_Id'];
        $rider_Id = $_POST['rider_Id'];

        $query = "SELECT customer_orderdetails.order_Id,customer_orderdetails.product_Id,customer_orderdetails.total,customer_orderdetails.quantity,customer_orderdetails.add_comment, customer_orderdetails.delivery_fee,customer_order.customer_Id,customer.First_Name,customer.Last_Name,customer.Address,customer.Contact_No FROM customer_orderdetails INNER JOIN customer_order ON customer_orderdetails.order_Id = customer_order.order_Id INNER JOIN customer ON  customer_order.customer_Id = customer.Customer_Id  WHERE customer_orderdetails.order_Id = '$order_Id'";

        $result = mysqli_query($conn,$query);

         while($row = mysqli_fetch_assoc($result)){
            $customerName = $row['First_Name'].' '.$row["Last_Name"];
            $customerAddress =$row["Address"];
            $customerContactNo = $row["Contact_No"];
            $quantity = $row['quantity'];
            $product_Id = $row['product_Id'];
            $add_comment = $row['add_comment'];
            $total =$row['total'];
           
            $selectProductQuery = "SELECT * FROM product WHERE product_Id = '$product_Id'";
            $selectProductResult = mysqli_query($conn,$selectProductQuery);
            if($selectProductResult){
              
                $row2 = mysqli_fetch_assoc($selectProductResult);
                $product_name = $row2['product_name'];
                $product_price = $row2['product_price'];
          

                $merchant_Id = $row2['merchant_Id'];
             
                $selectMerchantQuery = "SELECT * FROM merchant WHERE merchant_Id = '$merchant_Id'";
                $selectMerchantResult = mysqli_query($conn,$selectMerchantQuery);
                if($selectMerchantResult){
             
                    $row3 = mysqli_fetch_assoc($selectMerchantResult);
                    $merchant_name = $row3['merchant_name'];

            }
         }
      


         $riderPendingQuery = "INSERT INTO rider_pending(order_Id,rider_Id,customer_name,customer_address,customer_contactno,merchant_name,product_name,product_price,quantity,total,add_comment) VALUES ('$order_Id','$rider_Id','$customerName','$customerAddress','$customerContactNo','$merchant_name','$product_name','$product_price','$quantity','$total','$add_comment');";

         $riderPendingResult = mysqli_query($conn,$riderPendingQuery);

         $queryStatus = "UPDATE customer_order SET order_status = 'Rider Pending' WHERE order_Id ='$order_Id'";
         $resultStatus = mysqli_query($conn, $queryStatus);

         if($riderPendingResult){
            header("location:adminOrders.php");
        }
        
         
        }
   

        



      

        

            
        


        
    

?>