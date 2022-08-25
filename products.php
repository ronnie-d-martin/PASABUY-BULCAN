<?php include "connection.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <link rel="icon" href="images/logo_pasabuy.png" type="image/icon type">
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
<?php include "sidebarAdmin.php"?>
<br>

<div class="container">   
<button id="close_product" onclick="AddingProduct();">Adding Product</button><br><br>
    <form action="addproduct.php" method="post" enctype="multipart/form-data" id="productModal" style="display: none;">
    <p class="close" onclick="closeProduct();">&times;</p>
        <h3>Adding Product</h3>
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
        <select name="category" class="selector">
        <option value="" autofocus> Select Category</option>

            <?php  
                $query = "SELECT category_name FROM category";
                $result = mysqli_query($conn,$query);
                   while($row = mysqli_fetch_assoc($result)) {

            ?>
            <option value="<?php echo $row["category_name"] ?>"><?php echo $row["category_name"] ?> </option>
            <?php }?>
        </select>
        <br>
        <select name="merchant" class="selector">
        <option value="" autofocus> Select Merchant</option>
        
            <?php  
                $query = "SELECT merchant_name FROM merchant";
                $result = mysqli_query($conn,$query);
                   while($row = mysqli_fetch_assoc($result)) {

            ?>
            <option value="<?php echo $row["merchant_name"] ?>"><?php echo $row["merchant_name"] ?> </option>
            <?php }?>
        </select>
        <br>
        <input type="text" name="product_name" placeholder="Product Name" class="productInp">
        <br>
        <input type="text" name="product_description" placeholder="Product Description" class="productInp">
        <br>
        <input type="number" name="product_price" placeholder="Product Price"class="productInp">
        <br>
        <input type="file" name="product_image" id="inpmerchant">
        <br>
    

        <input type="submit" value="Add" class="addBtn">


    </form>
    <form action="searchProduct.php" method="post" enctype="multipart/form-data" class="searchForm">
        <input type="search" id="product_search" name="product_name"  placeholder="Search Product" class="formSearch">
        <input type="submit" class="btn btn-primary">
        <input type="submit" value="refresh" name="refresh" class="btn btn-success">
    </form>
    <table id="productTable">
            <tr class="fixedTop">
                <th><h5>Product ID</h5></th>
                <th><h5>Product Name</h5></th>
                <th><h5>Product Description</h5></th>
                <th><h5>Product Price</h5></th>
                <th><h5>Category Id</h5></th>
                <th><h5>Merchant Id</h5></th>
                <th><h5>Product Image</h5></th>
                <th><h5>Action</h5></th>
            </tr>
            <?php
            $searchProduct_name = "";
                if(isset($_GET['product_name'])){
                    $searchProduct_name = $_GET['product_name'];
                } 
                $query = "SELECT * FROM product WHERE product_name LIKE '%$searchProduct_name%' ORDER BY product_Id DESC";
                $result = mysqli_query($conn,$query);
                   while($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr class="products">
                <td class="trBorder"><?php echo $row['product_Id']?></td>
                <td class="trBorder"><?php echo $row['product_name']?></td>
                <td class="trBorder"><?php echo $row['product_description']?></td>
                <td class="trBorder"><?php echo "&#8369; ".$row['product_price']?></td>
                <td class="trBorder"><?php echo $row['category_Id']?></td>
                <td class="trBorder"><?php echo $row['merchant_Id']?></td>
                <td class="trBorder"><img src="<?php echo "Product Image/".$row['product_image']?>"></td>
                <td class="trBorder"> 
                            
            <Button type="button" name="editButton" class="editButton btn btn-info">Edit</Button>
                <form action="deleteProduct.php" method="POST" class="deleteCate">
                <input type="hidden" name="deleteProductId" class ="deleteProductId">
                <Button type="button" name="deleteButton" class="deleteButton btn btn-danger">Delete</Button>

                </form>
            </td>
            </tr>

            <?php }?>

    </table>
<br><br>
</div>
<div class="modal" >
            <form action="editProduct.php" method="POST" class="formModal" enctype="multipart/form-data">
                 <p class="close" onclick="closeModal();">&times;</p><br>
                 <p><b>Product Image</b></p>
                    <img src="" class="hiddenImage">
                    <input type="file" name="newImage" class="newImage">
                    <input type="hidden" name="oldImage" class="oldImage"><br>
                <select name="category" class="selector1">
                <option value="" autofocus> Select Category</option>

                    <?php  
                        
                        $query = "SELECT category_name FROM category";
                        $result = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($result)) {

                    ?>
                    <option value="<?php echo $row["category_name"] ?>"><?php echo $row["category_name"] ?> </option>
                    <?php }?>
                </select>
                <br>
                <select name="merchant" class="selector2">
                <option value="" autofocus> Select Merchant</option>
                
                    <?php  
                        $query = "SELECT merchant_name FROM merchant";
                        $result = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($result)) {

                    ?>
                    <option value="<?php echo $row["merchant_name"] ?>"><?php echo $row["merchant_name"] ?> </option>
                    <?php }?><br>
                </select>
                <br>
                   <label class="labelto"><b>Product Name</b></label>
                    <input type="text" name="productName" class="hiddenName">
                    <input type="hidden" name="productId" class="hiddenId"><br>
                    <label class="labelto"><b>Product Description</b></label>
                    <input type="text" name="productDescription" class="hiddenDescription"><br>
                    <label class="labelto"><b>Product Price</b></label>
                    <input type="number" name="productPrice" class="hiddenPrice"><br>
                    <input type="submit" value="Save" name="editBtn" class="editBtn">
            </form>
    </div>

    <script src="js/product.js"></script>
</body>
</html>