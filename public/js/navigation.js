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
    let selectedPage = "navigation";
    try {
        const dictionary = yield loadDictionary(selectedLanguage, selectedPage);
        document.getElementById("nav-home").textContent = dictionary.navHome;
        document.getElementById("nav-digitalizacion").textContent =
            dictionary.navDigitalizacion;
        document.getElementById("nav-service").textContent = dictionary.navService;
        document.getElementById("nav-porfolio").textContent =
            dictionary.navPorfolio;
        document.getElementById("nav-team").textContent = dictionary.navTeam;
        document.getElementById("nav-location").textContent =
            dictionary.navLocation;
        document.getElementById("nav-contact").textContent = dictionary.navContact;
    }
    catch (error) {
        console.error("Error loading the text", error);
    }
});
chargeText();
