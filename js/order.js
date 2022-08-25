window.onload = initall;


function initall() {
    var orders = document.getElementsByClassName("orders");
    var cancelBtn = document.getElementsByClassName("cancelBtn");
    var chatBtn = document.getElementsByClassName("showchat");
    var closeBtn = document.getElementsByClassName("closeChat")[0];
    var feedBack = document.getElementsByClassName("feedBack");
    var starContent = document.getElementsByClassName("modalRating");
    var modalFeed = document.getElementById("modalFeed");
    var closeFeed = document.getElementsByClassName("close");
    var rating_product_Id = document.getElementsByClassName("rating_product_Id")[0];
    var feedBackSubmit = document.getElementsByClassName("feedBackSubmit")[0];



    closeFeed[0].onclick = closeFeedback;

    feedBackSubmit.onclick = feedBackSubmitFunc;

    if (closeBtn != null) {
        closeBtn.onclick = closeChat;
    }

    for (var i = 0; i < feedBack.length; i++) {
        if (feedBack.length >= 1) {
            feedBack[i].onclick = feedBackFunc;
        }

    }

    for (var i = 0; i < orders.length; i++) {
        if (chatBtn.length != 0) {
            chatBtn[i].onclick = chatRider;

        }

    }

    for (var i = 0; i < cancelBtn.length; i++) {

        cancelBtn[i].onclick = cancelOrder;


    }




    function cancelOrder(e) {
        var order_status = e.target.parentNode.parentNode.parentNode.childNodes[11].textContent;
        if (order_status != "Pending Order") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No cancelation of order!',
            })
        } else {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to cancel your order/s?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your order/s has been cancel!'
                    )
                    setInterval(setAlert, 2000);
                }

            })

            function setAlert() {
                e.target.parentNode.submit();
            }

        }
    }




    function closeChat() {
        window.location.href = "accountCustomer.php?my_orders";

    }

    function chatRider(e) {
        var order_Id = e.target.parentNode.childNodes[5].value;
        window.location.href = "accountCustomer.php?my_orders&order_Id=" + order_Id;

    }

    function feedBackFunc(e) {
        starContent[0].style.display = "block";
        var product_Id = e.target.parentNode.parentNode.parentNode.childNodes[13].childNodes[0].childNodes[5].value;
        rating_product_Id.value = product_Id;

    }


    window.onclick = function(event) {
        if (event.target == modalFeed) {
            modalFeed.style.display = "";
        }
    }

    function closeFeedback() {
        starContent[0].style.display = "none";
    }

    function feedBackSubmitFunc(e) {

        var rating_foodFunc = document.getElementsByClassName("rating_foodFunc")[0];
        var rating_riderFunc = document.getElementsByClassName("rating_riderFunc")[0];
        var rating_overallFunc = document.getElementsByClassName("rating_overallFunc")[0];

        if (rating_foodFunc.hasAttribute('value') == true && rating_riderFunc.hasAttribute('value') == true && rating_overallFunc.hasAttribute('value') == true) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your feedback is successfully submitted',
                showConfirmButton: false,
                timer: 2000,

            })
            setInterval(setAlert, 2000);

            function setAlert() {
                e.target.parentNode.submit();
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please complete all the fields!',
            })
        }

    }

}