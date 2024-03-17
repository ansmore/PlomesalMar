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
const component = "whyBiit";
const modalTitle = document.getElementById("modalTitle");
const modalContent = document.getElementById("modalContent");
const modalPhoto = document.querySelector("#modalPhoto");
let imageUrl = "";
const loadImage = (url) => __awaiter(void 0, void 0, void 0, function* () {
    // Eliminado del if el campo -> "instanceof HTMLElement"
    if (modalPhoto && modalPhoto.tagName.toLowerCase() === "lottie-player") {
        // Modifica el atributo src de la imagen
        modalPhoto.load(url);
        // modalPhoto?.setAttribute("src", url);
    }
    else {
        console.error("Error: Elemento body__photo no es una etiqueta de imagen válida.");
    }
});
const firstModal = () => {
    console.log("1");
    modalTitle === null || modalTitle === void 0 ? void 0 : modalTitle.setAttribute("value-text", "modulosCliente");
    modalContent === null || modalContent === void 0 ? void 0 : modalContent.setAttribute("value-text", "modulosClienteText");
    imageUrl =
        "https://lottie.host/9addabc8-898b-4ee6-962e-34f3df25d702/q2VBNhlQ5Y.json";
};
const secondModal = () => {
    console.log("2");
    modalTitle === null || modalTitle === void 0 ? void 0 : modalTitle.setAttribute("value-text", "modulosComercio");
    modalContent === null || modalContent === void 0 ? void 0 : modalContent.setAttribute("value-text", "modulosComercioText");
    imageUrl =
        "https://lottie.host/a5e8a5f8-6431-471c-bff3-69cdda4020bb/UiDRnszEKS.json";
};
const thirdModal = () => {
    console.log("3");
    modalTitle === null || modalTitle === void 0 ? void 0 : modalTitle.setAttribute("value-text", "modulosProcesos");
    modalContent === null || modalContent === void 0 ? void 0 : modalContent.setAttribute("value-text", "modulosProcesosText");
    imageUrl =
        "https://lottie.host/00a7d5c0-3302-4c36-8e6f-08a6c3d85be7/xwvdrMnD4u.json";
};
const fourthModal = () => {
    console.log("4");
    modalTitle === null || modalTitle === void 0 ? void 0 : modalTitle.setAttribute("value-text", "modulosFactura");
    modalContent === null || modalContent === void 0 ? void 0 : modalContent.setAttribute("value-text", "modulosFacturaText");
    imageUrl =
        "https://lottie.host/928097fb-7738-4e2d-9eb4-6e4fb4641d89/wivNW9NuVC.json";
};
const fiveModal = () => {
    console.log("5");
    modalTitle === null || modalTitle === void 0 ? void 0 : modalTitle.setAttribute("value-text", "modulosBusiness");
    modalContent === null || modalContent === void 0 ? void 0 : modalContent.setAttribute("value-text", "modulosBusinessText");
    imageUrl =
        "https://lottie.host/4988d73d-0d49-4562-8729-c12a9add5725/6HwavVnFbt.json";
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
                case "fifthModal":
                    fiveModal();
                    break;
                default:
                    modalTitle.setAttribute("value-text", "");
                    modalContent.setAttribute("value-text", " ");
                    break;
            }
            loadTextComponent(component);
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
                openModal("#infoModal");
                // // Update contend after modal open
                yield selectContend(modalId);
            }
        }));
    });
});
