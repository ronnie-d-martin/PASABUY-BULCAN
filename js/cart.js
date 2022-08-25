window.onload = initall;


function initall() {


    var carts = document.getElementsByClassName("carts");
    var product_image = document.getElementsByClassName("product-image");
    var product_name = document.getElementsByClassName("product-name");
    var plus = document.getElementsByClassName("plus");
    var minus = document.getElementsByClassName("minus");
    var deleteBtn = document.getElementsByClassName("deleteBtn");
    var checkoutBtn = document.getElementsByClassName("checkout")[0];
    var total = document.getElementsByClassName("total")[0].textContent;
    var shipping = document.getElementsByClassName("shipping")[0].textContent;

    var newtotal = parseInt(total) + parseInt(shipping);

    document.getElementsByClassName("total")[0].textContent = newtotal;


    if (carts.length == 0) {

        checkoutBtn.disabled = true;

    } else {
        checkoutBtn.disabled = false;
    }

    for (var i = 0; i < carts.length; i++) {
        product_image[i].onclick = showProduct;
        product_name[i].onclick = showProduct;
        plus[i].onclick = addQuantity;
        minus[i].onclick = minusQuantity;
        deleteBtn[i].onclick = deleteProduct;
    }

    function showProduct(e) {
        e.target.parentNode.parentNode.childNodes[11].submit();
    }

    function addQuantity(e) {
        var quantity = e.target.parentNode.parentNode[1].value;

        var intQuantity = parseInt(quantity);

        intQuantity++;

        e.target.parentNode.parentNode[1].value = intQuantity.toString();
        e.target.parentNode.parentNode.submit();


    }

    function minusQuantity(e) {
        var quantity = e.target.parentNode.parentNode[1].value;

        var intQuantity = parseInt(quantity);
        if (intQuantity > 1) {
            intQuantity--;
        }

        e.target.parentNode.parentNode[1].value = intQuantity.toString();
        e.target.parentNode.parentNode.submit();

    }

    function deleteProduct(e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove this product?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Your product has been deleted.'
                )
                setInterval(setAlert, 2000);
            }

        })

        function setAlert() {
            e.target.parentNode.parentNode.submit();
        }

    }
    var placeorder = document.getElementsByClassName("checkout")[0];

    placeorder.onclick = checkOut;

    function checkOut(e) {
        if (carts.length != 0) {

            if (shipping == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You must set your destination first where you want to deliver!',
                })
            }

            if (shipping != 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Succesfully place at your Orders',
                    showConfirmButton: false,
                    timer: 2000,

                })
                setInterval(setAlert, 2000);

                function setAlert() {
                    e.target.parentNode.submit();
                }
            }




        }

    }


    var my_handlers = {


        fill_barangays: function() {

            var city_code = $(this).val();
            $('#barangay').ph_locations('fetch_list', [{ "city_code": city_code }]);
        }
    };

    $(function() {

        $('#city').on('change', my_handlers.fill_barangays);

        $('#city').ph_locations({ 'location_type': 'cities' });
        $('#barangay').ph_locations({ 'location_type': 'barangays' });
        $('#city').ph_locations('fetch_list', [{ "province_code": '0314' }]);


    });


}