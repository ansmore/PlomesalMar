import { getFinalLanguage, loadTextComponent, setLanguage, getFirstSegment, getSecondSegment, getIdSegment, getOthersSegments, } from "../helpers/dictionary.js";
export const navbar = "navigation";
let selectedOption = null;
const main = async () => {
    void loadTextComponent(navbar);
    const finalSelectedLanguage = await getFinalLanguage();
    void changeLanguage(finalSelectedLanguage);
};
const handleClick = (event) => {
    event.preventDefault();
    selectedOption = event.target.id;
    void setLanguage(selectedOption);
    void changeLanguage(selectedOption);
    const toggleCheckbox = document.getElementById("toggle-menu-checkbox");
    toggleCheckbox.checked = false;
};
document.addEventListener("DOMContentLoaded", () => {
    const dropDownLinks = document.querySelectorAll("#setLanguages a");
    dropDownLinks.forEach((link) => {
        link.addEventListener("click", handleClick);
    });
    const menuLinks = document.querySelectorAll(".navbar__menu .list__item__link");
    menuLinks.forEach((link) => {
        link.addEventListener("click", () => {
            const toggleCheckbox = document.getElementById("toggle-menu-checkbox");
            toggleCheckbox.checked = false;
        });
    });
    const submenuLinks = document.querySelectorAll(".dropdown__menu__item");
    submenuLinks.forEach((link) => {
        link.addEventListener("click", () => {
            const toggleCheckbox = document.getElementById("toggle-menu-checkbox");
            toggleCheckbox.checked = false;
        });
    });
});
const changeLanguage = async (language) => {
    try {
        const currentUrl = window.location.href;
        const firstSegment = await getFirstSegment(currentUrl);
        const secondSegment = await getSecondSegment(currentUrl);
        const idSegment = await getIdSegment(currentUrl);
        const othersSegments = await getOthersSegments(currentUrl);
        // DeveloperMode
        console.log("current", currentUrl);
        console.log("first", firstSegment);
        console.log("second", secondSegment);
        console.log("id", idSegment);
        console.log("others", othersSegments);
        const csrfToken = document
            .querySelector("meta[name=csrf-token]")
            ?.getAttribute("content");
        const response = await fetch(`/sendLanguage`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken ?? "",
            },
            body: JSON.stringify({
                language,
                firstSegment,
                secondSegment,
                idSegment,
                othersSegments,
            }),
        });
        if (response.ok) {
            const responseData = await response.json();
            let { newUrl, ordenationString, ordenationAdmin } = responseData;
            if (ordenationString !== "") {
                console.log("newUrl String ->", newUrl);
                console.log("ordenation string->", ordenationString);
                newUrl += `?${ordenationString}`;
                console.log("Aqui newURL string->", newUrl);
            }
            else if (ordenationAdmin !== "") {
                console.log("newUrl admin->", newUrl);
                console.log("ordenation admin->", ordenationAdmin);
                newUrl += `?${ordenationAdmin}`;
                console.log("Aqui newURL admin->", newUrl);
            }
            if (typeof newUrl === "string") {
                history.replaceState({ url: newUrl }, "", newUrl);
            }
        }
        if (!response.ok) {
            console.error("! response.ok->", language);
            throw new Error(`-> Error en la solicitud: ${response.status}`);
        }
    }
    catch (error) {
        console.error("Error al cambiar el idioma:", error);
    }
};
document.addEventListener("DOMContentLoaded", main);
