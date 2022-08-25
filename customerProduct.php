<?php 
    include "connection2.php";
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customerProduct.css">
    <title>Pasabuy Bulacan</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
</head>
<body>
<?php include "sidebarCustomer1.php";?>
<!-- BODY -->
<div class="product-container"><br><br>
<?php include "carosel.php";?><br><br>
    <div class="product-title">
    <form action="searchProduct.php" method="post" enctype="multipart/form-data" class="searchForm">
        <input type="search" id="customerProduct_search" name="customerProduct_name" placeholder="Search Product..." class="formSearch">
        <input type="submit" class="btn btn-primary" id="btnSubmit">
        <input type="submit" value="Refresh" name="refresh6"  class="btn btn-success" id="btnSuccess">
    </form>
      <?php
        $searchcustomerProduct_name = "";
        if(isset($_GET['customerProduct_name'])){
            $searchcustomerProduct_name = $_GET['customerProduct_name'];
        } 
        if(isset($_GET['categoryName'])){
        $categoryName = $_GET['categoryName'];

    ?>  

        <h2><?php echo $categoryName?></h2>
        <?php }else {?>

            <h2 class="productTitle">Products</h2>

            <?php }?>


    </div>
    <div class="product-items">
     <?php 
        if(isset($_GET['categoryId']) && isset($_GET['categoryName'])){
        $categoryId = $_GET['categoryId'];
       
        $queryCategory = "SELECT * FROM product WHERE category_Id = '$categoryId' AND product_name LIKE '%$searchcustomerProduct_name%'";
        }
        else {
            $queryCategory = "SELECT * FROM product WHERE product_name LIKE '%$searchcustomerProduct_name%'";
        }
       
        $result = mysqli_query($conn,$queryCategory);

        while($row = mysqli_fetch_assoc($result)){
           
        
     ?>   
        <div class="product-item">
            <img src="<?php echo "Product Image/".$row['product_image'];?>" class="product_image" >
            <h4 class="product_name"> <?php echo $row['product_name'];?></h4>
            <form action="productDetails.php" method="post">
            <input type="hidden" value = "<?php echo $row['product_Id']?>" name="product_Id">
            
            </form>
            <input type="button" class="addtocart btn btn-link" value = "🛒">   
            <form action="cartFunction2.php" method="POST">
            
            <input type="hidden" name="product_quantity" id="quantity" min="1" value ="1"> <br>
            <input type="hidden" name="product_Id" value="<?php echo $row['product_Id']?>">
           
            </form>
           
        </div>

        <?php }?>
      
        


    </div>

</div>

<script src="js/customerProduct.js"></script>
<br><br><br>
<?php include "footer.php";?>
</body>
</html>