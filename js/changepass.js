window.onload = initall;

function initall() {
    var changepass = document.getElementById("passBtn");

    changepass.onclick = updatedAccount;


    function updatedAccount() {
        var formPassword = document.getElementsByClassName("formPassword")[0];
        formPassword.submit();

    }
}