window.onload = initall;


function initall() {

    var formRider = document.getElementById("formPrefer");
    var chooseBtn = document.getElementsByClassName("chooseBtn");
    var riderDetailes = document.getElementsByClassName("riderDetailes");

    for (var i = 0; i < riderDetailes.length; i++) {
        chooseBtn[i].onclick = preferRider;

    }

    function preferRider(e) {
        customer_Id = e.target.parentNode.childNodes[7].value
        rider_Id = e.target.parentNode.childNodes[9].value;
        document.querySelector(".hiddenCustomer").value = customer_Id;
        document.querySelector(".hiddenRider").value = rider_Id;

        Swal.fire({
            title: 'Are you sure?',
            text: "This rider will be your prefer Rider?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your prefer Rider is succesfully set',
                    showConfirmButton: false,
                    timer: 2000,

                })
                setInterval(setAlert, 2000);
            }
        })

        function setAlert() {
            formRider.submit();
        }


    }

}