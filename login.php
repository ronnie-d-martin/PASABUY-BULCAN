<?php 

    include "connection.php";
     
    session_start();

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        
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
             $_SESSION["userName"] = $row2["Username"];
            header("location: adminpage.php");
        }
        else {
            echo '<script type="text/javascript"> alert("Invalid Username or Password"); </script>';

        }
        
    }
      
                
     else if(mysqli_num_rows($result) >= 1 ){
                $row = mysqli_fetch_assoc($result);
                if($row['Username'] === $username && $row['Password'] === $password ){
                    $_SESSION["userId"] = $row["Customer_Id"];
                    $_SESSION["userName"] = $row["Username"];
                    
                    header("location: index.php");
                }
                else {
                    echo '<script type="text/javascript"> alert("Invalid Username or Password"); </script>';
        
                }
            }
        else if (mysqli_num_rows($result3)>=1){
                $row3 = mysqli_fetch_assoc($result3);
    
                if($row3['username'] === $username && $row3['password'] === $password ){
                    $_SESSION["userId"] = $row3["rider_Id"];
                    $_SESSION["userName"] = $row3["username"];
                    $logId = $row3["rider_Id"];
                    $riderstatus = "UPDATE rider SET rider_status = 'Active' WHERE rider_Id = '$logId'";
                    $resultstatus = mysqli_query($conn,$riderstatus);
                   header("location: riderpage.php");
               }
               else {
                echo '<script type="text/javascript"> alert("Invalid Username or Password"); </script>';
    
            }
            }
            else {
                echo '<script type="text/javascript"> alert("Invalid Username or Password"); </script>';
               
            }
        


    
        
    }

if(isset($_POST["first_name"]) && $_POST['g-recaptcha-response'] != ""){
            
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $password = $_POST["password"];
        $repassword = $_POST["re-password"];
        $username = $_POST["username"];
        $address = $_POST["address"];
        $contactNo = $_POST["contact_no"];
        $userImg = 'default.png';
        $secret = '6Lcx92AeAAAAAHwkDyljxK0UCMkC8OC8ol0Go7sE';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

      

        if(!empty($first_name) && !empty($last_name) && !empty($password) && !empty($repassword) && !empty($username) && !empty($address) && !empty($contactNo) && $responseData->success){

             
        $query = "SELECT * FROM customer WHERE Username = '$username'";
        $result = mysqli_query($conn,$query);

            if(mysqli_num_rows($result) >= 1 ){
                $row = mysqli_fetch_assoc($result);

                    if($row["Username"] == $username){
                        echo '<script>alert("Username is already existing!"); </script>';
                    }
                   
              }
              else if(filter_var($username, FILTER_VALIDATE_EMAIL) === false){
                echo '<script type="text/javascript"> alert("Invalid email address"); </script>';
            }  
              else {
                if(strlen($password) >=8){
                    if($password == $repassword){
                        $passwordmd5 = md5($password);
                      
                        $sql = "INSERT INTO customer(First_Name,Last_Name,Username,Password,Address,Contact_No,customer_image) VALUE ('$first_name','$last_name','$username','$passwordmd5','$address','$contactNo','$userImg');";
                        mysqli_query($conn,$sql);
                        echo '<script type="text/javascript"> alert("Account sucessfully created!"); </script>';
                  }                 
                }
              }
            }
        }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/logo_pasabuy.png" type="image/icon type">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<br><br>
<form action="login.php" method="POST" id="formLogin">
<br><br>
    <div><img src="images/logo_pasabuy.png" id="logo_img"></div><br><br><br>
    <div class="errormessage">
            <?php
            if(isset($_GET['message'])){
                echo $_GET['message'];
            }?> </div>
        <input type="text" name ="username" placeholder="Email Address" id="uname"><br><br>
        <input type="password" name ="password" placeholder="Password" id="pword"><br><br>
        <input type="submit" value="Login" name ="login" id="loginbtn">
        <p><span>Forget Password?</span></p>
        <p>not a member?<span id="signUp" onclick="show_signup();"> Sign Up now</span></p>
    </form>
<!--Sign Up-->
<form action="login.php" method ="POST" id="formSignup" style="display:none;"><br>
    <h1>Sign Up</h1>
    <h2>PasaBuy Bulacan</h2>
    <hr class="solid">
    <br>
        <div class="errormessagePassword">
            <?php
            if(isset($_GET['message'])){
                echo $_GET['message'];
            }?></div><br>
        <input type="text" name="first_name" placeholder="First Name" id="signUpFirstName">
        <input type="text" name="last_name" placeholder="Last Name" id="signUpLastName"><br><br>
        <input type="text" name="username" placeholder="Email Address" id="signUpUsername" minlength="8" ><br><br>
        <input type="password" name="password" placeholder="Password" id="signUpPassword"  minlength="8">
        <input type="password" name="re-password" placeholder="Confirm Password" id="signUpConfirmPassword" ><br><br>
        <input type="text" name="address" placeholder="Permanent Address" id="signUpAddress" ><br><br>
        <input type="text" name="contact_no" placeholder="Contact No. Sample: 09984476132" maxlength="11" required id="signUpContactNo"><br><br>
        <center>
        <div class="g-recaptcha" data-sitekey="6Lcx92AeAAAAACujCGUK0-V5n6GAAiEJZlAZjpAy"></div>
        </center>
        <p>Already have Account?<span id="signUp" onclick="show_login();"> Sign In</span></p>
        <p><input type="checkbox" required>By creating this account, you agree to our <span onclick="showPolicy()"> Privacy Policy</span>.</p>    
        <input type="button" value="Sign Up" id="signupbtn" onclick="checkSignUp()">
    </form>

    <div id="pPolicy" style="display:none;">
        <h1 id="closePrivacy" onclick="closePolicy()">&times;</h1><br><br>
        <p>
          <strong>What information do we collect about you?</strong>  
            <p>
            We collect personal information from you when you order goods or services from us or use our website. We also collect information when you complete any customer survey. Website usage information may also be collected using cookies.
            </p>
           <strong>How will we use the information we collect from you?</strong> 
            <p>
            Information that we collect from you is used to process your order and to manage your account. We may also use your information to email you about other products or services that we think may be of interest to you.
            </p>
            <p>
            In processing your order we may send your information to credit reference and fraud prevention agencies.
            </p>
            <strong>Access to your information</strong>
            <p>
            You have a right to request a copy of the information we hold on you at any time.
            </p>
            <strong>Other Websites</strong>
            <p>
            Our website may have links to other websites. This privacy policy only applies to this website. You should therefore read the privacy policies of the other websites when you are using those sites.</p>
        </p>
    </div>

<script src="js/login.js"></script>
</body>
</html>