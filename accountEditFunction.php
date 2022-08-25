<?php 
      
    include "connection.php";
    session_start();
    
    $customer_Id = $_SESSION['userId'];
    $c_fname = $_POST['c_fname'];
    $c_lname = $_POST['c_lname'];
    $c_username = $_POST['c_username'];
    $c_address = $_POST['c_address'];
    $c_contact = $_POST['c_contact'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
  
    if(!empty($c_fname) && !empty($c_lname) && !empty($c_username) && !empty($c_address) && !empty($c_contact)){
       
        if(empty($c_image)){
            $update_customer = "UPDATE customer set First_Name='$c_fname',Last_Name='$c_lname',Username='$c_username',Address='$c_address',Contact_No='$c_contact'WHERE Customer_Id='$customer_Id'";
    
            $run_customer = mysqli_query($conn,$update_customer);
    
        
            if($run_customer){
        
                move_uploaded_file ($c_image_tmp,"Customer Image/$c_image");
                header("location:accountCustomer.php?edit_account&success=success");
                
            }

        }
        else{
            $update_customer = "UPDATE customer set First_Name='$c_fname',Last_Name='$c_lname',Username='$c_username',Address='$c_address',Contact_No='$c_contact',customer_image='$c_image' WHERE Customer_Id='$customer_Id'";
    
            $run_customer = mysqli_query($conn,$update_customer);
    
        
            if($run_customer){
        
                move_uploaded_file ($c_image_tmp,"Customer Image/$c_image");
                header("location:accountCustomer.php?edit_account&success=success");
                
            }
        }
    }
       else{
           header("location:accountCustomer.php?edit_account&error=true");
       } 
       
   
    

?>

