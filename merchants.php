<?php include "connection.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchants Page</title>
    <link rel="icon" href="images/logo_pasabuy.png" type="image/icon type">
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
<?php include "sidebarAdmin.php";?>
<br>

<div class="container">
<button id="close_merchant" onclick="addingMerchant();">Adding Merchant</button><br><br>
<form action="addmerchant.php" method="post" enctype="multipart/form-data" id="merchantModal" style="display:none;">
    <p class="close" onclick="closeMerchant();">&times;</p><br>
    <h3>Adding Merchant</h3>
     <div>
                <?php
                if(isset($_GET['message'])){
                    $newMessagge = $_GET['message'];
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '$newMessagge',
                    })
                    </script>";
                }?>
        </div>
        <div>
                <?php
                if(isset($_GET['message2'])){
                    $newMessage2 = $_GET['message2'];
                    echo "<script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: '$newMessage2',
                        showConfirmButton: false,
                        timer: 2000,
                    })</script>";

                } ?> 
            </div>
        <input type="text" name = "merchantname" placeholder="Merchant Name" class="merchantInp">
        <br>
        <input type="text" name="merchantdescription" placeholder="Merchant Description" class="merchantInp">
        <br>
        <input type="file" name="merchantlogo" id="inpmerchant">
        <br>
        <input type="submit" value="Add" class="addBtn">
    </form>
<br>

<form action="searchProduct.php" method="post" enctype="multipart/form-data" class="searchForm">
        <input type="search" id="merchant_search" name="merchant_name" placeholder="Search Merchant" class="formSearch">
        <input type="submit" class="btn btn-primary">
        <input type="submit" value="refresh" name="refresh3" class="btn btn-success">
    </form>
    <table id="merchantTable">
            <tr class="fixedTop">
                <th><h5>Merchant ID</h5></th>
                <th><h5>Merchant Name</h5></th>
                <th><h5>Merchant Description</h5></th>
                <th><h5>Merchant Logo</h5></th>
                <th><h5>Action</h5></th>
            </tr>
            <?php 
             $searchMerchant_name = "";
             if(isset($_GET['merchant_name'])){
                 $searchMerchant_name = $_GET['merchant_name'];
             } 
                $query = "SELECT * FROM merchant WHERE merchant_name LIKE '%$searchMerchant_name%'ORDER BY merchant_Id DESC";
                $result = mysqli_query($conn,$query);
                   while($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr class="merchants">
                <td class="trBorder"><?php echo $row['merchant_Id']?></td>
                <td class="trBorder"><?php echo $row['merchant_name']?></td>
                <td class="trBorder"><?php echo $row['merchant_description']?></td>
                <td class="trBorder"><img src="<?php echo "Merchant Image/".$row['merchant_logo']?>"></td>
                <td class="trBorder"> 

                    <Button type="button" name="editButton" class="editButton btn btn-info">Edit</Button>
                    <form action="deleteMerchant.php" method="POST" class="deleteCate">

                        <input type="hidden" name="deletemerchantId" class ="deletemerchantId">
                        <Button type="button" name="deleteButton" class="deleteButton btn btn-danger">Delete</Button>

                    </form>
                </td>
            </tr>

            <?php }?>

    </table>


    
<br><br>

      
</div>
<div class="modal">
        <form action="editMerchant.php" method="POST" class="merchantsformModal" enctype="multipart/form-data">
                 <p class="close" onclick="closeModal();">&times;</p><br>
                 <p><b>Merchant Image</b></p>
                    <img src="" class="hiddenImage"><br>
                    
                    <input type="file" name="newImage" class="newImage">
                    <input type="hidden" name="oldImage" class="oldImage"><br>
                    <label><b>Name</b></label>
                    <input type="hidden" name="merchantId" class="hiddenId"><br>
                    <input type="text" name="merchantName" class="hiddenName"><br>
                    <label><b>Description</b></label><br>
                    <input type="text" name="merchantDescription" class="hiddenDescription"><br>
                    <input type="submit" value="Save" name="editBtn" class="editBtn"><br>
        </form>
    </div>

<script src="js/merchant.js"></script>
</body>
</html>