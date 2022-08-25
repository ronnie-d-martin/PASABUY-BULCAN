<?php 

    include "connection.php";

    if(isset($_POST['editBtn'])){
        $productId = $_POST["productId"];
        $productDescription = $_POST["productDescription"];  
        $productPrice = $_POST["productPrice"];  
        $productName = $_POST["productName"]; 
      
        $oldImage = $_POST['oldImage'];
        $productPrice = str_replace("₱","",$productPrice);


        $temp= str_replace("https://pasabuybulacan.online/PasabuyBulacan/Product%20Image/","",$oldImage);
        $oldImage = str_replace("%20"," ",$temp);
        $newImage = $_FILES["newImage"]["name"];
        

        
        $category = $_POST["category"];
        $merchant = $_POST["merchant"]; 

     
        

        
     
        if(!is_numeric($category)){
            $categoryquery = "SELECT * FROM category WHERE category_name = '$category'";
            $categoryresult = mysqli_query($conn,$categoryquery);
    
             if(mysqli_num_rows($categoryresult) >=1){
                 $row = mysqli_fetch_assoc($categoryresult);
    
                 $categoryId = $row["category_Id"]; 
            }
        
        }
        else {
            $categoryId = $category;
        }

        if(!is_numeric($merchant)){
            $merchantquery = "SELECT * FROM merchant WHERE merchant_name = '$merchant'";
            $merchantresult = mysqli_query($conn,$merchantquery);
   
       if(mysqli_num_rows($merchantresult) >=1){
           $row = mysqli_fetch_assoc($merchantresult);
           $merchantId = $row["merchant_Id"]; 
       }
   
        }
        else {
            $merchantId = $merchant;
        }
        

       
        
        if($newImage != ''){
            $productnewImage = $newImage;
        }
        else {
            $productnewImage = $oldImage;
        }

        $tempname = $_FILES["newImage"]["tmp_name"];
        $folder = "Product Image/".$productnewImage;
        
        

        $query = "UPDATE product SET product_name = '$productName',product_image = '$productnewImage', product_description = '$productDescription', product_price = '$productPrice', category_Id = '$categoryId', merchant_Id = '$merchantId' WHERE product_Id = '$productId'";

        if(mysqli_query($conn,$query)){
            move_uploaded_file($tempname,$folder);
            header("location: products.php?message2=Product informaton successfully changed!");
        }
        else {
            header("location: products.php?message=Product informaton failed to change!");

        }
       

        
    }



?>