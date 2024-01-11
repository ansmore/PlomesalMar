var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { loadDictionary, loadAbailablesLanguages, loadAbailablesFiles, isLanguageSupported, getNavigatorLanguage, getCurrentFileName, getSelectedLanguage, } from "./helpers/dictionary.js";
const setLanguage = (selectedLanguage, supportedLanguages) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        let navigatorLanguage = yield getNavigatorLanguage();
        console.log("before", navigatorLanguage);
        if (!isLanguageSupported(navigatorLanguage, supportedLanguages)) {
            console.log(`Home->Unsupported navigator language: ${navigatorLanguage}. Sorry!`);
            navigatorLanguage = "";
        }
        console.log("after", navigatorLanguage);
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
const setupLanguageDropdown = (availableLanguages) => {
    const setLanguages = document.getElementById("setLanguages");
    if (setLanguages) {
        setLanguages.addEventListener("click", (event) => __awaiter(void 0, void 0, void 0, function* () {
            event.preventDefault();
            const selectedLanguageElement = event.target;
            const selectedLanguage = selectedLanguageElement.id;
            if (availableLanguages.includes(selectedLanguage)) {
                yield setLanguage(selectedLanguage, availableLanguages);
            }
        }));
    }
};
const chargeText = () => __awaiter(void 0, void 0, void 0, function* () {
    const abailableLanguages = yield loadAbailablesLanguages();
    const abailablePages = yield loadAbailablesFiles();
    const selectedLanguage = yield getSelectedLanguage();
    const navigatorLanguage = yield getNavigatorLanguage();
    const fileName = yield getCurrentFileName();
    const finalSelectedLanguage = abailableLanguages.includes(selectedLanguage) ||
        abailableLanguages.includes(navigatorLanguage)
        ? selectedLanguage || navigatorLanguage
        : "en";
    const selectedPage = abailablePages.includes(fileName) ? fileName : "home";
    console.log("list", abailableLanguages);
    console.log("navigator", navigatorLanguage);
    try {
        const dictionary = yield loadDictionary(finalSelectedLanguage, selectedPage);
        const textsToChange = document.querySelectorAll("[value-text]");
        textsToChange.forEach((element) => {
            const dataValue = element.getAttribute("value-text");
            if (dataValue && dictionary[dataValue]) {
                element.textContent = dictionary[dataValue];
            }
            // if (dataValue && dictionary[dataValue]) {
            //   const { textContent } = element;
            //   element.textContent = dictionary[dataValue];
            // }
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
    chargeText();
}));
