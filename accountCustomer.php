<?php 
    include "connection.php";
    session_start();

    $customer_Id = $_SESSION["userId"];
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="stylesheet" href="css/accountDetailes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/rating.css">
    <link rel="icon" href="images/logo_pasabuy.png" type="image/icon type">
    
</head>
<body>

<?php 
    include "sidebarCustomer.php";
    

?>

<div class="accountContainer">
<div class="panel panel-default sidebar-menu">
    
    <div class="panel-heading">
        
        <?php 

            $get_customer = "select * from customer where Customer_Id='$customer_Id'";

            $run_customer = mysqli_query($conn, $get_customer);
        
            $row_customer = mysqli_fetch_assoc($run_customer);

            $customer_image = $row_customer['customer_image'];

            $customer_name = $row_customer['First_Name'].' '.$row_customer['Last_Name'];

            $getOrderId = "SELECT * FROM customer_order WHERE customer_Id = '$customer_Id' AND order_status = 'Out for Delivery'";
            $getOrderIdResult = mysqli_query($conn,$getOrderId);
            $getOrderIdRow = mysqli_fetch_assoc($getOrderIdResult);
            if(isset($_GET['order_Id'])){
                $order_Id = $_GET['order_Id'];
              
            }

            if(!isset($customer_Id)){
                
            } else {
                echo "
                    <center>
                        <img src ='Customer Image/$customer_image' class='imgCustomer'> 
                    </center>
                    <br/>
                    <h3 class='panel-title' align='center'>
                        Name: $customer_name
                    </h3>
                ";
            }

      ?>

    </div>


        <div class="panel-body"> <!-- SIDE FUNCTIONS, AND IF CLICKED, DISPLAY OR DO YUNG FUNCTION NA NAKASET DUN -->
            <ul class="nav-pills nav-stacked nav">
                
                <li class="<?php if(isset($_GET['my_orders'])){ echo "active"; }?>">
                    <a href="accountCustomer.php?my_orders">
                        <i class="fa fa-list"></i> My Orders <!-- PAPAKITA DITO YUNG UNPAID NA ORDERS -->
                    </a>
                </li>
            
                <li class="<?php if(isset($_GET['edit_account'])){ echo "active"; }?>">
                    <a href="accountCustomer.php?edit_account">
                        <i class="fa fa-pencil"></i> Edit Account <!-- GENERAL EDIT NG ACCOUNT -->
                    </a>
                </li>      
                <li class="<?php if(isset($_GET['change_pass'])){ echo "active"; }?>">
                    <a href="accountCustomer.php?change_pass">
                        <i class="fa fa-user"></i> Change Password <!-- EDIT PASSWORD, REQUIRES OLD PW -->
                    </a>         
                </li>

                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log Out
                    </a>
                </li>
            </ul>
        </div>
 </div>
    <div class="col-md-9">
               
               <div class="box">
                   
                    <?php
                   if (isset($_GET['my_orders'])){
                       include("accountMyOrders.php");
                   }
                   ?>

                   <?php
                   if (isset($_GET['edit_account'])){
                       include("accountEdit.php");
                   }
                   ?>
                   
                   <?php
                   if (isset($_GET['change_pass'])){
                       include("accountPassword.php");
                   }
                   ?>

               </div>
        </div>
    </div>     
</div>
<?php if(isset($_GET['my_orders'])){?>
<?php include "chat.php";?>
<?php }?>
<div class="modalRating" id="modalFeed" style="display: none;">
        <div class="questionContainer">
        <p class="close">&times;</p><br>
            <h2>How did we do?</h2>
        <p>Please let us know your food delivery was. It will really help us to keep improving our service!</p>
        </div>
            <div class="questionCustomer">
                <h3>How would you rate your food?</h3>
                    <form class="rating">
                    <label>
                        <input type="radio" name="stars_food" value="1" />
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars_food" value="2" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars_food" value="3" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>   
                    </label>
                    <label>
                        <input type="radio" name="stars_food" value="4" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars_food" value="5" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    </form>
            </div>

            <div class="questionCustomer">
                <h3>How would you rate your delivery rider?</h3>
                <form class="rating">
                    <label>
                        <input type="radio" name="stars_rider" value="1" />
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars_rider" value="2" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars_rider" value="3" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>   
                    </label>
                    <label>
                        <input type="radio" name="stars_rider" value="4" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars_rider" value="5" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    </form>
            </div>

            <div class="questionCustomer">
                <h3>How would you rate your overall experience?</h3>
                <form class="rating">
                    <label>
                        <input type="radio" name="stars_overall" value="1" />
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars_overall" value="2" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars_overall" value="3" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>   
                    </label>
                    <label>
                        <input type="radio" name="stars_overall" value="4" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars_overall" value="5" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    </form>
            </div>
        <br>   
        
        <form action="ratingFunction.php" method="POST">
         <button type="button" class="feedBackSubmit btn btn-info">Submit Feedback</button>
         <input type="hidden" name="product_Id" class="rating_product_Id">
         <input type="hidden" name="food" class="rating_foodFunc">
         <input type="hidden" name="rider" class="rating_riderFunc">
         <input type="hidden" name="overall" class="rating_overallFunc">
         </form>
        </div>
</div>
<br><br>
<?php include "footer.php";?>

<script>

    var rating_foodFunc = document.getElementsByClassName("rating_foodFunc")[0];
    var rating_riderFunc = document.getElementsByClassName("rating_riderFunc")[0];
    var rating_overallFunc = document.getElementsByClassName("rating_overallFunc")[0];




$('input[name="stars_food"]').change(function() {
    var star1 = this.value;
    rating_foodFunc.value = star1;
   
});

$('input[name="stars_rider"]').change(function() {
    var star2 = this.value;
    rating_riderFunc.value = star2;

});
$('input[name="stars_overall"]').change(function() {
    var star3 = this.value;
    rating_overallFunc.value = star3;
    
});
</script>


<script src="js/order.js"></script>
</body>
</html>