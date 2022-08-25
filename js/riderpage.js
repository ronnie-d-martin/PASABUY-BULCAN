window.onload = initall;


function initall() {

    var pending_items = document.getElementsByClassName("pending-items");

    var acceptBtn = document.getElementsByClassName("acceptBtn");
    console.log(pending_items);

    for (var i = 0; i < pending_items.length; i++) {
        acceptBtn[i].onclick = acceptOrders;
    }

    function acceptOrders(e) {
        
        Swal.fire({
            title: 'Are you sure?',
            text: "you want to accept this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Order/s succesfully accepted'
                )
                setInterval(setAlert, 2000);
            }
        })
        
        function setAlert() {
            e.target.parentNode.submit();
        }
        
    }
}