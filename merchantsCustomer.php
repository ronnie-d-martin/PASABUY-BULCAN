<?php
    include "connection.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="stylesheet" href="css/merchants.css"> 
    <link rel="icon" href="images/logo_pasabuy.png" type="image/icon type">
</head>
<body>
<?php include "sidebarCustomer.php";?>
<div class="merchant-container">
    <br>
    <div><h1>
    <strong class="merchant-title">Merchants</strong>
    </h1></div><br><br>
    <div class="merchant-items">
     <?php 

        $queryMerchant = "SELECT * FROM merchant";
        $result = mysqli_query($conn,$queryMerchant);

        while($row = mysqli_fetch_assoc($result)){
           
        
     ?>   
        <div class="merchant-item">
            <form action="customerMerchants.php" method="POST">
            <input type="hidden" value= "<?php echo $row['merchant_Id'];?>" name="merchant_ID">
            </form>

            <img src="<?php echo "Merchant Image/".$row['merchant_logo'];?>" >
            <h4><?php echo $row['merchant_name'];?></h4>
            <h5><?php echo $row['merchant_description'];?></h5>
        </div>

        <?php }?>
      

    </div>

</div>

<script src="js/merchantCustomer.js"></script>
<?php include "footer.php";?>

</body>
</html>