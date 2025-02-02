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
    } else if (err == "t") {
        document.getElementById("error").innerText = "Username is taken";
        changeErrH();
    }
    else if (alert_param == "login") {
        alert("Sign up successful! Log in here");
    }
}
function userRefreshed() {
    return ((window.performance.navigation && window.performance.navigation.type === 1) ||
            window.performance
            .getEntriesByType('navigation')
            .map((nav) => nav.type)
            .includes('reload'));
}
function removeUrlParam() {
    let currentUrl = window.location.href;
    // Check if the URL has parameters
    if (currentUrl.indexOf('?') > -1) {
        let baseUrl = currentUrl.split('?')[0];
        window.history.replaceState(null, null, baseUrl);
    }
}

document.addEventListener("DOMContentLoaded", searchErrUrlParams);
// if (userRefreshed()) {
//     removeUrlParam();
// }