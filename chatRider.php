<?php
    include "connection.php";
   session_start();
    $rider_Id = $_SESSION['userId'];
 

   $deliveryQuery = "SELECT * FROM delivery WHERE rider_Id = '$rider_Id'";
   $deliveryQueryResult = mysqli_query($conn,$deliveryQuery);
   if(mysqli_num_rows($deliveryQueryResult) >=1){
    $deliveryQueryRow = mysqli_fetch_assoc($deliveryQueryResult);

    $deliveryOrderId = $deliveryQueryRow['order_Id'];
 
    $customerOrderQuery = "SELECT * FROM customer_order WHERE order_Id = '$deliveryOrderId'";
    $customerOrderResult = mysqli_query($conn,$customerOrderQuery);
    $customerOrderRow = mysqli_fetch_assoc($customerOrderResult);
    
    $customer_Id = $customerOrderRow['customer_Id'];
    $customerQuery = "SELECT * FROM customer WHERE Customer_Id = '$customer_Id'";
    $customerResult = mysqli_query($conn,$customerQuery);
    $customerRow = mysqli_fetch_assoc($customerResult);
 
    $userName = $customerRow['Username'];
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="css/chatbox.css">
    <link rel="stylesheet" href="css/chatRider.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
 
</head>
<body>
    <?php include "sidebarRider.php";?>

<div class="liveChatContainer">
   <?php  if(isset($customer_username)){
        $userName = $customer_username;
      }
      else {
        if(isset($order_Id)){
          $selectRiderId = "SELECT * FROM delivery WHERE order_Id = '$order_Id'";
          $selectRiderIdResult = mysqli_query($conn,$selectRiderId);
          $riderRow = mysqli_fetch_assoc($selectRiderIdResult);
          $rider_Id = $riderRow['rider_Id'];
          $getRider = "SELECT * FROM rider WHERE rider_Id = '$rider_Id'";
          $getRiderResult = mysqli_query($conn,$getRider);
          $getRiderRow = mysqli_fetch_assoc($getRiderResult);
          $userName = $getRiderRow['username'];
        }
        
      }
 
      $isadmin = false;
      $isrider = false;
      

        if(isset($userName)){

        
          $sql = mysqli_query($conn, "SELECT * FROM admin WHERE Username = '$userName'");
          if($sql){
            if(mysqli_num_rows($sql) >= 1 ){
              $row = mysqli_fetch_assoc($sql);
              $isadmin = true;
              $user_id = $row['Admin_Id'];
            } 
          }
          $sql1 = mysqli_query($conn, "SELECT * FROM customer WHERE Username = '$userName'");
          if($sql1){
            if(mysqli_num_rows($sql1) >= 1 ){
              $row = mysqli_fetch_assoc($sql1);
              $user_id = $row['Customer_Id'];
              
            }
            
          }
          $sql2 = mysqli_query($conn, "SELECT * FROM rider WHERE username = '$userName'");
          if($sql2){
            if(mysqli_num_rows($sql2) >= 1 ){
              $row = mysqli_fetch_assoc($sql2);
              $isrider = true;
              $user_id = $row['rider_Id'];
              
            }
          }

        ?>
<div class="wrapper">
    <section class="chat-area">
      <header>
    
      
       
        <div class="details">
    
          <span><?php 
          if($isadmin == true){
             
          } else if($isrider == true){
            echo $row['first_name']. " " . $row['last_name'];
            }
            else{
              echo $row['First_Name']. " " . $row['Last_Name'];}
              ?></span>
    
        </div>
       
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button class="chatBtn"><i class="fa fa-telegram"></i></button>
      </form>
     
    </section>
   
  </div>
  <?php }?> 

 


        <div class="customerInfo">
           <center><h4><strong>Customer Information</strong></h4></center> 
           <div class="deliveryTitle"><center><h5>On going Delivery</h5></center> </div>
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
        <iframe width="100%" height="300" src="https://maps.google.com/maps?q=<?php echo
             $row2['customer_address']; ?>&output=embed&z=18" z="20"></iframe>
        </div>
        <div class="order-details">
            <div class="customer-information">
           
                <h4>Customer: <?php echo $row2['customer_name']?> </h4>
                <h4>Address: <?php echo $row2['customer_address']?></h4>
                <h4>Contact No.: <?php echo $row2['customer_contactno']?></h4>
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
                        <td class="tdPadding"><?php echo $row['merchant_name']?></td>
                        <td class="tdPadding"><?php echo $row['product_name']?></td>
                        <td class="tdPadding"><?php echo $row['product_price']?></td>
                        <td class="tdPadding"><?php echo $row['quantity']?></td>
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
                
              <center><h4>Total:&#x20B1; <span class="totalDelivery"><?php 
                if(!empty($row2['total'])){
                    echo $row2['total'];
                }
                else{
                    echo "0";
                }
                
                ?></span></h4></center> 
          
            </div>
        </div>
</div>

<script src="js/chat.js"></script>

</body>
</html>