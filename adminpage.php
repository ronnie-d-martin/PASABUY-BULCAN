<?php 
    include "connection.php";

    $selectRating = "SELECT * FROM rating";
    $resultRating = mysqli_query($conn,$selectRating);

    $selectCount = "SELECT COUNT(*) FROM rating";
    $resultCount = mysqli_query($conn, $selectCount);

    $rowCount = mysqli_fetch_assoc($resultCount);
    $status = "Pending Order";

    
    $selectCounttransaction = "SELECT COUNT(*) FROM customer_order WHERE order_status ='$status'";
    $resultCounttransaction = mysqli_query($conn, $selectCounttransaction);
    $rowCounttransaction = mysqli_fetch_assoc($resultCounttransaction);



    $totalProduct= 0;
    $totalRider  = 0;
    $totalOverall = 0;

    $productResult = 0.00;


    while($row = mysqli_fetch_assoc($resultRating)){
        $totalProduct += (int)$row["product_rating"];
        $totalRider += (int)$row["rider_rating"];
        $totalOverall += (int)$row["overall_rating"];

        $productResult = $totalProduct/(int)$rowCount['COUNT(*)'];
        $riderResult = $totalRider/(int)$rowCount['COUNT(*)'];
        $overallResult = $totalOverall/(int)$rowCount['COUNT(*)'];

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
        <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
    <link rel="stylesheet" href="css/adminPage.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>
   <?php include "sidebarAdmin.php"?>
<div class="containerDashboard">
<h2 class="totalTitle"><strong>Total Summary</strong></h2>
    <div class="boxContainer">
        <div class="firstBox">
            <strong>Product Rating</strong>
            <p id="productClass"><?php echo round($productResult,2);?></p>
        </div>
        <div class="forthBox">
            <strong>Rider Rating</strong>
            <p id="riderClass"><?php echo round($riderResult,2);?></p>
        </div>
        <div class="thirdBox">
            <strong>Overall Experience</strong>
            <p id="overallClass"><?php echo round($overallResult,2);?></p>
        </div>
        <a href="adminOrders.php" class="apat">
        <div class="secondBox">
      <strong>Available Orders</strong>
            <p><?php echo $rowCounttransaction['COUNT(*)']; ?></p>
        </div>
    </div></a>
       <div class="dashboardContainer">
        <div class="dashboardDetails">
        <div class="firstDashboard">
        <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
        </div>
        <div class="secondDashboard">
        <canvas id="myChart2" style="height:230px;width:100%;max-width:600px"></canvas>
        </div>
      </div>
        <div class="preferRider">
          <table class="table table-striped table-hover">
          <center><h4><b>Prefered Rider</b></h4></center>
              <tr class="choose_rider">
                  <th>Choose Rider Id</th>
                  <th>Customer Id</th>
                  <th>Rider Id</th>
                  <th>Customer Name</th>
                  <th>Prefer Rider of the Customer</th>
              </tr>
          <?php
              $queryChoose1 = "SELECT * FROM choose_rider";
              $resultChoose1 = mysqli_query($conn, $queryChoose1);
              while($row3 = mysqli_fetch_assoc($resultChoose1)){  
          ?>
              <tr>
                <td><?php echo $row3["choose_rider_Id"];?></td>
                <td><?php echo $row3["customer_Id"];?></td>
                <td><?php echo $row3["rider_Id"];?></td>
                <td><?php echo $row3["customer_name"];?></td>
                <td><?php echo $row3["rider_name"];?></td>
              </tr>
              <?php }?>
              </table>
            </div>
              <br><br><br><br>
          </div>
        </div>
      
    </div>

<script>

   var productClass = document.getElementById("productClass").textContent;
   var riderClass = document.getElementById("riderClass").textContent;
   var overallClass = document.getElementById("overallClass").textContent;



var xValues = ["Product Rating", "Rider Rating", "OverallExperience"];
var yValues = [productClass, riderClass, overallClass,5,1];
var barColors = ["red", "green","blue"];

new Chart("myChart1", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Customer feedback scores on a scale of one to five"
    }
  }
});

var xValues =  ["Product Rating", "Rider Rating", "OverallExperience"];
var yValues = [productClass, riderClass, overallClass];
var barColors = ["red", "green","blue"];

new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Average scores of the customer base on the pie graph"
    }
  }
});
</script>

    
</body>
</html>