function show_login() {
    document.getElementById("formLogin").style.display = "block";
    document.getElementById("formSignup").style.display = "none";
}

function show_signup() {
    document.getElementById("formSignup").style.display = "block";
    document.getElementById("formLogin").style.display = "none";
}

function close_btn() {
    document.getElementById("formLogin").style.display = "none";
    document.getElementById("formSignup").style.display = "none";
}


function closePolicy() {
    document.getElementById("pPolicy").style.display = "none";
    document.getElementById("formLogin").style.display = "none";
    document.getElementById("formSignup").style.display = "block";

}


function showPolicy() {
    document.getElementById("pPolicy").style.display = "block";
    document.getElementById("formSignup").style.display = "none";
}



function checkSignUp() {
    var signUperror = document.getElementsByClassName("errormessagePassword")[0];
    var signUpFirstName = document.getElementById("signUpFirstName").value;
    var signUpLastName = document.getElementById("signUpLastName").value;
    var signUpUsername = document.getElementById("signUpUsername").value;
    var signUpPassword = document.getElementById("signUpPassword").value;
    var signUpConfirmPassword = document.getElementById("signUpConfirmPassword").value;
    var signUpAddress = document.getElementById("signUpAddress").value;
    var signUpContactNo = document.getElementById("signUpContactNo").value;


    if (signUpFirstName === "" || signUpLastName === "" || signUpUsername === "" || signUpPassword === "" || signUpConfirmPassword === "" || signUpAddress === "" || signUpContactNo === "") {



        signUperror.innerHTML = "Please Complete all the fields";

        setTimeout(function() {
            signUperror.innerHTML = "";
        }, 5000);

    } else {

        if (signUpPassword.length >= 8) {

            if (signUpPassword != signUpConfirmPassword) {
                signUperror.innerHTML = "Password does not matched!";

                setTimeout(function() {
                    signUperror.innerHTML = "";
                }, 5000);
            } else {

                document.getElementById("formSignup").submit();

            }


        } else {
            signUperror.innerHTML = "Password length must be 8 or above!";

            setTimeout(function() {
                signUperror.innerHTML = "";
            }, 5000);
        }


    }
}