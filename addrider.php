<?php
    include_once "connection.php";

   
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $password = $_POST["password"];
        $repassword = $_POST["re-password"];
        $username = $_POST["username"];
        $address = $_POST["address"];
        $contactNo = $_POST["contact_no"];

        $contactNo = floatval($contactNo);


        
        if(!empty($first_name) && !empty($last_name) && !empty($password) && !empty($repassword) && !empty($username) || !empty($address) && !empty($contactNo) ){

             
        $query = "SELECT * FROM rider WHERE username = '$username'";
        $result = mysqli_query($conn,$query);

        $filename = $_FILES["rider_image"]["name"];
        $tempname = $_FILES["rider_image"]["tmp_name"];
        $folder = "Rider Image/".$filename;
    

            if(mysqli_num_rows($result) >= 1 ){
                $row = mysqli_fetch_assoc($result);

                    if($row["username"] == $username){
                        header("location: rider.php?message=Rider Username is Already Existing!");
                    }
                   
              }
              else {
                if(strlen($password) >=8){
                    if($password == $repassword){
                        $passwordMd5 = md5($password);
                        $sql = "INSERT INTO rider(first_name,last_name,username,password,address,contact_no,rider_image,rider_status) VALUE ('$first_name','$last_name','$username','$passwordMd5','$address','$contactNo','$filename','Offline');";
    
                       
                        if(mysqli_query($conn,$sql)){
                            move_uploaded_file($tempname, $folder);
                            header("location: rider.php?message2='Rider account successfully created!");
                        }
                        else {
                            header("location: rider.php?message2='Rider account failed to create!");

                        }
                      
        
                    }
                    else {
                        header("location: rider.php?message=Password Does not Matched!");
                    }
                }
                else {
                    header("location: rider.php?message=Passord length must be 6 and above!");

                }
               
              }
        
          

        }
        else {
           
            header("location: rider.php?message=Please Complete the fields");


        }
  
?>
