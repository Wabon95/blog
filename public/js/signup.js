var inputEmail = document.getElementById("inputEmail");
var inputPassword = document.getElementById("inputPassword");

inputPassword.onfocusout = function() {
    if (inputPassword.value.length < 8) {
        inputPassword.style.border = '1px solid red';
    }
    if (inputPassword.value.length > 7) {
        inputPassword.style.border = '1px solid #ced4da';
    }
}