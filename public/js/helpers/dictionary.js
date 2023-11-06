var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
export const loadDictionary = (language) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        // let languageCode = language;
        const response = yield fetch(`./dictionary/${language}/${language}.json`);
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
// const abailableLanguages = ["en", "es"];
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
// const chargeText = async () => {
//   const abailableLanguages = await loadAbailablesLanguages();
//   const navigatorLanguage = navigator.language.slice(0, 2);
//   const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
//     ? navigatorLanguage
//     : "es";
//   try {
//     const dictionary = await chargeDictionary(selectedLanguage);
//     document.getElementById("title")!.textContent = dictionary.title;
//     document.getElementById("description")!.textContent = dictionary.description;
//     document.getElementById("titleNuevo")!.textContent = dictionary.titleNuevo;
//     document.getElementById("descriptionDigitalizacion")!.textContent = dictionary.descriptionDigitalizacion;
//   } 
//   catch (error) {
//     console.error("Error loading the text", error);
//   }
// };
// chargeText();
