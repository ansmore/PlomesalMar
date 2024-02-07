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
    const closeModalButtons = document.querySelectorAll("#closeModalButton");
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
            const modalBox = modal.querySelector("#modalBox");
            if (modal instanceof HTMLElement &&
                modal.style.display === "block" &&
                modalBox instanceof HTMLElement &&
                modalBox.contains(event.target) &&
                event.target instanceof HTMLElement &&
                (event.target.classList.contains("modal-button") ||
                    event.target.classList.contains("modal__box"))) {
                console.log("click detectado dentro del modal", modal.id);
                clickedInsideModal = true;
            }
        });
        if (!clickedInsideModal) {
            const modalButton = event.target.closest(".modal");
            if (modalButton) {
                console.log("detectado click outside", modalButton.id);
                closeModal(modalButton.id);
            }
        }
    });
};
export const updateModalAttributes = (modalId) => __awaiter(void 0, void 0, void 0, function* () {
    const modalTitle = document.getElementById("modalTitle");
    const modalContent = document.getElementById("modalContent");
    const component = "whyBiit";
    if (modalTitle && modalContent) {
        try {
            switch (modalId) {
                case "firstModal":
                    console.log("1");
                    modalTitle.setAttribute("value-text", "modulosCliente");
                    modalContent.setAttribute("value-text", "modulosClienteText");
                    // loadTextComponent(component);
                    break;
                case "secondModal":
                    console.log("2");
                    modalTitle.setAttribute("value-text", "modulosComercio");
                    modalContent.setAttribute("value-text", "modulosComercioText");
                    // loadTextComponent(component);
                    break;
                case "thirdModal":
                    console.log("3");
                    modalTitle.setAttribute("value-text", "modulosProcesos");
                    modalContent.setAttribute("value-text", "modulosProcesosText");
                    // loadTextComponent(component);
                    break;
                case "fourthModal":
                    console.log("4");
                    modalTitle.setAttribute("value-text", "modulosFactura");
                    modalContent.setAttribute("value-text", "modulosFacturaText");
                    // loadTextComponent(component);
                    break;
                case "fifthModal":
                    console.log("5");
                    modalTitle.setAttribute("value-text", "modulosBusiness");
                    modalContent.setAttribute("value-text", "modulosBusinessText");
                    // loadTextComponent(component);
                    break;
                default:
                    // Por defecto
                    modalTitle.setAttribute("value-text", "default");
                    modalContent.setAttribute("value-text", "default");
                    // loadTextComponent(component);
                    break;
            }
            loadTextComponent(component);
        }
        catch (error) {
            console.error("Error updating modal attributes", error);
        }
    }
});
