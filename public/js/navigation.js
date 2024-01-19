var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { getFinalLanguage, getNavigatorLanguage, loadTextComponent, setLanguage, } from "./helpers/dictionary.js";
export const navbar = "navigation";
let selectedOption = null;
const main = () => __awaiter(void 0, void 0, void 0, function* () {
    loadTextComponent(navbar);
    const finalSelectedLanguage = yield getFinalLanguage();
    changeLanguage(finalSelectedLanguage);
    // selectedOption = localStorage.getItem("selectedLanguage") || "";
    // console.log("navigation storage->", selectedOption);
    const navigatorLanguage = yield getNavigatorLanguage();
    console.log("navigation navigator->", navigatorLanguage);
    // console.log("navigation final->", finalSelectedLanguage);
});
const handleClick = (event) => {
    event.preventDefault();
    selectedOption = event.target.id;
    setLanguage(selectedOption);
    console.log("aqui->", selectedOption);
    changeLanguage(selectedOption);
};
document.addEventListener("DOMContentLoaded", () => {
    const dropDownLinks = document.querySelectorAll("#setLanguages a");
    dropDownLinks.forEach((link) => {
        link.addEventListener("click", handleClick);
    });
});
const changeLanguage = (language) => __awaiter(void 0, void 0, void 0, function* () {
    var _a;
    try {
        console.log("chLang before send->", language);
        const csrfToken = (_a = document
            .querySelector("meta[name=csrf-token]")) === null || _a === void 0 ? void 0 : _a.getAttribute("content");
        console.log("CSRF Token:", csrfToken);
        console.log("JSON a enviar:", JSON.stringify({ language }));
        // fetch `/${language}/sendLanguage`
        const response = yield fetch(`/sendLanguage`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken || "",
            },
            body: JSON.stringify({ language }),
        });
        if (!response.ok) {
            console.log("response.ok->", language);
            throw new Error(`-> Error en la solicitud: ${response.status}`);
        }
        if (response.ok) {
            const responseData = yield response.json();
            const newUrl = responseData.newUrl;
            history.pushState({}, "", newUrl);
            console.log("change->", language);
            // Redirige a la nueva URL después de la solicitud POST exitosa
            // window.location.href = responseData.newUrl;
            // window.location.reload();
        }
        // window.location.reload();
        console.log("change->", language);
    }
    catch (error) {
        console.error("Error al cambiar el idioma:", error);
    }
});
document.addEventListener("DOMContentLoaded", main);
