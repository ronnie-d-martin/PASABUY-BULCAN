<?php 
include "connection.php";
    session_start();
    if(isset($_SESSION['userId'])){
     
        $outgoing_id = $_SESSION['userId'];
        $incoming_id = $_POST['incoming_id'];
        $output = "";
        $sql = "SELECT * FROM messages WHERE outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = '$incoming_id'
                OR outgoing_msg_id = '$incoming_id' AND incoming_msg_id = '$outgoing_id' ORDER BY message_Id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                               
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>