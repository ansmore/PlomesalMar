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
let countersetLanguage = 0;
let countersetupLanguageDropdown = 0;
let counterchargeText = 0;
const setLanguage = (selectedLanguage) => __awaiter(void 0, void 0, void 0, function* () {
    countersetLanguage += 1;
    try {
        let navigatorLanguage = yield getNavigatorLanguage();
        // const supportedLanguages = await loadAbailablesLanguages();
        // If return true, this language is not in white list!
        if (!isLanguageSupported(navigatorLanguage)) {
            console.log(`Your navigator languages unsuported! ${navigatorLanguage}. Sorry!`);
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
    countersetupLanguageDropdown += 1;
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
    counterchargeText += 1;
    const abailableLanguages = yield loadAbailablesLanguages();
    const abailablePages = yield loadAbailablesFiles();
    setupLanguageDropdown();
    const selectedLanguage = yield getSelectedLanguage();
    const navigatorLanguage = yield getNavigatorLanguage();
    const fileName = yield getCurrentFileName();
    const finalSelectedLanguage = abailableLanguages.includes(selectedLanguage) ||
        abailableLanguages.includes(navigatorLanguage)
        ? selectedLanguage || navigatorLanguage
        : "en";
    const selectedPage = abailablePages.includes(fileName) ? fileName : "home";
    console.log("navigator", navigatorLanguage);
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
