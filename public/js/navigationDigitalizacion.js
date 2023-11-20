var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { loadDictionary, loadAbailablesLanguages, } from "./helpers/dictionary.js";
const chargeText = () => __awaiter(void 0, void 0, void 0, function* () {
    const abailableLanguages = yield loadAbailablesLanguages();
    // const abailablePages = await loadAbailablesFiles();
    const navigatorLanguage = navigator.language.slice(0, 2);
    // const fileName = window.location.href.split("/").slice(-1)[0];
    // temporal HardCode
    const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
        ? navigatorLanguage
        : "es";
    // const selectedPage = abailablePages.includes(fileName)
    //   ? fileName
    //   : "home";
    let selectedPage = "navigationDigitalizacion";
    try {
        const dictionary = yield loadDictionary(selectedLanguage, selectedPage);
        document.getElementById("nav-service").textContent = dictionary.navService;
        document.getElementById("nav-agente").textContent = dictionary.navAgente;
        document.getElementById("nav-requisitos").textContent =
            dictionary.navRequisitos;
        document.getElementById("nav-bono").textContent = dictionary.navBono;
        document.getElementById("nav-faq").textContent = dictionary.navFaq;
    }
    catch (error) {
        console.error("Error loading the text", error);
    }
});
chargeText();
