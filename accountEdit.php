<?php 

////KUNIN MGA DATA


$query = "SELECT * from customer WHERE Customer_Id = '$customer_Id'";
$result = mysqli_query($conn,$query);

if($result){
    $row = mysqli_fetch_assoc($result);

    $firstName = $row["First_Name"];
    $lastName = $row["Last_Name"];
    $userName = $row["Username"];
    $passWord = $row["Password"];
    $address = $row["Address"];
    $contact_No = $row["Contact_No"];
    $customer_image = $row["customer_image"];

}

?>

<h1 align="center"> Edit Your Account </h1>

<form action="accountEditFunction.php" method="post" enctype="multipart/form-data" class="formAccount">
    <?php if(isset($_GET["error"])){
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please complete all the fields!',
        })
        </script>";
    }
    else if(isset($_GET["success"])){
        echo "<script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Succesfully Changed',
            showConfirmButton: false,
            timer: 2000,
        })</script>";
    }?>
    <div class="form-group">

        <label> Customer First Name: </label>       
        <input type="text" name="c_fname" class="form-control" value="<?php echo $firstName; ?>" required> <!----PARA MADISPLAY UNG LAMAN NG DATABASE PER FIELDS!!!!---->
        </div>

        <div class="form-group">   
        <label> Customer Last Name: </label>       
        <input type="text" name="c_lname" class="form-control" value="<?php echo $lastName; ?>" required> <!----PARA MADISPLAY UNG LAMAN NG DATABASE PER FIELDS!!!!---->
        </div>
    
        <div class="form-group">       
        <label> Customer Username: </label>        
        <input type="text" name="c_username" class="form-control" value="<?php echo $userName; ?>" required>
        </div>
      
     
        <div class="form-group">      
        <label> Customer Address: </label>
        <input type="text" name="c_address" class="form-control" value="<?php echo $address; ?>" required>       
        </div>

        <div class="form-group">
        <label> Customer Contact: </label>      
        <input type="text" name="c_contact" class="form-control" value="<?php echo $contact_No; ?>" required maxlength="11">     
        </div>
    
        <div class="form-group">
        <label> Customer Image: </label>
        <input type="file" name="c_image" class="form-control form-height-custom" value="<?php echo "Customer Image/".$customer_image;?>" required>    
              
        </div>
    
        <div class="text-center">       
        <button type="submit" class="btn btn-info" id="updateBtn" name="update" >           
         <i class="fa fa-user-md"></i> Update Now           
        </button>        
        </div>

        <script src="js/account.js"></script>

</form>


