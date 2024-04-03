var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { openModal } from "../helpers/modal.js";
import { loadTextComponent } from "../helpers/dictionary.js";
const component = "home";
const modalTitle = document.getElementById("modalTitle");
const teamTitle = document.getElementById("teamTitle");
const modalTitle2 = document.getElementById("modalTitle2");
const modalPosition = document.getElementById("modalPosition");
const teamPosition = document.getElementById("teamPosition");
const modalContent = document.getElementById("modalContent");
const modalPhoto = document.querySelector("#modalPhoto");
let imageUrl = "";
const loadImage = (url) => __awaiter(void 0, void 0, void 0, function* () {
    if (modalPhoto) {
        modalPhoto === null || modalPhoto === void 0 ? void 0 : modalPhoto.setAttribute("src", url);
    }
    else {
        console.error("Error: Elemento body__photo no es una etiqueta de imagen válida.");
    }
});
const firstModal = () => {
    console.log("1");
    modalTitle === null || modalTitle === void 0 ? void 0 : modalTitle.setAttribute("data-text", "team1");
    modalPosition === null || modalPosition === void 0 ? void 0 : modalPosition.setAttribute("data-text", "team1position");
    modalContent === null || modalContent === void 0 ? void 0 : modalContent.setAttribute("data-text", "12");
    // team1description
    imageUrl = "../../img/logos/logo_biit.png";
};
const secondModal = () => {
    console.log("2");
    modalTitle === null || modalTitle === void 0 ? void 0 : modalTitle.setAttribute("data-text", "services3");
    modalPosition === null || modalPosition === void 0 ? void 0 : modalPosition.setAttribute("data-text", "aboutButton");
    modalContent === null || modalContent === void 0 ? void 0 : modalContent.setAttribute("data-text", "services4");
    imageUrl = "../../img/logos/logo_biit.png";
};
const thirdModal = () => {
    console.log("3");
    teamTitle === null || teamTitle === void 0 ? void 0 : teamTitle.setAttribute("data-text", "services1");
    modalTitle2 === null || modalTitle2 === void 0 ? void 0 : modalTitle2.setAttribute("data-text", "services4");
    teamPosition === null || teamPosition === void 0 ? void 0 : teamPosition.setAttribute("data-text", "aboutButton");
    modalContent === null || modalContent === void 0 ? void 0 : modalContent.setAttribute("data-text", "homeIntro3");
    imageUrl = "../../img/logos/logo_biit.png";
};
const fourthModal = () => {
    console.log("4");
    modalTitle === null || modalTitle === void 0 ? void 0 : modalTitle.setAttribute("data-text", "team4");
    modalPosition === null || modalPosition === void 0 ? void 0 : modalPosition.setAttribute("data-text", "team4position");
    modalContent === null || modalContent === void 0 ? void 0 : modalContent.setAttribute("data-text", "team4description");
    imageUrl = "../../img/logos/logo_biit.png";
};
export const selectContend = (modalId) => __awaiter(void 0, void 0, void 0, function* () {
    if (modalTitle && modalContent) {
        try {
            switch (modalId) {
                case "firstModal":
                    firstModal();
                    break;
                case "secondModal":
                    secondModal();
                    break;
                case "thirdModal":
                    thirdModal();
                    break;
                case "fourthModal":
                    fourthModal();
                    break;
                default:
                    modalTitle.setAttribute("data-text", "");
                    modalContent.setAttribute("data-text", " ");
                    break;
            }
            yield loadTextComponent(component);
            yield loadImage(imageUrl);
        }
        catch (error) {
            console.error("Error updating modal attributes", error);
        }
    }
});
export const loadModal = () => __awaiter(void 0, void 0, void 0, function* () {
    // Pendiente de cambiar a abrir por Id
    const modalButtons = document.querySelectorAll(".modal-button");
    modalButtons.forEach((button) => {
        button.addEventListener("click", () => __awaiter(void 0, void 0, void 0, function* () {
            const modalId = button.getAttribute("data-modal-id");
            if (modalId) {
                // // Open modal with specific id to modal
                // openModal("#infoModal");
                if (modalId === "secondModal") {
                    openModal("1");
                }
                else {
                    openModal("2");
                }
                // // Update contend after modal open
                yield selectContend(modalId);
            }
        }));
    });
});
