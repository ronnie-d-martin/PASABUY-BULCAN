<?php
    include_once "connection.php";

   
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $password = $_POST["password"];
        $repassword = $_POST["re-password"];
        $username = $_POST["username"];
        $address = $_POST["address"];
        $contactNo = $_POST["contact_no"];
        if(!empty($first_name) && !empty($last_name) && !empty($password) && !empty($repassword) && !empty($username) || !empty($address) && !empty($contactNo) ){

             
        $query = "SELECT * FROM customer WHERE Username = '$username'";
        $result = mysqli_query($conn,$query);

            if(mysqli_num_rows($result) >= 1 ){
                $row = mysqli_fetch_assoc($result);

                    if($row["Username"] == $username){
                        header("location: login.php?messagePassword=Username is Already Existing!");
                    }
                   
              }
              else {
                if(strlen($password) >=8){
                    if($password == $repassword){
                        $sql = "INSERT INTO customer(First_Name,Last_Name,Username,Password,Address,Contact_No) VALUE ('$first_name','$last_name','$username','$password','$address','$contactNo');";
                        mysqli_query($conn,$sql);
                        header("location: login.php");
        
                    }
                    else {
                        header("location: login.php?messagePassword=Password Does not Matched!");
                    }
                }
                else {
                    header("location: login.php?messagePassword=Password length must be 6 and above!");

                }
               
              }
        
          

        }
        else {
           
            header("location: login.php?messagePassword=Please Complete the fields");


        }
  
?>
