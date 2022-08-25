<?php
    include "connection.php";
    session_start();

    $customer_Id = $_SESSION['userId'];

    $queryCustomer = "SELECT * FROM customer WHERE customer_Id = '$customer_Id'";
    $resultCustomer = mysqli_query($conn,$queryCustomer);
    $row12 = mysqli_fetch_assoc($resultCustomer);

 
    $query = "SELECT product.product_Id, product.product_name, product.product_price, product.product_image,cart.quantity FROM product INNER JOIN cart ON product.product_Id = cart.product_Id";

    $result = mysqli_query($conn,$query);

 
    if(isset($_POST['product_quantity'])){
        
        $product_Id = $_POST['product_Id'];
        $product_quantity = $_POST['product_quantity'];
       
        $updateQuery = "UPDATE cart SET quantity = '$product_quantity' WHERE product_Id = '$product_Id'AND customer_Id = '$customer_Id' ";
        $updateresult = mysqli_query($conn,$updateQuery);

    }

    if(isset($_POST["delete_product_Id"])){
        $delete_product_Id =  $_POST["delete_product_Id"];
        $deleteQuery = "DELETE FROM cart WHERE product_Id = '$delete_product_Id' AND customer_Id = '$customer_Id'";
        $deleteResult = mysqli_query($conn,$deleteQuery);

        if($deleteResult){
            header("location:cart.php?shippingfee=0");
        }
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/cart.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 

</head>
<body>
<?php include "sidebarCustomer.php";?>
    <div class="cart-container">
        <div class="cart-items">
                <h2><strong>Food Cart</strong></h2>
                <h4>You currently have # item(s) in your cart</h4>
        <table class="table table-striped table-hover">
            <tr class="cartTop">
                <th>Product</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Others</th>
                <th>Delete</th> 
            </tr>
        <?php 
           $total = 0;
           $query = "SELECT product.product_Id, product.product_name, product.product_price, product.product_image,cart.quantity,cart.add_comment FROM product INNER JOIN cart ON product.product_Id = cart.product_Id WHERE customer_Id = '$customer_Id'";

           $result = mysqli_query($conn,$query);
           
            while($row = mysqli_fetch_assoc($result)){

        ?>
        <tr class="carts">
            <td><img src="<?php echo "Product Image/".$row['product_image'];?>" class="product-image"></td>
            <td class="cardTd"><br><br><span class="product-name"><?php echo $row['product_name'];?></span></td>
            <td class="cardTd"><form action="cart.php?shippingfee=0" method="POST"><br><br>
                    <button type="button" name="minus" class="minus"><i class="far fa-minus-square"></i></button>
                    <input type="text" name ="product_quantity"value="<?php echo $row['quantity'];?>"   size ="1" style="text-align:center;"> 
                    <input type="hidden" name="product_Id" value="<?php echo $row['product_Id'];?>">
                    <button type="button" name="plus" class="plus"><i class="far fa-plus-square"></i></button>
            </form></td>
            <td class="cardTd"><br><br>&#x20B1;<?php echo $row['product_price'];?></td>
            <?php if($row['add_comment'] == true){?>
                <td class="cardTd"><br><br><h5><?php echo $row['add_comment'];?></h5></td>
                <?php }?>
                <?php if($row['add_comment'] == ""){?>
                <td class="cardTd"><br><br>None</td>
                <?php }?>
            <td class="cardTd"><form action="cart.php?shippingfee=0" method="post">
            <button type="button" class="deleteBtn"><br><br><i class="fas fa-trash"></i></button>
            <input type="hidden" name="delete_product_Id" value="<?php echo $row['product_Id'];?>">
            </form></td>
            <form action="productDetails.php" method="post">
                <input type="hidden" name="product_Id" value ="<?php echo $row['product_Id'];?>">
            </form>
            
        </tr>
        <?php   
          
            $total += (int) $row['product_price'] * (int) $row["quantity"];


    }?>

        </table>

            <?php if(mysqli_num_rows($result)<=0){
                
                ?>

               <br><h2>No items Selected</h2> 
               <?php }?>

           
            
        </div>
        <div class="cart-details">
            <div class="cart-details-header">
            <h3><strong>Order Summary</strong></h3>
            </div>
            <div class="cart-details-summary">
         
             <?php if(mysqli_num_rows($result)<=0){
                    echo'<h4>Delivery Fee: &#x20B1;<span class="shipping"> 0</span></h4>';
                    echo'<h4>Total: &#x20B1; '.$total.'';
                    } else{
                ?>
                
            <h4>Delivery Fee: &#x20B1;<span class="shipping">
            <?php if(isset($_GET['shippingfee'])){
                echo $_GET['shippingfee'];
            }?> </span></h4>
    
            <h4>Total: &#x20B1;<span class="total"><?php echo strval($total);?></span></h4>

            <?php }?>
            <form action="orderFunction.php" method="post">
               <?php 
               $query2 = "SELECT * FROM cart WHERE customer_Id = '$customer_Id'";
               $result2 = mysqli_query($conn,$query2);
               
              while($row2 = mysqli_fetch_assoc($result2)) {?>
                
                <input type="hidden" name="product_Id[]" value ="<?php echo $row2['product_Id']?>">
                <input type="hidden" name="total" value ="<?php echo strval($total);?>">
                <input type="hidden" name = "quantity[]" value ="<?php echo $row2['quantity']?>">
                <input type="hidden" name = "add_comment[]" value ="<?php echo $row2['add_comment']?>">
                <?php }?>
            <button type="button" class="checkout btn btn-info" name ="checkout">Place Order</button>
            </form>
          
            </div>
           
        </div>
        <div class="locationToShip">
            <div class="shipHead"><center><h3><strong>Shipping</strong></h3></center></div>
                <div class="shipBody">
                <form action="setLocation.php" method="POST" id="formLocation">
                <table>
                    <tr>
                        <td>Your Current Location: </td>
                        <td><?php echo $row12['Address'];?></td>
                    </tr>
                    <tr>
                        <td>Municipality:</td>
                        <td><select id="city" name="city" onchange="setTextField(this)"></select></td>
                        <input id="make_text" type = "hidden" name = "make_text" value = "" />
                    </tr>
                    <tr>
                        <td>Barangay:</td>
                        <td><select id="barangay" name="barangay" onchange="setTextField1(this)"></select></td>
                        <input id="make_text1" type = "hidden" name = "make_text1" value = "" />
                    </tr>
                    <tr>
                        <td>Street/House No: </td>
                        <td><input type="text" id="street" name="street"></td>
                    </tr>
                </table><br>
                <input type="button" value="Set Location" id="ajaxBtn" class="btnShip btn btn-warning" onclick="setlocation()">
                </form>
             </div>  
        </div>


    </div><br><br><br><br><br><br>
    <?php include "footer.php";?>
    <script src="js/setlocation.js"></script>
    <script src="js/cart.js"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
    
    
</body>
</html>