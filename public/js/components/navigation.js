var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { getFinalLanguage, loadTextComponent, setLanguage, getCurrentFileName, } from "../helpers/dictionary.js";
export const navbar = "navigation";
let selectedOption = null;
const main = () => __awaiter(void 0, void 0, void 0, function* () {
    loadTextComponent(navbar);
    const finalSelectedLanguage = yield getFinalLanguage();
    changeLanguage(finalSelectedLanguage);
});
const handleClick = (event) => {
    event.preventDefault();
    selectedOption = event.target.id;
    setLanguage(selectedOption);
    changeLanguage(selectedOption);
    const toggleCheckbox = document.getElementById("toggle-menu-checkbox");
    toggleCheckbox.checked = false;
};
document.addEventListener("DOMContentLoaded", () => {
    const dropDownLinks = document.querySelectorAll("#setLanguages a");
    dropDownLinks.forEach((link) => {
        link.addEventListener("click", handleClick);
    });
    const menuLinks = document.querySelectorAll(".navbar__menu .list__item__link");
    menuLinks.forEach((link) => {
        link.addEventListener("click", () => {
            const toggleCheckbox = document.getElementById("toggle-menu-checkbox");
            toggleCheckbox.checked = false;
        });
    });
    const submenuLinks = document.querySelectorAll(".dropdown__menu__item");
    submenuLinks.forEach((link) => {
        link.addEventListener("click", () => {
            const toggleCheckbox = document.getElementById("toggle-menu-checkbox");
            toggleCheckbox.checked = false;
        });
    });
});
const changeLanguage = (language) => __awaiter(void 0, void 0, void 0, function* () {
    var _a;
    try {
        const fileName = yield getCurrentFileName();
        const csrfToken = (_a = document
            .querySelector("meta[name=csrf-token]")) === null || _a === void 0 ? void 0 : _a.getAttribute("content");
        const response = yield fetch(`/sendLanguage`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken || "",
            },
            body: JSON.stringify({ language, fileName }),
        });
        if (!response.ok) {
            console.error("response.ok->", language);
            throw new Error(`-> Error en la solicitud: ${response.status}`);
        }
        if (response.ok) {
            const responseData = yield response.json();
            const newUrl = responseData.newUrl;
            history.pushState({}, "", newUrl);
        }
    }
    catch (error) {
        console.error("Error al cambiar el idioma:", error);
    }
});
document.addEventListener("DOMContentLoaded", main);
