<?php  
        include "connection.php";


   
        $productId = $_POST["deleteProductId"];


        

        $query = "DELETE FROM product WHERE product_Id = '$productId'";
        
       if(mysqli_query($conn,$query)){
            header("location:products.php?message2=Product successfully deleted!");
        }
        else {
            header("location:products.php?message=Product failed to delete!");

        }
        
    






?>