window.onload = initall;


function initall() {

    var delivery_container = document.getElementsByClassName("delivery-container")[0];
    var modal = document.getElementsByClassName("modal")[0];
    var proofBtn = document.getElementsByClassName("proofBtn")[0];
    var closeBtn = document.getElementsByClassName("closeBtn")[0];
    var deliverBtn = document.getElementsByClassName("deliverBtn")[0];
    var totalDelivery = document.getElementsByClassName("totalDelivery")[0];

    var proofImg = document.getElementsByClassName("proofImg")[0];



    if (totalDelivery.textContent == "0") {
        proofBtn.disabled = true;
    }
    proofBtn.onclick = getProof;
    closeBtn.onclick = closeProof;
    deliverBtn.onclick = deliver;

    function getProof() {
        delivery_container.style.display = "none";
        modal.style.display = "flex";
    }

    function closeProof() {
        delivery_container.style.display = "block";
        modal.style.display = "none";
    }

    function deliver(e) {
        if (proofImg.value != "") {
           Swal.fire({
            title: 'Are you sure?',
            text: "Confirm Transaction",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Successfully Delivered'
                )
                setInterval(setAlert, 2000);
            }
             function setAlert() {
            e.target.parentNode.submit();
        }
        })
        
       
        } else if (proofImg.value == "") {
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You must provide image proof!',
                })
        }


    }
}