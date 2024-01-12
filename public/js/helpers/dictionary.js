var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
// Pending import from globals
const defaultLanguage = "es";
const navbar = "navigation";
const footer = "footer";
export const loadDictionary = (language, page) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const response = yield fetch(`./dictionary/${language}/${language}_${page}.json`);
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
// const abailableLanguages = ["en", "es", "ca"];
export const loadAbailablesLanguages = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const response = yield fetch(`./dictionary/listLanguages.json`);
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
export const loadAbailablesFiles = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const response = yield fetch(`./dictionary/listPages.json`);
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
        else {
            console.error("fileName es undefined después de split('#').");
        }
    }
    else {
        console.error("La URL no tiene segmentos.");
    }
    return undefined;
};
export const isLanguageSupported = (language) => __awaiter(void 0, void 0, void 0, function* () {
    const supportedLanguages = yield loadAbailablesLanguages();
    console.log(supportedLanguages);
    console.log(language);
    console.log("dictionary->", supportedLanguages.includes(language));
    // const suported = supportedLanguages.includes(language);
    // Si el idioma no está en la lista, devolverá false
    return !supportedLanguages.includes(language);
});
export const getNavigatorLanguage = () => {
    return navigator.language.slice(0, 2) || "";
};
export const getCurrentFileName = () => {
    const currentUrl = window.location.href;
    const fileName = getFileNameFromUrl(currentUrl);
    return fileName;
};
export const getSelectedLanguage = () => {
    let selectedLanguage = localStorage.getItem("selectedLanguage") || "";
    return selectedLanguage;
};
export const getFinalLanguage = () => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const abailableLanguages = yield loadAbailablesLanguages();
        const selectedLanguage = yield getSelectedLanguage();
        const navigatorLanguage = yield getNavigatorLanguage();
        const finalSelectedLanguage = abailableLanguages.includes(selectedLanguage) ||
            abailableLanguages.includes(navigatorLanguage)
            ? selectedLanguage || navigatorLanguage
            : defaultLanguage;
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
export const setupLanguageDropdown = () => __awaiter(void 0, void 0, void 0, function* () {
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
export const chargeText = () => __awaiter(void 0, void 0, void 0, function* () {
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
        //Recursive calling to component
        chargeTextComponent(navbar);
        chargeTextComponent(footer);
    }
    catch (error) {
        console.error("Error loading the text", error);
    }
});
export const chargeTextComponent = (component) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        setupLanguageDropdown();
        const finalSelectedLanguage = yield getFinalLanguage();
        // Hardcode for components
        // let component = "navigation";
        let selectedPage = component;
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
