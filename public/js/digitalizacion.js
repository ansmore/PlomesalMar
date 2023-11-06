var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { loadDictionary, loadAbailablesLanguages } from "./helpers/dictionary.js";
export const chargeText = () => __awaiter(void 0, void 0, void 0, function* () {
    const abailableLanguages = yield loadAbailablesLanguages();
    const navigatorLanguage = navigator.language.slice(0, 2);
    const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
        ? navigatorLanguage
        : "es";
    try {
        const dictionary = yield loadDictionary(selectedLanguage);
        document.querySelector("#titleNuevo").textContent = dictionary.titleNuevo;
        document.querySelector("#descriptionDigitalizacion").textContent = dictionary.descriptionDigitalizacion;
    }
    catch (error) {
        console.error("Error loading the text", error);
    }
});
chargeText();
