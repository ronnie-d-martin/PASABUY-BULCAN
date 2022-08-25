<?php include "connection.php";
        session_start();
        $rider_Id = $_SESSION['userId'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/delivery.css?v=<?php echo time(); ?>">
    <title>Delivery</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
</head>
<body>
    <?php include "sidebarRider.php"?>
    <div class="delivery-container"><br>
        <div class="deliveryTitle"><center><h1>On going Delivery</h1></center> </div>
        <div class="maps">
        <?php 
          $query = "SELECT * FROM delivery WHERE rider_Id = '$rider_Id'";
          $result = mysqli_query($conn, $query);
          $query2 = "SELECT * FROM delivery WHERE rider_Id = '$rider_Id'";
          $result2 = mysqli_query($conn, $query2);
                   
                   if( $row2 = mysqli_fetch_assoc($result)){
                       $order_Id = $row2['order_Id'];
                    $selectCustomerId = "SELECT * FROM customer_order WHERE order_Id = '$order_Id'";
                    $selectCustomerResult = mysqli_query($conn,$selectCustomerId);
                    $row3 = mysqli_fetch_assoc($selectCustomerResult);
                    
                    $customer_Id = $row3['customer_Id'];
                    $selectCustomerUsername = "SELECT * FROM customer WHERE Customer_Id = '$customer_Id'";
                    $selectCustomerUsernameResult = mysqli_query($conn,$selectCustomerUsername);
                    $row4 = mysqli_fetch_assoc($selectCustomerUsernameResult);
                    $customer_username = $row4['Username'];

                 
               ?>
        <iframe width="100%" height="380" src="https://maps.google.com/maps?q=<?php echo
             $row2['customer_address']; ?>&output=embed&z=18" z="20"></iframe>
        </div>
        <div class="order-details">
            <div class="customer-information">
           
                <h5>Customer: <?php echo $row2['customer_name']?> </h5>
                <h5>Address: <?php echo $row2['customer_address']?></h5>
                <h5>Contact No.: <?php echo $row2['customer_contactno']?></h5>
                <?php }
        ?>
            </div>
        
            <div class="product-information">
                <table class="table table-striped table-hover">
                    <tr>
                    <th>Merchant</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Others</th>
                
                    </tr>
                    <?php while($row =mysqli_fetch_assoc($result2)){?>
                    <tr>
                        <td><?php echo $row['merchant_name']?></td>
                        <td><?php echo $row['product_name']?></td>
                        <td><?php echo $row['product_price']?></td>
                        <td><?php echo $row['quantity']?></td>
                        <?php if($row['add_comment']){?>
                        <td><p><?php echo $row['add_comment'];?></p></td>
                        <?php }?>
                        <?php if($row['add_comment'] == ""){?>
                        <td>None</td>
                <?php }?>
                      
                    </tr>
                    <?php }?>
                </table>
                <?php
                if(mysqli_num_rows($result2) <= 0){
                    echo "<h4> No items selected</h4>";
                }
                
                ?>
                <br>
                
                <h5>Total:&#x20B1; <span class="totalDelivery"><?php 
                if(!empty($row2['total'])){
                    echo $row2['total'];
                }
                else{
                    echo "0";
                }
                
                ?></span></h5>
          
                
                <button id="buttonPD" type="button" class="proofBtn btn btn-info">Proof of Delivery</button>
            </div>
           
        </div>
        
    </div>
    <br><br><br>
    <div class="modal">
        <div class="modal-container">
             <span class="closeBtn">&times;</span>
             <div>
                 <h3>Proof Image</h3>
                 <p><strong>Please provide a proof of transaction</strong></p>
                 <p>*Picture of customer with products</p>
                <br>
            </div>
                <form action="deliveryFunction.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="proof_image" class="proofImg"><br>
                    <input type="hidden" name="order_Id" value ="<?php echo $row2['order_Id']?>">
                    <input type="button" value="Delivered" class="deliverBtn btn btn-success">
                </form>
        </div>
    </div>


    <script src="js/delivery.js"></script>
</body>
</html>