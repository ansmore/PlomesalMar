var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { loadDictionary, loadAbailablesLanguages, loadAbailablesFiles, isLanguageSupported, getNavigatorLanguage, getCurrentFileName, getFinalLanguage, } from "./helpers/dictionary.js";
const setLanguage = (selectedLanguage) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        let navigatorLanguage = yield getNavigatorLanguage();
        // const supportedLanguages = await loadAbailablesLanguages();
        // If return false, this language is not in white list!
        if (yield isLanguageSupported(navigatorLanguage)) {
            console.log(`Home->Your navigator languages unsuported! ${navigatorLanguage}. Sorry!`);
            navigatorLanguage = "";
        }
        // Check if selected language an browser language is the same! -> To delete!
        if (navigatorLanguage === selectedLanguage) {
            console.log("Selected language is the same of browser:", selectedLanguage);
        }
        localStorage.setItem("selectedLanguage", selectedLanguage);
        console.log("Selected language:", selectedLanguage);
        yield chargeText();
    }
    catch (error) {
        console.error("Error handling language click", error);
    }
});
const setupLanguageDropdown = () => __awaiter(void 0, void 0, void 0, function* () {
    const setLanguages = document.getElementById("setLanguages");
    const availableLanguages = yield loadAbailablesLanguages();
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
});
const chargeText = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const abailablePages = yield loadAbailablesFiles();
        setupLanguageDropdown();
        const fileName = yield getCurrentFileName();
        const finalSelectedLanguage = yield getFinalLanguage();
        const selectedPage = abailablePages.includes(fileName) ? fileName : "home";
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
