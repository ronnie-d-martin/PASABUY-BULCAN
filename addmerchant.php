<?php 
        include_once "connection.php";

        $merchantname = $_POST["merchantname"];
        $merchantdescription = $_POST["merchantdescription"];

        if(!empty($merchantname) && !empty($merchantdescription) && !empty($filename = $_FILES["merchantlogo"]["name"])){

        $query = "SELECT * FROM merchant WHERE merchant_name = '$merchantname'";
        $result = mysqli_query($conn,$query);

            if(mysqli_num_rows($result) >= 1 ){

                $row = mysqli_fetch_assoc($result);

               

                if( strtoupper($row['merchant_name']) == strtoupper($merchantname)){
                    header("location:merchants.php?message=Merchant is already existing!");
                }
                
            }
            else {

                     $filename = $_FILES["merchantlogo"]["name"];
                     $tempname = $_FILES["merchantlogo"]["tmp_name"];
                     $folder = "Merchant Image/".$filename;

                    $query2 = "INSERT INTO merchant (merchant_name,merchant_description,merchant_logo) VALUES ('$merchantname','$merchantdescription','$filename');";
                  
                    if( mysqli_query($conn,$query2)){
                        header("location:merchants.php?message2=Merchant sucessfully added!");
                        move_uploaded_file($tempname, $folder);

                    }

            }

        }
            else {
                header("location:merchants.php?message= Please complete the field!");
        }




?>