<?php 

    include "connection.php";
  
    if(!isset($_GET['product_Id'])){
        
    if(!isset($_POST['related_Id'])){
        $product_Id = $_POST['product_Id'];
 
        $query = "SELECT * FROM product WHERE product_Id = '$product_Id' ";
    
        $result = mysqli_query($conn,$query);
    
    }
    else {
        $product_Id = $_POST['related_Id'];
        $query = "SELECT * FROM product WHERE product_Id = '$product_Id' ";

        $result = mysqli_query($conn,$query);
    }
    }
    else {
        $product_Id = $_GET['product_Id'];
 
        $query = "SELECT * FROM product WHERE product_Id = '$product_Id' ";
    
        $result = mysqli_query($conn,$query);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="stylesheet" href="css/productDetails.css">
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
</head>
<body>
<?php include "sidebarCustomer.php";?>
    <div class="container-detail">
        <?php    if($result){  
            
                    $row = mysqli_fetch_assoc($result);
                    $category_Id = $row['category_Id'];
            
            
            ?>
        <div class="product-image">
            <img src="<?php echo "Product Image/".$row['product_image'];?>">
        </div>
        <div class="product-details">
            <h1><strong>Product Details</strong></h1>
            <p><strong>Product name:</strong> <?php echo $row['product_name'];?></p>
            <p><strong>Price:</strong> &#x20B1;<?php echo $row['product_price'];?></p> 
            <p><strong>Description: </strong><?php echo $row['product_description'];?></p> 
        <form action="cartFunction.php" method="POST" class="cartFunction">
                    <p><strong>Quantity:</strong></p>
                    <input type="number" name="product_quantity" id="quantity" min="1" value ="1"><br><br>
                    <p>Add comment</p><input type="text" name="addcomment">
                    <input type="button" value="Add to cart" class="addtocart btn btn-info" >
                    <input type="hidden" name="product_Id" value="<?php echo $row['product_Id']?>">
        </form>
     
        <form action="buynowFunc.php" method="POST" class="buynowForm">
                 <input type="button" value="Buy now" class="buyNow btn btn-danger">
                 <input type="hidden" name="product_Id" value="<?php echo $row['product_Id']?>">
                 <input type="hidden" name="product_price" value="<?php echo $row['product_price']?>">
                 <input type="hidden" name="buyNowquantity" id="quantityBuynow">
        
            </form>
            
        </div>
            <?php }?>
    </div>

    <div class="related-container">
        <?php  
            $query2 = "SELECT * FROM product WHERE category_Id = '$category_Id' AND NOT product_Id = '$product_Id' LIMIT 4";

            $result2 = mysqli_query($conn,$query2);

            while($row2 = mysqli_fetch_assoc($result2)){
              
        ?>      
            <div class="related-items">
            <img src="<?php echo "Product Image/".$row2['product_image'];?>" class="related_image" name = "relatedBtn">
                <h3 class="related_name"  name = "relatedBtn"><?php echo $row2['product_name'];?> </h3>
                <form action="productDetails.php" method="POST">
                    <input type="hidden" name="related_Id" value = "<?php echo $row2['product_Id'];?>">
                </form>
            </div>
                

                <?php }?>
    </div>
 
    
    <script src="js/productDetails.js"></script>
    <?php include "footer.php";?>
</body>
</html>