<?php include "connection.php";

    session_start();

    $customer_Id = $_SESSION['userId'];
    $selectRider = "SELECT * FROM rider";
    $resultRider = mysqli_query($conn, $selectRider);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="stylesheet" href="css/preferRider.css">
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
</head>
<body>
<?php 
    include "sidebarCustomer.php";
?>

<div class="preferContainer">
    <?php while($row = mysqli_fetch_assoc($resultRider)){
    $rider_Id = $row['rider_Id'];

    $queryChoose = "SELECT * FROM choose_rider WHERE customer_Id = '$customer_Id'";
    $resultChoose = mysqli_query($conn, $queryChoose);

    $selectRating = "SELECT * FROM rating WHERE rider_Id = '$rider_Id'";
    $resultRating = mysqli_query($conn,$selectRating);

    $selectCount = "SELECT COUNT(*) FROM rating WHERE rider_Id = '$rider_Id'";
    $resultCount = mysqli_query($conn, $selectCount);

    $rowCount = mysqli_fetch_assoc($resultCount);
    $totalRider  = 0.00;
    $riderResult = 0.00;

    while($row1 = mysqli_fetch_assoc($resultRating)){
        $totalRider += (int)$row1["rider_rating"];
        $riderResult = $totalRider/(int)$rowCount['COUNT(*)'];

    }

         $isChoose = false;
         if(mysqli_num_rows($resultChoose)>=1){
             $isChoose = true;
         }

 ?>
    <form action="preferFunction.php" method="post" enctype="multipart/form-data" id="formPrefer">
    <div class="riderDetailes">
        <div class="riderImg"><img src="<?php echo "Rider Image/".$row['rider_image']?>">
        </div>
        <div class="riderName"><h3><?php echo $row['first_name'] ?><?php echo $row['last_name']?></h3></div>
        <div class="riderRating"><h4>⭐<?php echo round($riderResult,2);?></h4></div>
        <div class="status"><h4><?php echo $row['rider_status'];?></h4></div>
        <input type="hidden" name="customer_Id" value="<?php echo $customer_Id; ?>" class="hiddenCustomer">
        <input type="hidden" name="rider_Id" value="<?php echo $row['rider_Id'];?>" class="hiddenRider">
        <?php if($isChoose == false){ ?>
            <input type="button" value="Choose Rider" class="chooseBtn btn btn-info">
        <?php }else if ($isChoose == true){?>    
          <input type="button" value="Choose another prefer rider" class="chooseBtn btn btn-info">
      <?php }?>
    </div>
</form>
  <?php }?>

    

</div>
     
<script src="js/preferRider.js"></script>
</body>
</html>