// helpers/modal.ts
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import { loadTextComponent, } from "./dictionary.js";
export const openModal = (modalId) => {
    const modal = document.getElementById(modalId);
    const infoModalBox = document.getElementById("infoModal");
    if (modal && infoModalBox) {
        console.log("modal -> ", modalId);
        updateModalAttributes(modalId);
        infoModalBox.style.display = "block";
    }
};
export const closeModal = (modalId) => {
    const modal = document.getElementById(modalId);
    if (modal) {
        // console.log("close trueeee -> ", modalId);
        modal.style.display = "none";
    }
};
export const setupModalButtons = () => {
    const modalButtons = document.querySelectorAll(".modal-button");
    modalButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const modalId = button.getAttribute("data-modal-id");
            if (modalId) {
                // console.log("click -> ", modalId);
                openModal(modalId);
            }
        });
    });
};
export const setupCloseModalButtons = () => {
    const closeModalButtons = document.querySelectorAll(".close");
    closeModalButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const modal = button.closest(".modal");
            if (modal) {
                // console.log("cierre modal button", modal.id);
                closeModal(modal.id);
            }
        });
    });
};
export const setupOutsideModalClick = () => {
    document.addEventListener("click", (event) => {
        const modals = document.querySelectorAll(".modal");
        let clickedInsideModal = false;
        modals.forEach((modal) => {
            const modalContent = modal.querySelector(".modal-content");
            if (modal instanceof HTMLElement &&
                modal.style.display === "block" &&
                modalContent instanceof HTMLElement &&
                modalContent.contains(event.target) &&
                event.target instanceof HTMLElement &&
                (event.target.classList.contains("modal-button") ||
                    event.target.classList.contains("modal-content"))) {
                // console.log("click detectado dentro del modal", modal.id);
                clickedInsideModal = true;
            }
        });
        if (!clickedInsideModal) {
            const modalButton = event.target.closest(".modal");
            if (modalButton) {
                // console.log("detectado click outside", modalButton.id);
                closeModal(modalButton.id);
            }
        }
    });
};
export const updateModalAttributes = (modalId) => __awaiter(void 0, void 0, void 0, function* () {
    const modalTitle = document.getElementById("modalTitle");
    const modalDynamicContent = document.getElementById("modalDynamicContent");
    const component = "whyBiit";
    if (modalTitle && modalDynamicContent) {
        try {
            // const finalSelectedLanguage = await getFinalLanguage();
            // const dictionary = await loadDictionary(finalSelectedLanguage, component);
            // console.log("dictionary", dictionary);
            // console.log("language", finalSelectedLanguage);
            // Ajusta el valor de value-text según el data-modal-id
            switch (modalId) {
                case "firstModal":
                    console.log("1");
                    modalTitle.setAttribute("value-text", "modulosCliente");
                    modalDynamicContent.setAttribute("value-text", "modulosClienteText");
                    // loadTextComponent(component);
                    break;
                case "secondModal":
                    console.log("2");
                    modalTitle.setAttribute("value-text", "modulosComercio");
                    modalDynamicContent.setAttribute("value-text", "modulosComercioText");
                    // loadTextComponent(component);
                    break;
                case "thirdModal":
                    console.log("3");
                    modalTitle.setAttribute("value-text", "modulosProcesos");
                    modalDynamicContent.setAttribute("value-text", "modulosProcesosText");
                    // loadTextComponent(component);
                    break;
                case "fourthModal":
                    console.log("4");
                    modalTitle.setAttribute("value-text", "modulosFactura");
                    modalDynamicContent.setAttribute("value-text", "modulosFacturaText");
                    // loadTextComponent(component);
                    break;
                case "fifthModal":
                    console.log("5");
                    modalTitle.setAttribute("value-text", "modulosBusiness");
                    modalDynamicContent.setAttribute("value-text", "modulosBusinessText");
                    // loadTextComponent(component);
                    break;
                // Añade más casos según sea necesario para otros modales
                default:
                    // Por defecto
                    modalTitle.setAttribute("value-text", "default");
                    modalDynamicContent.setAttribute("value-text", "default");
                    // loadTextComponent(component);
                    break;
            }
            loadTextComponent(component);
            // // Carga el contenido desde el archivo JSON
            // const modalContentText =
            //   dictionary[modalDynamicContent.getAttribute("value-text") || "1"];
            // modalDynamicContent.innerHTML = modalContentText || "2";
        }
        catch (error) {
            console.error("Error updating modal attributes", error);
        }
    }
});
