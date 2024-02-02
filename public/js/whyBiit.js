import { loadText } from "./helpers/dictionary.js";
import { setupModalButtons, setupCloseModalButtons, setupOutsideModalClick, } from "./helpers/modal.js";
const main = () => {
    loadText();
    setupModalButtons();
    setupCloseModalButtons();
    setupOutsideModalClick();
};
document.addEventListener("DOMContentLoaded", main);
