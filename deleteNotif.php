<?php  
        include "connection.php";

        $customer_Id = $_POST["customer_Id"];

        $queryDelete = "DELETE FROM notification WHERE customer_Id = '$customer_Id'";
        $resultDelete = mysqli_query($conn,$queryDelete);
      
        if($resultDelete){
                header("location:index.php");
        }
?>