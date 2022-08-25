var riders = document.getElementsByClassName("riders");
var editButtons = document.getElementsByClassName("editButton");
var deleteButtons = document.getElementsByClassName("deleteButton");


var modal = document.getElementsByClassName("modal");
var riderContainer = document.getElementsByClassName("container");
var close = document.getElementsByClassName("close");


function closeModal() {

    modal[0].style.display = "none";
    riderContainer[0].style.display = "block";
}

function addingRider() {
    document.getElementById("riderModal").style.display = "block";
    document.getElementById("close_rider").style.display = "none";
    document.getElementById("riderTable").style.display = "none";
    document.getElementsByClassName("searchForm")[0].style.display = "none";

}

function closeRider() {
    document.getElementById("riderModal").style.display = "none";
    document.getElementById("close_rider").style.display = "block";
    document.getElementById("riderTable").style.display = "";
    document.getElementsByClassName("searchForm")[0].style.display = "";
}

for (var i = 0; i < riders.length; i++) {

    editButtons[i].onclick = buttonSet;
    deleteButtons[i].onclick = buttonSetdelete;
}

function buttonSet(e) {

    var riderId = e.target.parentNode.parentNode.childNodes[1].innerHTML;
    var riderFname = e.target.parentNode.parentNode.childNodes[3].innerHTML;
    var riderLname = e.target.parentNode.parentNode.childNodes[5].innerHTML;
    var riderUsername = e.target.parentNode.parentNode.childNodes[7].innerHTML;
    var riderAddress = e.target.parentNode.parentNode.childNodes[9].innerHTML;
    var riderContactNo = e.target.parentNode.parentNode.childNodes[11].innerHTML;
    var riderImage = e.target.parentNode.parentNode.childNodes[13].childNodes[0].src;

    document.querySelector(".hiddenId").value = riderId;
    document.querySelector(".hiddenFname").value = riderFname;
    document.querySelector(".hiddenLname").value = riderLname;
    document.querySelector(".hiddenUsername").value = riderUsername;
    document.querySelector(".hiddenAddress").value = riderAddress;
    document.querySelector(".hiddenContactNo").value = riderContactNo;
    document.querySelector(".hiddenImage").src = riderImage;
    document.querySelector(".oldImage").value = riderImage;


    modal[0].style.display = "block";

}

function buttonSetdelete(e) {
    var riderId = e.target.parentNode.parentNode.parentNode.childNodes[1].innerHTML;
    e.target.parentNode.childNodes[1].value = riderId;

   Swal.fire({
        title: 'Are you sure?',
        text: "you want to delete this rider?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Rider has been deleted.',
                'success'
            )
            e.target.parentNode.submit();
        }
    })

}