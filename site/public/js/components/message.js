"use strict";
document.addEventListener("DOMContentLoaded", () => {
    const successMessageElement = document.getElementById("success-message");
    const errorMessageElement = document.getElementById("error-message");
    if (successMessageElement && successMessageElement.innerText.trim() !== "") {
        displayAlert(successMessageElement);
    }
    if (errorMessageElement && errorMessageElement.innerText.trim() !== "") {
        displayAlert(errorMessageElement);
    }
});
const displayAlert = (alertElement) => {
    alertElement.style.display = "flex";
    alertElement.style.opacity = "1";
    const timerBar = document.createElement("div");
    timerBar.className = "timer-bar";
    alertElement.appendChild(timerBar);
    setTimeout(() => {
        alertElement.style.opacity = "0";
        setTimeout(() => {
            alertElement.remove();
        }, 300);
    }, 15000);
};
