<?php 
    
    include "connection.php";
    session_start();
 
    $logId = $_SESSION["userId"];

    $query3 = "SELECT * FROM rider";
    $result3 = mysqli_query($conn,$query3);
    $row3 = mysqli_fetch_assoc($result3);

    $riderstatus = "UPDATE rider SET rider_status = 'Offline' WHERE rider_Id = '$logId'";
    $resultstatus = mysqli_query($conn,$riderstatus);

    session_destroy();

    header("location:login.php")

?>