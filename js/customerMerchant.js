window.onload = initall();


function initall() {
    var merchants = document.getElementsByClassName("merchant-item");

    var merchant_image = document.getElementsByClassName("merchant_image");
    var merchant_name = document.getElementsByClassName("merchant_name");
    var addtocart = document.getElementsByClassName("addtocart");

    for (var i = 0; i < merchants.length; i++) {
        merchant_image[i].onclick = showDetails;
        merchant_name[i].onclick = showDetails;
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