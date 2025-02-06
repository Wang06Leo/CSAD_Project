function searchErrUrlParams() {
    const urlParams = new URLSearchParams(window.location.search);
    const alert_param = urlParams.get("alert");
    if (alert_param == "login") {
        showAlert();
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

function showAlert() {
    document.getElementById("alert").style.display = "flex";
    document.getElementsByClassName("overlay")[0].style.display = "block";
    setTimeout(hideAlert, 3000);
}
function hideAlert() {
    document.getElementById("alert").style.display = "none";
    document.getElementsByClassName("overlay")[0].style.display = "none";
    window.location.href = "login.php";
}
document.addEventListener("DOMContentLoaded", searchErrUrlParams);
// if (userRefreshed()) {
//     removeUrlParam();
// }