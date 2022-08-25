<?php 

    include "connection.php";

    if(isset($_POST['editBtn'])){
        $merchantId = $_POST["merchantId"];
        $merchantName = $_POST["merchantName"];
        $merchantDescription = $_POST["merchantDescription"]; 

        $newImage = $_FILES["newImage"]["name"];
        $oldImage = $_POST['oldImage'];
        $temp= str_replace("https://pasabuybulacan.online/PasabuyBulacan/Merchant%20Image/","",$oldImage);
        $oldImage = str_replace("%20"," ",$temp);

       
       
        
        if($newImage != ''){
            $merchantnewImage = $newImage;
        }
        else {
            $merchantnewImage = $oldImage;
        }


        $tempname = $_FILES["newImage"]["tmp_name"];
        $folder = "Merchant Image/".$merchantnewImage;
        
        
        

        $query = "UPDATE merchant SET merchant_name = '$merchantName', merchant_description = '$merchantDescription', merchant_logo = '$merchantnewImage' WHERE merchant_Id = '$merchantId'";

        if(mysqli_query($conn,$query)){
            move_uploaded_file($tempname,$folder);
            header("location: merchants.php?message2=Merchant informaton successfully changed!");
        }
        else {
            header("location: merchants.php?message=Merchant informaton failed to change!");

        }
        

        
    }



?>