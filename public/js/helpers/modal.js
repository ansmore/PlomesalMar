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
        resetImage();
    }
};
const resetImage = () => {
    const bodyPhoto = document.querySelector("#modalPhoto");
    bodyPhoto === null || bodyPhoto === void 0 ? void 0 : bodyPhoto.setAttribute("src", "");
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
            const closeButton = modal.querySelector("#closeModalButton");
            const modalBodyContent = modal.querySelector("#modalBodyContent");
            if (modal instanceof HTMLElement &&
                modal.style.display === "block" &&
                modalBox instanceof HTMLElement &&
                modalBox.contains(event.target) &&
                event.target instanceof HTMLElement &&
                (event.target === closeButton ||
                    event.target.classList.contains("modal__box") ||
                    (modalBodyContent &&
                        (modalBodyContent.contains(event.target) ||
                            modalBodyContent.isSameNode(event.target))))) {
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
export const loadImage = (url) => {
    const bodyPhoto = document.querySelector("#modalPhoto");
    if (bodyPhoto instanceof HTMLElement) {
        // Modifica el atributo src de la imagen
        bodyPhoto.onload = () => {
            // La imagen se ha cargado completamente
            console.log("Imagen cargada correctamente");
            console.log("url", url);
        };
        bodyPhoto === null || bodyPhoto === void 0 ? void 0 : bodyPhoto.setAttribute("src", url);
        console.log("url->", url);
        // bodyPhoto.src = url;
    }
    else {
        console.error("Error: Elemento body__photo no es una etiqueta de imagen válida.");
    }
};
export const updateModalAttributes = (modalId) => __awaiter(void 0, void 0, void 0, function* () {
    const modalTitle = document.getElementById("modalTitle");
    const modalContent = document.getElementById("modalContent");
    // const modalPhoto = document.querySelector("#modalPhoto");
    const component = "whyBiit";
    let imageUrl = "";
    if (modalTitle && modalContent) {
        try {
            switch (modalId) {
                case "firstModal":
                    console.log("1");
                    modalTitle.setAttribute("value-text", "modulosCliente");
                    modalContent.setAttribute("value-text", "modulosClienteText");
                    imageUrl =
                        "https://lottie.host/embed/9addabc8-898b-4ee6-962e-34f3df25d702/q2VBNhlQ5Y.json";
                    // modalPhoto?.setAttribute("src", "{{ asset('img/logo.png') }}");
                    // loadTextComponent(component);
                    break;
                case "secondModal":
                    console.log("2");
                    modalTitle.setAttribute("value-text", "modulosComercio");
                    modalContent.setAttribute("value-text", "modulosComercioText");
                    imageUrl =
                        "https://lottie.host/embed/a5e8a5f8-6431-471c-bff3-69cdda4020bb/UiDRnszEKS.json";
                    // modalPhoto?.setAttribute("src", "img/banner.jpg");
                    // loadTextComponent(component);
                    break;
                case "thirdModal":
                    console.log("3");
                    modalTitle.setAttribute("value-text", "modulosProcesos");
                    modalContent.setAttribute("value-text", "modulosProcesosText");
                    imageUrl =
                        "https://lottie.host/embed/00a7d5c0-3302-4c36-8e6f-08a6c3d85be7/xwvdrMnD4u.json";
                    // modalPhoto?.setAttribute("src", "img/banner.jpg");
                    // loadTextComponent(component);
                    break;
                case "fourthModal":
                    console.log("4");
                    modalTitle.setAttribute("value-text", "modulosFactura");
                    modalContent.setAttribute("value-text", "modulosFacturaText");
                    imageUrl =
                        "https://lottie.host/embed/928097fb-7738-4e2d-9eb4-6e4fb4641d89/wivNW9NuVC.json";
                    // modalPhoto?.setAttribute("src", "img/banner.jpg");
                    // loadTextComponent(component);
                    break;
                case "fifthModal":
                    console.log("5");
                    modalTitle.setAttribute("value-text", "modulosBusiness");
                    modalContent.setAttribute("value-text", "modulosBusinessText");
                    imageUrl =
                        "https://lottie.host/embed/4988d73d-0d49-4562-8729-c12a9add5725/6HwavVnFbt.json";
                    // modalPhoto?.setAttribute("src", "img/banner.jpg");
                    // loadTextComponent(component);
                    break;
                default:
                    // Por defecto
                    modalTitle.setAttribute("value-text", "default");
                    modalContent.setAttribute("value-text", "default");
                    // modalPhoto?.setAttribute("src", "img/banner.jpg");
                    // loadTextComponent(component);
                    break;
            }
            loadTextComponent(component);
            loadImage(imageUrl);
        }
        catch (error) {
            console.error("Error updating modal attributes", error);
        }
    }
});
