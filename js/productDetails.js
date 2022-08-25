window.onload = initall;

function initall() {
    var relateditems = document.getElementsByClassName("related-items");
    var related_image = document.getElementsByClassName("related_image");
    var related_name = document.getElementsByClassName("related_name");
    var cartbtn = document.getElementsByClassName("addtocart")[0];
    var buyNowBtn = document.getElementsByClassName("buyNow")[0];
    var buynowForm = document.getElementsByClassName("buynowForm")[0];
    var cartFunction = document.getElementsByClassName("cartFunction")[0];

    var quantity = document.getElementById("quantity");
    var quantityBuynow = document.getElementById("quantityBuynow");




    for (var i = 0; i < relateditems.length; i++) {
        related_image[i].onclick = showDetails;
        related_name[i].onclick = showDetails;

    }

    function showDetails(e) {
        e.target.parentNode.childNodes[5].submit();
    }

    function addToCart() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This product will be on your cart!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Successfully added to the cart!',
                )
                setInterval(setAlert, 2000);
            }

        })

        function setAlert() {
            cartFunction.submit();
        }


    }

    cartbtn.onclick = addToCart;
    buyNowBtn.onclick = buyNow;


    function buyNow() {
        quantityBuynow.value = quantity.value;
        Swal.fire({
            title: 'If you click(Yes) it will deliver direct to your current address?',
            text: "Your Delivery Fee will base on Kilometes(KM)!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Successfully place at your Order/s',

                )
                setInterval(setAlert, 2000);
            }

        })

        function setAlert() {
            buynowForm.submit();
        }


    }


}