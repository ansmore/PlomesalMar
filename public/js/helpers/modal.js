// helpers/modal.ts
export const openModal = (idModalToOpen) => {
    const infoModalBox = document.querySelector(idModalToOpen);
    if (infoModalBox) {
        infoModalBox.style.display = "block";
    }
    closeModalButton();
    closeModalOutside();
};
export const closeModal = (modalId) => {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
        resetImage();
        // resetContend();
    }
};
export const closeModalButton = () => {
    const closeModalButtons = document.querySelectorAll("#closeModalButton");
    closeModalButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const modal = button.closest(".modal");
            if (modal) {
                closeModal(modal.id);
            }
        });
    });
};
export const closeModalOutside = () => {
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
                clickedInsideModal = true;
            }
        });
        if (!clickedInsideModal) {
            const modalButton = event.target.closest(".modal");
            if (modalButton) {
                closeModal(modalButton.id);
            }
        }
    });
};
export const resetContend = () => {
    const modalBodyContent = document.querySelector("#modalBodyContent");
    if (modalBodyContent) {
        modalBodyContent.innerHTML = "";
    }
};
export const resetImage = () => {
    const bodyPhoto = document.querySelector("#modalPhoto");
    bodyPhoto === null || bodyPhoto === void 0 ? void 0 : bodyPhoto.setAttribute("src", "");
};
