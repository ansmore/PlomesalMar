var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { loadDictionary, loadAbailablesLanguages, loadAbailablesFiles, getFileNameFromUrl, } from "./helpers/dictionary.js";
const setLanguage = (selectedLanguage) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const navigatorLanguage = navigator.language.slice(0, 2);
        if (navigatorLanguage !== selectedLanguage) {
            console.log("Selected language:", selectedLanguage);
            localStorage.setItem("selectedLanguage", selectedLanguage);
            yield chargeText();
        }
    }
    catch (error) {
        console.error("Error handling language click", error);
    }
});
const setupLanguageDropdown = (availableLanguages) => {
    const setLanguages = document.getElementById("setLanguages");
    if (setLanguages) {
        setLanguages.addEventListener("click", (event) => __awaiter(void 0, void 0, void 0, function* () {
            event.preventDefault();
            const selectedLanguageElement = event.target;
            const selectedLanguage = selectedLanguageElement.id;
            if (availableLanguages.includes(selectedLanguage)) {
                yield setLanguage(selectedLanguage);
            }
        }));
    }
};
const chargeText = () => __awaiter(void 0, void 0, void 0, function* () {
    const abailableLanguages = yield loadAbailablesLanguages();
    const abailablePages = yield loadAbailablesFiles();
    // Recupera el idioma almacenado localmente
    const selectedLanguage = localStorage.getItem("selectedLanguage") || "";
    const navigatorLanguage = navigator.language.slice(0, 2);
    const currentUrl = window.location.href;
    const fileName = getFileNameFromUrl(currentUrl);
    const finalSelectedLanguage = abailableLanguages.includes(navigatorLanguage) ||
        abailableLanguages.includes(navigatorLanguage)
        ? selectedLanguage || navigatorLanguage
        : "es";
    const selectedPage = abailablePages.includes(fileName) ? fileName : "home";
    try {
        const dictionary = yield loadDictionary(finalSelectedLanguage, selectedPage);
        const textsToChange = document.querySelectorAll("[value-text]");
        textsToChange.forEach((element) => {
            const dataValue = element.getAttribute("value-text");
            if (dataValue && dictionary[dataValue]) {
                element.textContent = dictionary[dataValue];
            }
        });
    }
    catch (error) {
        console.error("Error loading the text", error);
    }
});
document.addEventListener("DOMContentLoaded", chargeText);
document.addEventListener("DOMContentLoaded", () => __awaiter(void 0, void 0, void 0, function* () {
    const availableLanguages = yield loadAbailablesLanguages();
    setupLanguageDropdown(availableLanguages);
}));
