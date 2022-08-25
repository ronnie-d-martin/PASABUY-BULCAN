window.onload = initall;

function initall() {
    var updateBtn = document.getElementById("updateBtn");

    updateBtn.onclick = updatedAccount;


    function updatedAccount() {
        var formAccount = document.getElementsByClassName("formAccount")[0];
        formAccount.submit();

    }
}