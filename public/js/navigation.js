var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { loadTextComponent, setLanguage } from "./helpers/dictionary.js";
export const navbar = "navigation";
let selectedOption = "en";
const main = () => __awaiter(void 0, void 0, void 0, function* () {
    loadTextComponent(navbar);
    changeLanguage(selectedOption);
    console.log("main->", selectedOption);
});
const handleClick = (event) => {
    event.preventDefault();
    selectedOption = event.target.id;
    setLanguage(selectedOption);
    console.log("aqui->", selectedOption);
    changeLanguage(selectedOption);
};
document.addEventListener("DOMContentLoaded", () => {
    const dropDownLinks = document.querySelectorAll("#setLanguages a");
    dropDownLinks.forEach((link) => {
        link.addEventListener("click", handleClick);
    });
});
const changeLanguage = (language) => __awaiter(void 0, void 0, void 0, function* () {
    try {
        console.log("before->", language);
        // fetch `/{language}/set-language`
        const response = yield fetch(`/set-language`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ language }),
        });
        if (!response.ok) {
            console.log("response.ok->", language);
            throw new Error(`-> Error en la solicitud: ${response.status}`);
        }
        window.location.reload();
        console.log("change->", language);
    }
    catch (error) {
        console.error("Error al cambiar el idioma:", error);
    }
});
document.addEventListener("DOMContentLoaded", main);
