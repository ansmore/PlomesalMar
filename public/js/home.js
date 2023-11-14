var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { loadDictionary, loadAbailablesLanguages, loadAbailablesFiles, } from "./helpers/dictionary.js";
const chargeText = () => __awaiter(void 0, void 0, void 0, function* () {
    const abailableLanguages = yield loadAbailablesLanguages();
    const abailablePages = yield loadAbailablesFiles();
    const navigatorLanguage = navigator.language.slice(0, 2);
    const fileName = window.location.href.split("/").slice(-1)[0];
    // temporal HardCode
    // let fileName = "home";
    const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
        ? navigatorLanguage
        : "es";
    const selectedPage = abailablePages.includes(fileName) ? fileName : "home";
    try {
        const dictionary = yield loadDictionary(selectedLanguage, selectedPage);
        document.querySelector("#home-services").textContent =
            dictionary.homeServices;
        document.querySelector("#home-services-subheading").textContent =
            dictionary.homeServicesSubheading;
        document.querySelector("#services-1").textContent = dictionary.services1;
        document.querySelector("#services-2").textContent = dictionary.services2;
        document.querySelector("#services-3").textContent = dictionary.services3;
        document.querySelector("#services-4").textContent = dictionary.services4;
        document.querySelector("#services-5").textContent = dictionary.services5;
    }
    catch (error) {
        console.error("Error loading the text", error);
    }
});
chargeText();
