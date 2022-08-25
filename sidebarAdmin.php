<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PasabuyBulacan</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/sidebar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
     <!-- partial:index.partial.html -->
     <div id="wrapper" class="toggled">

<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
     <h2><img src="images/logo_pasabuy.png"  id="sidebar-toggle1" width="20.5%"> PasabuyBulacan</h2>
    </div>

    <ul class="sidebar-nav">
        <li>
            <a href="adminpage.php"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a>
        </li> <li>
            <a href="category.php"><i class="fa fa-list" aria-hidden="true"></i>Categories</a>
        </li><li>
            <a href="merchants.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Merchants</a>
        </li> <li>
            <a href="products.php"><i class="fa fa-cutlery" aria-hidden="true"></i>Products</a>
        </li> <li>
            <a href="rider.php"><i class="fa fa-motorcycle" aria-hidden="true"></i>Riders</a>
        </li> <li>
            <a href="adminOrders.php"><i class="fa fa-list-alt" aria-hidden="true"></i>Orders</a>
        </li>
        </li> <li>
            <a href="transaction.php"><i class="fa fa-history" aria-hidden="true"></i>Transactions</a>
        </li>
        <li>
            <a href="declineOrders.php"><i class="fa fa-ban" aria-hidden="true"></i>Decline Orders</a>
        </li>
        <li>
            <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>logout</a>
        </li>
    </ul>
</aside>

<div id="navbar-wrapper">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
            </div>
        </div>
    </nav>
</div>



</div>
<!-- partial -->
<script>
    const $button  = document.querySelector('#sidebar-toggle');
    const $wrapper = document.querySelector('#wrapper');
    const $button1  = document.querySelector('#sidebar-toggle1');

    $button.addEventListener('click', (e) => {
    e.preventDefault();
    $wrapper.classList.toggle('toggled');
});
$button1.addEventListener('click', (e) => {
    e.preventDefault();
    $wrapper.classList.toggle('toggled');
});
</script>
</body>
</html>