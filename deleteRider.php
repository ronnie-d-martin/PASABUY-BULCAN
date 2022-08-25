<?php  
        include "connection.php";


   
        $riderId = $_POST["deleteriderId"];


        

        $query = "DELETE FROM rider WHERE rider_Id = '$riderId'";
        
       if(mysqli_query($conn,$query)){
            header("location:rider.php?message2=Rider account successfully deleted!");
        }
        else {
            header("location:rider.php?message=Rider account failed to delete!");

        }
        
    






?>