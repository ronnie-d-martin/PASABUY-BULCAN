window.onload = initall;



function initall() {
    var categories = document.getElementsByClassName("category-item");





    for (var i = 0; i < categories.length; i++) {
        categories[i].onclick = categorySet;
    }

    function categorySet(e) {
        var categoryId = e.target.parentNode.childNodes[1].value;
        var categoryName = e.target.parentNode.childNodes[5].textContent;

        window.location.href = "https://pasabuybulacan.online/PasabuyBulacan/customerProduct.php?categoryId=" + categoryId + "&categoryName=" + categoryName;
    }
}