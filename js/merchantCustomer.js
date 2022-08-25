window.onload = initall;

function initall() {

    var merchantItem = document.getElementsByClassName("merchant-item");

    for (var i = 0; i < merchantItem.length; i++) {
        merchantItem[i].onclick = formFunction;
    }

    function formFunction(e) {
        e.target.parentNode.childNodes[1].submit();
    }

}