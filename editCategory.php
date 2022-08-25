<?php 

    include "connection.php";

    if(isset($_POST['editBtn'])){
        $categoryId = $_POST["categoryId"];
        $categoryName = $_POST["categoryName"];  

    
        $newImage = $_FILES["newImage"]["name"];
        $oldImage = $_POST['oldImage'];
        $temp= str_replace("https://pasabuybulacan.online/PasabuyBulacan/Category%20Image/","",$oldImage);
        $oldImage = str_replace("%20"," ",$temp);

     


       
        
        if($newImage != ''){
            $categorynewImage = $newImage;
        }
        else {
            $categorynewImage = $oldImage;
        }
        if(!empty($categoryName) && !empty($categorynewImage) ){
            $tempname = $_FILES["newImage"]["tmp_name"];
            $folder = "Category Image/".$categorynewImage;
            
            
    
            $query = "UPDATE category SET category_name = '$categoryName',category_image = '$categorynewImage' WHERE category_Id = '$categoryId'";
    
            if(mysqli_query($conn,$query)){
                move_uploaded_file($tempname,$folder);
                header("location: category.php?message2=Category informaton successfully changed!");
            }
            else {
                header("location: category.php?message=Category informaton failed to change!");
    
            }
    
        }
        else {
            header("location: category.php?message2=Please complete all the fields!");
        }

       
        
    }



?>