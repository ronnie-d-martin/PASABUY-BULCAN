<?php  
        include "connection.php";


   
        $merchantId = $_POST["deletemerchantId"];


        

        $query = "DELETE FROM merchant WHERE merchant_Id = '$merchantId'";
        
       if(mysqli_query($conn,$query)){
            header("location:merchants.php?message2=Merchant successfully deleted!");
        }
        else {
            header("location:merchants.php?message=Merchant failed to delete!");

        }
        
    






?>