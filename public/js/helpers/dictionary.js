var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
export const loadDictionary = (language, page) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        // // Develope mode
        // console.log("page:", page, "language:", language);
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
export const isLanguageSupported = (language, supportedLanguages) => {
    // Si el idioma no está en la lista, devolverá false
    console.log(`Dictionary->Unsupported navigator language: ${language}. Sorry!`);
    return supportedLanguages.includes(language);
};
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
    console.log("1.Language ", selectedLanguage);
    if (selectedLanguage === "") {
        console.log("2.no language ", selectedLanguage);
        selectedLanguage = "es";
    }
    console.log("3.Language is ", selectedLanguage);
    return selectedLanguage;
};
// export const getCurrentPage = () => {
//   const currentUrl = window.location.href;
//   const fileName = getFileNameFromUrl(currentUrl) as string;
//   return fileName || "home";
// };
export const changeLanguage = (language) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        const response = yield fetch("./dictionary/selectedLanguage.json", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ language }),
        });
        if (!response.ok) {
            throw new Error("Error changing language");
        }
    }
    catch (error) {
        console.error("Error changing language", error);
        throw error;
    }
});
