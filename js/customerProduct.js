window.onload = initall();


function initall() {
    var products = document.getElementsByClassName("product-item");

    var product_image = document.getElementsByClassName("product_image");
    var product_name = document.getElementsByClassName("product_name");
    var addtocart = document.getElementsByClassName("addtocart");


    for (var i = 0; i < products.length; i++) {
        product_image[i].onclick = showDetails;
        product_name[i].onclick = showDetails;
        addtocart[i].onclick = addToCart;

    }

    function addToCart(e) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Sucessfully added to the cart!',
            showConfirmButton: false,
            timer: 2000,

        })
        setInterval(setAlert, 2000);

        function setAlert() {
            e.target.parentNode.childNodes[9].submit();
        }

    }



    function showDetails(e) {
        e.target.parentNode.childNodes[5].submit();
    }
}