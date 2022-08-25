<?php 
    include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="icon" href="images/logo_pasabuy.png"type="image/icon type">
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
<?php include "sidebarAdmin.php"?>
<br>
<div class="container">
    <button id="close_category" onclick="addingCategory()">Adding Category</button><br>
        <form action="addcategory.php" method="post" enctype="multipart/form-data" id="categoryModal" style="display:none;">
        <p class="close" onclick="categoryClose();">&times;</p>
        <h3>Adding Category</h3>
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
            <input type="text" name = "categoryname" placeholder="Category Name" id="categoryName">
            <br>
            <input type="file" name="categoryimage" id="categoryimage">
            <br>
            <input type="submit" value="Add" class="addBtn">
        </form>
    <br>
    <form action="searchProduct.php" method="post" enctype="multipart/form-data" class="searchForm">
        <input type="search" id="category_search" name="category_name" placeholder="Search Category" class="formSearch">
        <input type="submit" class="btn btn-primary">
        <input type="submit" value="Refresh" name="refresh2" class="btn btn-success">
    </form>
    <table id="categoryTable" >
            <tr class="fixedTop">
                <th><h5>Category ID</h5></th>
                <th><h5>Category Name</h5></th>
                <th><h5>Category Image</h5></th>
                <th><h5>Action</h5></th>
            </tr>
            <?php 
             $searchCategory_name = "";
             if(isset($_GET['category_name'])){
                 $searchCategory_name = $_GET['category_name'];
             } 
                $query = "SELECT * FROM category WHERE category_name LIKE '%$searchCategory_name%'ORDER BY category_Id DESC";
                $result = mysqli_query($conn,$query);
                   while($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr class="category">
                <td class="trBorder"><?php echo $row['category_Id']?></td>
                <td class="trBorder"><?php echo $row['category_name']?></td>
                <td class="trBorder" id="categoryImg"><img src="<?php echo "Category Image/".$row['category_image']?>"></td>
                <td class="trBorder">

                <Button type="button" name="editButton" class="editButton btn btn-info">Edit</Button>
                    <form action="deleteCategory.php" method="POST" class="deleteCate">
                        
                        <input type="hidden" name="deletecategoryId" class ="deletecategoryId">
                        <Button type="button" name="deleteButton" class="deleteButton btn btn-danger">Delete</Button>

                    </form>
                </td>
            </tr>

        <?php }?>
    </table>
    <br><br>
    </div>
    
    <div class="modal" >
            <form action="editCategory.php" method="POST" class="categoryFormModal" enctype="multipart/form-data">
            <p class="close" onclick="closeModal();">&times;</p><br>
                <label><b>Category Image</b></label>
                    <img src="" class="hiddenImage"><br>
                    <input type="file" name="newImage" class="newImage">
                    <input type="hidden" name="oldImage" class="oldImage">
                    <input type="hidden" name="categoryId" class="hiddenId"><br>
                    <label><b>Category Name</b></label>
                    <input type="text" name="categoryName" class="hiddenName"><br>

                    <input type="submit" value="Save" name="editBtn" class="saveBtn">
         
            </form>
    </div>
    <script src="js/category.js"></script>
</body>
</html>