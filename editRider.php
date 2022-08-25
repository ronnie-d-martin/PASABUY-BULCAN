<?php

use function PHPSTORM_META\type;

include "connection.php";

    if(isset($_POST['editBtn'])){
        $riderId = $_POST["riderId"];
        $riderFname = $_POST["riderFname"];  
        $riderLname = $_POST["riderLname"];
        $riderUsername = $_POST["riderUsername"];
        $riderAddress = $_POST["riderAddress"];
        $riderContactNo = $_POST["riderContactNo"];

    

     


        
        $oldImage = $_POST['oldImage'];
        $temp= str_replace("https://pasabuybulacan.online/PasabuyBulacan/Rider%20Image/","",$oldImage);
        $oldImage = str_replace("%20"," ",$temp);

        

       $newImage = $_FILES["newImage"]["name"];

         
        if($newImage != ''){
            $ridernewImage = $newImage;
        }
        else {
            $ridernewImage = $oldImage;
        }


        

        $tempname = $_FILES["newImage"]["tmp_name"];
        $folder = "Rider Image/".$ridernewImage;

        $query = "UPDATE rider SET first_name = '$riderFname', last_name = '$riderLname', username = '$riderUsername', address = '$riderAddress', contact_no = '$riderContactNo', rider_image = '$ridernewImage' WHERE rider_Id = '$riderId'";

        

       if(mysqli_query($conn,$query)){
            move_uploaded_file($tempname,$folder);
            header("location: rider.php?message2=Rider informaton successfully changed!");
        }
        
        
    }



?>