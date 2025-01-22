function searchErrUrlParams() {
    const urlParams = new URLSearchParams(window.location.search);
    const err = urlParams.get("e");
    const alert_param = urlParams.get("alert");
    if (err == "u") {
        document.getElementById("error").innerText = "Invalid username";
        changeErrH();
    } else if (err == "p") {
        document.getElementById("error").innerText = "Invalid password";
        changeErrH();
    } else if (alert_param == "login") {
        alert("Sign up successful! Log in here");
    }
}

document.addEventListener("DOMContentLoaded", searchErrUrlParams);