window.onload = initall;

function initall() {


    var orders = document.getElementsByClassName("orders");
    var acceptBtn = document.getElementsByClassName("acceptBtn");
    var pickRiderBtn = document.getElementsByClassName("pickRiderBtn");
    var modal = document.getElementsByClassName("modal")[0];
    var closeBtn = document.getElementsByClassName("closeBtn")[0];
    var modal_items = document.getElementsByClassName("modal-items");
    var modal_selectBtn = document.getElementsByClassName("modal_selectBtn");
    var declineBtn = document.getElementsByClassName("declineBtn");

    closeBtn.onclick = closeModal;




    for (var i = 0; i < pickRiderBtn.length; i++) {
        if (pickRiderBtn.length >= 1) {
            pickRiderBtn[i].onclick = pickRider;

        }
    }

    for (var i = 0; i < acceptBtn.length; i++) {
        if (acceptBtn.length >= 1) {
            acceptBtn[i].onclick = acceptOrders;
        }

    }
    for (var i = 0; i < declineBtn.length; i++) {
        if (declineBtn.length >= 1) {
            declineBtn[i].onclick = declineOrders;
        }
    }
    for (var i = 0; i < modal_items.length; i++) {
        modal_selectBtn[i].onclick = modalSelect;
    }


    function declineOrders(e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "you want to decline this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, decline it'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Declined Order'
                )
                setInterval(setAlert, 2000);
            }
        })

        function setAlert() {
            e.target.parentNode.submit();
        }

    }

    function acceptOrders(e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "you want to accept order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Order is successfully accepted'
                )
                setInterval(setAlert, 2000);
            }
        })

        function setAlert() {
            e.target.parentNode.submit();
        }


    }

    function pickRider(e) {
        var orderIdContainer = document.getElementsByClassName("modal_order_Id");

        var order_Id = e.target.parentNode.parentNode.parentNode.childNodes[1].textContent;
        for (var i = 0; i < modal_items.length; i++) {
            orderIdContainer[i].value = order_Id;
        }


        modal.style.display = "flex";
    }

    function closeModal() {
        modal.style.display = "none";
    }

    function modalSelect(e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "you want to select this rider?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'You successfully choose this Rider!'
                )

                setInterval(setAlert, 2000);
            }
        })

        function setAlert() {
            e.target.parentNode.submit();
        }
    }

}