var modal = document.getElementsByClassName("modal");
var merchantContainer = document.getElementsByClassName("container");
var close = document.getElementsByClassName("close");
var editButtons = document.getElementsByClassName("editButton");
var deleteButtons = document.getElementsByClassName("deleteButton");
var merchants = document.getElementsByClassName("merchants");

function closeModal() {

    modal[0].style.display = "none";
    merchantContainer[0].style.display = "block";
}

function addingMerchant() {
    document.getElementById("merchantModal").style.display = "block";
    document.getElementById("merchantTable").style.display = "none";
    document.getElementById("close_merchant").style.display = "none";
    document.getElementsByClassName("searchForm")[0].style.display = "none";

}

function closeMerchant() {
    document.getElementById("merchantModal").style.display = "none";
    document.getElementById("merchantTable").style.display = "";
    document.getElementById("close_merchant").style.display = "block";
    document.getElementsByClassName("searchForm")[0].style.display = "";
}


for (var i = 0; i < merchants.length; i++) {

    editButtons[i].onclick = buttonSet;
    deleteButtons[i].onclick = buttonSetdelete;
}

function buttonSet(e) {
    var merchantId = e.target.parentNode.parentNode.childNodes[1].innerHTML;
    var merchantName = e.target.parentNode.parentNode.childNodes[3].innerHTML;
    var merchantImage = e.target.parentNode.parentNode.childNodes[7].childNodes[0].src;
    var merchantDescription = e.target.parentNode.parentNode.childNodes[5].innerHTML;



    document.querySelector(".hiddenId").value = merchantId;
    document.querySelector(".hiddenName").value = merchantName;
    document.querySelector(".hiddenDescription").value = merchantDescription;
    document.querySelector(".hiddenImage").src = merchantImage;
    document.querySelector(".oldImage").value = merchantImage;



    modal[0].style.display = "block";

}

function buttonSetdelete(e) {
    var merchantId = e.target.parentNode.parentNode.parentNode.childNodes[1].innerHTML;
    e.target.parentNode.childNodes[1].value = merchantId;

     Swal.fire({
        title: 'Are you sure?',
        text: "you want to delete this merchant?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Merchant has been deleted.',
                'success'
            )
            e.target.parentNode.submit();
        }
    })

}