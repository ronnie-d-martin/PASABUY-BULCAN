<?php
    include "connection2.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.csss" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<?php include "sidebarCustomer.php";?>
<!--cover photo-->
    <div class="cover" id="cover_hide">
            <img  src="images/cover_pasabuy_1.png">
        </div>
<!-- BODY -->

<div class="category-container"><br><br>
    <div><h2><strong class="category-title">Categories</strong></h2></div><br>
    <div class="category-items">
     <?php 

        $queryCategory = "SELECT * FROM category";
        $result = mysqli_query($conn,$queryCategory);

        while($row = mysqli_fetch_assoc($result)){
           
        
     ?>   
        <div class="category-item bg-image hover-zoom">
            <input type="hidden" value= "<?php echo $row['category_Id'];?>">
            <img src="<?php echo "Category Image/".$row['category_image'];?>" >
            <h4><?php echo $row['category_name'];?></h4>
        </div>

        <?php }?>
      

    </div>

</div><br><br>
<?php include "footer.php";?>
<script src="js/script.js"></script>


</body>
</html>