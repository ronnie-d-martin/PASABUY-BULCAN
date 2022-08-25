<?php include "connection.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider</title>
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/logo_pasabuy.png" type="image/icon type">
    <link rel="stylesheet" href="css/rider.css">
</head>
<body>
    <?php include "sidebarAdmin.php"?>
<br>
 <div class="container">
 <button id="close_rider" onclick="addingRider();">Adding Rider</button><br>
 <form action="addrider.php" method ="POST" enctype="multipart/form-data" id="riderModal" style="display: none;">
    <p class="close" onclick="closeRider();">&times;</p><br>
     <h3>Adding Rider</h3>
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
        <input type="text" name="first_name" placeholder="First Name" class="inpRider2">
        <input type="text" name="last_name" placeholder="Last Name" class="inpRider2">
        <br>
        <input type="text" name="username" placeholder="Username" class="inpRider">
        <br>
        <input type="password" name="password" placeholder="Password" class="inpRider2">
        <input type="password" name="re-password" placeholder="Confirm Password" class="inpRider2">
        <!--<h6>-must be at least 8 characters long</h6>-->
        <input type="text" name="address" placeholder="Address"class="inpRider">
        <br>
        <input type="text" name="contact_no" placeholder="Contact No. Sample: 09984476132" class="inpRider" maxlength="11">
        <br>
        <input type="file" name="rider_image"  id="categoryimage"><br>
        <input type="submit" value="Add" name="submit" class="addBtn">
    </form><br>
    <form action="searchProduct.php" method="post" enctype="multipart/form-data" class="searchForm">
        <input type="search" id="rider_search" name="rider_name" placeholder="Search Rider" class="formSearch">
        <input type="submit" class="btn btn-primary">
        <input type="submit" value="refresh" name="refresh4" class="btn btn-success">
    </form>
    <table id="riderTable">
            <tr>
                <th><h5>Rider ID</h5></th>
                <th><h5>Rider FirstName</h5></th>
                <th><h5>Rider LastName</h5></th>
                <th><h5>Rider Username</h5></th>
                <th><h5>Rider Address</h5></th>
                <th><h5>Rider Contact No.</h5></th>
                <th><h5>Rider Image</h5></th>
                <th><h5>Action</h5></th>
            </tr>
            <?php 
              $searchRider_name = "";
              if(isset($_GET['rider_name'])){
                  $searchRider_name = $_GET['rider_name'];
              } 
                $query = "SELECT * FROM rider  WHERE username LIKE '%$searchRider_name%' ORDER BY rider_Id DESC";
                $result = mysqli_query($conn,$query);
                   while($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr class="riders">
                <td class="riderId"><?php echo $row['rider_Id']?></td>
                <td class="riderFname"><?php echo $row['first_name'] ?> </td>
                <td class="riderLname"><?php echo $row['last_name']?></td>
                <td class="riderUsername"><?php echo $row['username']?></td>
                <td class="riderAddress"><?php echo $row['address']?></td>
                <td class="riderContactNo"><?php echo $row['contact_no']?></td>
                <td class="riderImage"><img src="<?php echo "Rider Image/".$row['rider_image']?>"></td>
                <td class="trBorder"> 

                    <Button type="button" name="editButton" class="editButton btn btn-info">Edit</Button>
                    <form action="deleteRider.php" method="POST" class="deleteCate">

                        <input type="hidden" name="deleteriderId" class ="deleteriderId">
                        <Button type="button" name="deleteButton" class="deleteButton btn btn-danger">Delete</Button>

                    </form>
                </td>
            </tr>

            <?php }?>
    </table>
<br><br>
 </div>
    
    <div class="modal" >
            <form action="editRider.php" method="POST" class="formModal" enctype="multipart/form-data">
                 <p class="close" onclick="closeModal();">&times;</p><br>
                    <img src="" class="hiddenImage"><br>
                    <input type="file" name="newImage" class="newImage">
                    <input type="hidden" name="oldImage" class="oldImage"><br>
                    <label><b>Name</b></label>
                    <input type="hidden" name="riderId" class="hiddenId">
                    <input type="text" name="riderFname" class="hiddenFname">
                    <input type="text" name="riderLname" class="hiddenLname"><br>
                    <label><b>Username</b></label>
                    <input type="text" name="riderUsername" class="hiddenUsername"><br>
                    <label><b>Address</b></label>
                    <input type="text" name="riderAddress" class="hiddenAddress"><br>
                    <label><b>Contact Number</b></label>
                    <input type="text" name="riderContactNo" class="hiddenContactNo" maxlength="11" >
                    <input type="submit" value="Save" name="editBtn" class="editBtn">
            </form>
    </div>
   
    <script src="js/rider.js"></script>
</body>
</html>