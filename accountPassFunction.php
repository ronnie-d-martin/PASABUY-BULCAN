<?php 
      
    include "connection.php";
    session_start();
    
    $customer_Id = $_SESSION['userId'];
    $c_old_pass = md5($_POST['old_pass']);
    $c_new_pass = $_POST['new_pass'];
    $c_new_pass_again = $_POST['new_pass_again'];

    $query = "SELECT * FROM customer WHERE Customer_Id= '$customer_Id'";
    $result = mysqli_query($conn,$query);
    
    if($result){
        $row = mysqli_fetch_assoc($result);

        if($c_old_pass == $row['Password']){
            if(strlen($c_new_pass) >= 8){
                if($c_new_pass == $c_new_pass_again){
                    $new_password = md5($c_new_pass);
                    $query2 = "UPDATE customer SET Password='$new_password'WHERE Customer_Id= '$customer_Id'";
                    $result2 = mysqli_query($conn,$query2);
    
                    if($result2){
                        header("location:accountCustomer.php?change_pass&success= Succesfully changed");
                    }
                }
    
            else{
                 header("location:accountCustomer.php?change_pass&error2= Password didn't match");           
                 }
            }
        else{
            header("location:accountCustomer.php?change_pass&error3= passwod 8");
        }
            
        }

        else{
            header("location:accountCustomer.php?change_pass&error1= Old password didn't match");           
            }
    }



?>