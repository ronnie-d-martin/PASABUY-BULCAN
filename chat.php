<?php 
      
      if(isset($customer_username)){
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
<link rel="stylesheet" href="css/chatboxCustomer.css">
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
          <p><?php echo $row['status']; ?></p>
        </div>
        <h4 class="closeChat">&times;</h4>
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

  <script src="js/chat.js"></script>


