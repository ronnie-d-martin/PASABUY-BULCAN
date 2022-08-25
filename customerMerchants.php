<?php
    include "connection2.php";
    if(isset($_GET["merchant_Id"])){
        $merchant_Id = $_GET["merchant_Id"];
    }
    else{
        $merchant_Id = $_POST["merchant_ID"];
    }


    $queryMerchant = "SELECT * FROM merchant where merchant_Id = '$merchant_Id'";
    $result = mysqli_query($conn, $queryMerchant);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
    <link rel="stylesheet" href="css/customerMerchant1.css">
</head>
<body>
<?php include "sidebarCustomer.php";?>

    <div class="merchant-container">
        <div class="merchant-title">
        <?php
            if($result){
                $row = mysqli_fetch_assoc($result);
                $merchant_name = $row["merchant_name"];

            }
        ?>  
            <h1><strong><?php echo $merchant_name ?></strong></h1>
        </div>
        <div class="merchant-items">
        <?php 
            $queryProduct = "SELECT * FROM product WHERE merchant_Id = '$merchant_Id'";
            $result2 = mysqli_query($conn,$queryProduct);

            while($row2= mysqli_fetch_assoc($result2)){
            
            
        ?>   
            <div class="merchant-item">
                <img src="<?php echo "Product Image/".$row2['product_image'];?>" class="merchant_image" >
                <h4 class="merchant_name"> <?php echo $row2['product_name'];?></h4>
                <form action="productDetails.php" method="post">
                <input type="hidden" value = "<?php echo $row2['product_Id']?>" name="product_Id">
                
                </form>
                <input type="button" class="addtocart btn btn-link" value = "🛒">
                <form action="cartFunction3.php" method="POST">
                <input type="hidden" name="product_quantity" id="quantity" min="1" value ="1"> <br>
                <input type="hidden" name="product_Id" value="<?php echo $row2['product_Id']?>">
                <input type="hidden" name="merchant_Id" value="<?php echo $row2['merchant_Id']?>">
                
                </form>
            
            </div>

            <?php }?>
        
            


        </div>

    </div>

    <script src="js/customerMerchant.js"></script><br><br><br><br>
    <?php include "footer.php";?>
    
</body>
</html>