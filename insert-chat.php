<?php 
    
    include "connection.php";

    session_start();
    if(isset($_SESSION['userId'])){
        $outgoing_id = $_SESSION['userId'];
        $incoming_id = $_POST['incoming_id'];
        $messages =  $_POST['message'];
        
        if(!empty($messages)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ('$incoming_id','$outgoing_id','$messages')"); 
                                        
        }
    }else{
        header("location:login.php");
    }


    
?>