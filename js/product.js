var modal = document.getElementsByClassName("modal");
var productContainer = document.getElementsByClassName("container");
var close = document.getElementsByClassName("close");
var editButtons = document.getElementsByClassName("editButton");
var deleteButtons = document.getElementsByClassName("deleteButton");
var products = document.getElementsByClassName("products");

function closeModal() {

    modal[0].style.display = "none";
    productContainer[0].style.display = "block";
}

function AddingProduct() {
    document.getElementById("productModal").style.display = "block";
    document.getElementById("close_product").style.display = "none";
    document.getElementById("productTable").style.display = "none";
    document.getElementsByClassName("searchForm")[0].style.display = "none";
}

function closeProduct() {
    document.getElementById("productModal").style.display = "none";
    document.getElementById("close_product").style.display = "block";
    document.getElementById("productTable").style.display = "";
    document.getElementsByClassName("searchForm")[0].style.display = "";
}

for (var i = 0; i < products.length; i++) {

    editButtons[i].onclick = buttonSet;
    deleteButtons[i].onclick = buttonSetdelete;
}

function buttonSet(e) {
    var productId = e.target.parentNode.parentNode.childNodes[1].innerHTML;
    var productName = e.target.parentNode.parentNode.childNodes[3].innerHTML;
    var productDescription = e.target.parentNode.parentNode.childNodes[5].innerHTML;
    var productPrice = e.target.parentNode.parentNode.childNodes[7].innerHTML;
    var categoryId = e.target.parentNode.parentNode.childNodes[9].innerHTML;
    var merchantId = e.target.parentNode.parentNode.childNodes[11].innerHTML;
    var productImage = e.target.parentNode.parentNode.childNodes[13].childNodes[0].src;

    modal[0].childNodes[1].getElementsByClassName("selector2")[0].getElementsByTagName("option")[0].value = merchantId;
    modal[0].childNodes[1].getElementsByClassName("selector1")[0].getElementsByTagName("option")[0].value = categoryId;
    document.querySelector(".hiddenId").value = productId;
    document.querySelector(".hiddenName").value = productName;
    document.querySelector(".hiddenDescription").value = productDescription;
    document.querySelector(".hiddenPrice").value = productPrice;
    document.querySelector(".hiddenImage").src = productImage;
    document.querySelector(".oldImage").value = productImage;
    modal[0].style.display = "block";


}

function buttonSetdelete(e) {
    var productId = e.target.parentNode.parentNode.parentNode.childNodes[1].innerHTML;
    e.target.parentNode.childNodes[1].value = productId;


     Swal.fire({
        title: 'Are you sure?',
        text: "you want to delete this product?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Product has been deleted.',
                'success'
            )
            e.target.parentNode.submit();
        }
    })

}