var btnShip = document.getElementsByClassName("btnShip")[0];
var locationForm = document.getElementById("locationForm");
var formLocation = document.getElementById("formLocation");

var carts = document.getElementsByClassName("carts");

if (carts.length == 0) {

    btnShip.disabled = true;

} else {
    btnShip.disabled = false;
}

function setlocation() {
    var city = document.getElementById("city").value;
    var barangay = document.getElementById("barangay").value;
    var street = document.getElementById("street").value;


    if (street == "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please complete all fields!',
        })

    } else if (city != "" && barangay != "" && street != "") {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Your address has successfully changed!',
            showConfirmButton: false,
            timer: 2000,

        })
        setInterval(setAlert, 2000);

        function setAlert() {
            formLocation.submit();
        }
    }


}


function setTextField(ddl) {
    document.getElementById('make_text').value = ddl.options[ddl.selectedIndex].text;

}

function setTextField1(ddl1) {
    document.getElementById('make_text1').value = ddl1.options[ddl1.selectedIndex].text;

}