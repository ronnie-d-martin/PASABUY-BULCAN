var modal = document.getElementsByClassName("modal");
var categoryContainer = document.getElementsByClassName("container");
var close = document.getElementsByClassName("close");
var editButtons = document.getElementsByClassName("editButton");
var deleteButtons = document.getElementsByClassName("deleteButton");
var categories = document.getElementsByClassName("category");


function closeModal() {

    modal[0].style.display = "none";
    categoryContainer[0].style.display = "block";
}

function addingCategory() {
    document.getElementById("categoryModal").style.display = "block";
    document.getElementById("categoryTable").style.display = "none";
    document.getElementById("close_category").style.display = "none";
    document.getElementsByClassName("searchForm")[0].style.display = "none";

}

function categoryClose() {
    document.getElementById("categoryModal").style.display = "none";
    document.getElementById("categoryTable").style.display = "";
    document.getElementById("close_category").style.display = "block";
    document.getElementsByClassName("searchForm")[0].style.display = "";

}

for (var i = 0; i < categories.length; i++) {

    editButtons[i].onclick = buttonSet;
    deleteButtons[i].onclick = buttonSetdelete;
}

function buttonSet(e) {
    var categoryId = e.target.parentNode.parentNode.childNodes[1].innerHTML;
    var categoryName = e.target.parentNode.parentNode.childNodes[3].innerHTML;
    var categoryImage = e.target.parentNode.parentNode.childNodes[5].childNodes[0].src;


    document.querySelector(".hiddenId").value = categoryId;
    document.querySelector(".hiddenName").value = categoryName;
    document.querySelector(".hiddenImage").src = categoryImage;
    document.querySelector(".oldImage").value = categoryImage;
    modal[0].style.display = "block";

}

function buttonSetdelete(e) {
    var categoryId = e.target.parentNode.parentNode.parentNode.childNodes[1].innerHTML;
    e.target.parentNode.childNodes[1].value = categoryId;

     Swal.fire({
        title: 'Are you sure?',
        text: "you want to delete this category?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Category has been deleted.',
                'success'
            )
            e.target.parentNode.submit();
        }
    })

}