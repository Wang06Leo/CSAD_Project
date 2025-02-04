function validateSignUpForm() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let cfmPassword = document.getElementById("confirm-password").value;
    let email =  document.getElementById("email").value;
    let errMsg = "";
    let missingFields = [];
    if (username.trim() === "") missingFields.push("username");
    if (email.trim() === "") missingFields.push("email");
    if (password.trim() === "") missingFields.push("password");
    if (cfmPassword.trim() === "" && password.trim() !== "") missingFields.push("confirm password");
    if (cfmPassword.trim() && password.trim() && cfmPassword !== password) missingFields.push("passwords don't match");
    if (missingFields.length !== 0 && missingFields[0] === "passwords don't match") { // so that "Enter your passwords don't match" changes to below
        errMsg = "Passwords don't match";
        document.getElementById("error").innerText = errMsg;
    } else if (missingFields.length > 0) {
        errMsg = `Enter your ${missingFields.join(" and ")}`;
        document.getElementById("error").innerText = errMsg;
    } else {
        return true;
    }
    clearPhpErr();
    document.getElementById("error").innerText = errMsg; // if in one of the if/else-if
    return changeErrH();
}
function validateLoginForm() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let errMsg = "";
    let missingFields = [];
    if (username.trim() === "") missingFields.push("username");
    if (password.trim() === "") missingFields.push("password");
    if (missingFields.length > 0) {
        errMsg = `Enter your ${missingFields.join(" and ")}`;
        document.getElementById("error").innerText = errMsg;
    } else {
        return true;
    }
    clearPhpErr();
    document.getElementById("error").innerText = errMsg; // if in one of the if/else-if
    return changeErrH();
}
function changeErrH() {
    document.getElementById("error").style.height = "50px";
    return false;
}
function clearPhpErr() {
    if (document.getElementsByClassName('error').length > 0) document.getElementsByClassName('error')[0].outerHTML = '';
}