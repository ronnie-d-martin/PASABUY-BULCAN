<?php 
    include_once 'connection.php';
    session_start();
        
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $query = "SELECT * FROM customer WHERE Username = '$username' AND Password = '$password'";
        $result = mysqli_query($conn,$query);

        $query2 = "SELECT * FROM admin WHERE Username = '$username' AND Password = '$password'";
        $result2 = mysqli_query($conn,$query2);

        $query3 = "SELECT * FROM rider WHERE username = '$username' AND password = '$password'";
        $result3 = mysqli_query($conn,$query3);

        if(mysqli_num_rows($result2) >= 1 ){
         $row2 = mysqli_fetch_assoc($result2);

         if($row2['Username'] === $username && $row2['Password'] === $password ){
             $_SESSION["userId"] = $row2["Admin_Id"];
            header("location: adminpage.php");
        }
        
        }
        else if(mysqli_num_rows($result) >=1) {
                
            if(mysqli_num_rows($result) >= 1 ){
                $row = mysqli_fetch_assoc($result);
                if($row['Username'] === $username && $row['Password'] === $password ){
                    $_SESSION["userId"] = $row["Customer_Id"];
                    header("location: index.php");
                }
            }
           
        }
        else if (mysqli_num_rows($result3)>=1){
            $row3 = mysqli_fetch_assoc($result3);

            if($row3['username'] === $username && $row3['password'] === $password ){
                $_SESSION["userId"] = $row3["rider_Id"];
               header("location: riderpage.php");
           }
        }






        

      

        
        
    
?>