<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasabuy Bulacan</title>
    <link rel="icon" href="images/logo_pasabuy.png"" type="image/icon type">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/sidebar.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
     <!-- partial:index.partial.html -->
     <div id="wrapper" class="toggled">

<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
     <h2><img src="images/logo_pasabuy.png" id="sidebar-toggle1" width="20.5%"> PasabuyBulacan</h2>
    </div>

    <ul class="sidebar-nav">
        <li>
            <a href="index.php"><i class="fa fa-home"></i>Home</a>
        </li> <li>
            <a href="merchantsCustomer.php"><i class="fa fa-shopping-bag"></i>Merchants</a>
        </li> <li>
            <a href="customerProduct.php"><i class="fa fa-cutlery"></i>Products</a>
        </li>
           <li>
            <a href="preferRider.php"><i class="fa fa-motorcycle"></i>Choose Rider</a>
        </li>
        <li>
            <a href="cart.php?shippingfee=0"><i class="fa fa-shopping-cart"></i>Cart</a>
        </li>
        <li>
            <a href="accountCustomer.php?my_orders"><i class="fa fa-user"></i>Account</a>
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
                <a href="#" class="navbar-brand" id="sidebar-toggle"></a>

            </div>
        </div>
    </nav>
</div>


</div>
<!-- partial -->
<script>
    const $button  = document.querySelector('#sidebar-toggle');
    const $button1  = document.querySelector('#sidebar-toggle1');
    const $wrapper = document.querySelector('#wrapper');

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