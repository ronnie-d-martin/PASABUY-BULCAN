<?php 
        include_once "connection.php";

        
        $categoryname = $_POST["categoryname"];


        if(!empty($categoryname) && !empty( $filename = $_FILES["categoryimage"]["name"])){

            $query = "SELECT * FROM category WHERE category_name = '$categoryname'";
            $result = mysqli_query($conn,$query);

            if(mysqli_num_rows($result) >= 1 ){

                $row = mysqli_fetch_assoc($result);

               

                if( strtoupper($row['category_name']) == strtoupper($categoryname)){
                    header("location:category.php?message=Category is already existing!");
                }
                
            }
            else {

                     $filename = $_FILES["categoryimage"]["name"];
                     $tempname = $_FILES["categoryimage"]["tmp_name"];
                     $folder = "Category Image/".$filename;

                    $query2 = "INSERT INTO category (category_name,category_image) VALUES ('$categoryname','$filename');";
                  
                    if( mysqli_query($conn,$query2)){
                        header("location:category.php?message2=Category sucessfully added!");
                        move_uploaded_file($tempname, $folder);

                    }

            }

        }
        else {
            header("location:category.php?message= Please complete the field!");

        }
        





?>