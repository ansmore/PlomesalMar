var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
// Here-> Pending import from globals
const defaultLanguage = "es";
import { navbar } from "../components/navigation.js";
import { footer } from "../components/footer.js";
// Export let counterComponent = 0;
// Export let counterPage = 0;
export const loadDictionary = (language, page) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const response = yield fetch(`./../dictionary/${language}/${language}_${page}.json`);
        if (!response.ok) {
            throw new Error(`Error loading the language ${language}.`);
        }
        return yield response.json();
    }
    catch (error) {
        console.error("Error loading json", error);
        throw error;
    }
});
// Const availableLanguages = ["en", "es", "ca"];
export const loadAvailablesLanguages = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const response = yield fetch("./../dictionary/listLanguages.json");
        if (!response.ok) {
            throw new Error("Error loading white language list");
        }
        return yield response.json();
    }
    catch (error) {
        console.error("Error loading white language list", error);
        throw error;
    }
});
export const loadAvailablesFiles = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const response = yield fetch("./../dictionary/listPages.json");
        if (!response.ok) {
            throw new Error("Error loading white page list");
        }
        return yield response.json();
    }
    catch (error) {
        console.error("Error loading white page list", error);
        throw error;
    }
});
export const getFileNameFromUrl = (url) => {
    const segments = url.split("/");
    const lastSegment = segments.pop();
    // Verifica si hay al menos un segmento en la URL
    if (lastSegment !== undefined) {
        const fileName = lastSegment.split("#")[0];
        // Verifica si fileName no es undefined
        if (fileName !== undefined) {
            return fileName;
        }
        console.error("fileName es undefined después de split('#').");
    }
    else {
        console.error("La URL no tiene segmentos.");
    }
    return undefined;
};
export const isLanguageSupported = (language) => __awaiter(void 0, void 0, void 0, function* () {
    const supportedLanguages = yield loadAvailablesLanguages();
    return !supportedLanguages.includes(language);
});
export const getNavigatorLanguage = () => __awaiter(void 0, void 0, void 0, function* () { return navigator.language.slice(0, 2) || ""; });
export const getCurrentFileName = () => __awaiter(void 0, void 0, void 0, function* () {
    const currentUrl = window.location.href;
    const fileName = getFileNameFromUrl(currentUrl);
    return fileName;
});
export const getSelectedLanguage = () => __awaiter(void 0, void 0, void 0, function* () {
    var _a;
    const selectedLanguage = (_a = localStorage.getItem("selectedLanguage")) !== null && _a !== void 0 ? _a : "";
    return selectedLanguage;
});
export const getFinalLanguage = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const availableLanguages = yield loadAvailablesLanguages();
        const selectedLanguage = yield getSelectedLanguage();
        const navigatorLanguage = yield getNavigatorLanguage();
        const finalSelectedLanguage = availableLanguages.includes(selectedLanguage) ||
            availableLanguages.includes(navigatorLanguage)
            ? selectedLanguage || navigatorLanguage
            : defaultLanguage;
        localStorage.setItem("selectedLanguage", finalSelectedLanguage);
        return finalSelectedLanguage;
    }
    catch (error) {
        console.error("Error loading the text", error);
        return defaultLanguage;
    }
});
export const setLanguage = (selectedLanguage) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        let navigatorLanguage = yield getNavigatorLanguage();
        // If return false, this language is not in white list!
        if (yield isLanguageSupported(navigatorLanguage)) {
            console.log(`Your navigator languages unsuported! ${navigatorLanguage}. Sorry!`);
            navigatorLanguage = "";
        }
        localStorage.setItem("selectedLanguage", selectedLanguage);
        yield loadText();
        yield loadTextComponent(navbar);
        yield loadTextComponent(footer);
    }
    catch (error) {
        console.error("Error handling language click", error);
    }
});
export const loadText = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        // CounterPage += 1;
        const availablePages = yield loadAvailablesFiles();
        const fileName = yield getCurrentFileName();
        const finalSelectedLanguage = yield getFinalLanguage();
        const selectedPage = availablePages.includes(fileName) ? fileName : "home";
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
        console.error("Error loading text", error);
    }
});
export const loadTextComponent = (component) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const finalSelectedLanguage = yield getFinalLanguage();
        // From components parameter
        const selectedPage = component;
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
