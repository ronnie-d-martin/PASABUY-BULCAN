var notifdetails = document.getElementsByClassName("notifdetails")[0];


function closeNotif() {
    notifdetails.style.display = "none"

}

function shownotif() {
    notifdetails.style.display = "block"
}

function loadDoc() {
    setInterval(function() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("notif_number").innerHTML = this.responseText;
        }
        xhttp.open("GET", "notificationFunc.php", true);
        xhttp.send();
    }, 1000)

}
loadDoc();


function loadDoc1() {
    setInterval(function() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("detailesNotif").innerHTML = this.responseText;
        }
        xhttp.open("GET", "notificationDetailes.php", true);
        xhttp.send();
    }, 1000)

}
loadDoc1();

var formDelete = document.getElementById("formDelete");
var deletenotifBtn = document.getElementById("deletenotifBtn");
var customer_value = document.getElementById("customer_value");


if (customer_value.value == 0) {
    deletenotifBtn.disabled = true;
} else if (customer_value.value != 0) {
    function deleteNotification() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete your notification history??",
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
            formDelete.submit();
        }

    }



}