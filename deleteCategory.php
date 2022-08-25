<?php  
        include "connection.php";


   
        $categoryId = $_POST["deletecategoryId"];

        

        $query = "DELETE FROM category WHERE category_Id = '$categoryId'";
        
        if(mysqli_query($conn,$query)){
            header("location:category.php?message2=Category successfully deleted!");
        }
        else {
            header("location:category.php?message=Category failed to delete!");

        }
    






?>