function validateSignUpForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var cfmPassword = document.getElementById("confirm-password").value;
    var email =  document.getElementById("email").value;
    var errMsg = "";
    var missingFields = [];
    if (username.trim() == "") missingFields.push("username");
    if (email.trim() == "") missingFields.push("email");
    if (password.trim() == "") missingFields.push("password");
    if (cfmPassword.trim() == "" && password !== "") missingFields.push("confirm password");
    if (cfmPassword && password && cfmPassword !== password) missingFields.push("passwords don't match");
    if (missingFields != 0 && missingFields[0] == "passwords don't match") { // so that "Enter your passwords don't match" changes to below
        errMsg = "Passwords don't match";
        document.getElementById("error").innerText = errMsg;
    } else if (missingFields.length > 0) {
        errMsg = `Enter your ${missingFields.join(" and ")}`;
        document.getElementById("error").innerText = errMsg;
    } else {
        return true;
    }
    document.getElementById("error").innerText = errMsg; // if in one of the if/else-if
    return changeErrH();
}
function validateLoginForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var errMsg = "";
    var missingFields = [];
    if (username.trim() === "") missingFields.push("username");
    if (password.trim() === "") missingFields.push("password");
    if (missingFields.length > 0) {
        errMsg = `Enter your ${missingFields.join(" and ")}`;
        document.getElementById("error").innerText = errMsg;
    } else {
        return true;
    }
    document.getElementById("error").innerText = errMsg; // if in one of the if/else-if
    return changeErrH();
}
function changeErrH() {
    document.getElementById("error").style.height = "50px";
    return false;
}