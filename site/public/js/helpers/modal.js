export const openModal = (idModalToOpen) => {
    // const infoModalBox = document.querySelector(idModalToOpen) as HTMLElement;
    const infoModalBox = document.querySelector(`[data-type="${idModalToOpen}"]`);
    if (infoModalBox) {
        infoModalBox.style.display = "block";
        closeModalButton();
        closeModalOutside();
    }
};
export const closeModal = (modalId) => {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
        resetImage();
        // ResetContend();
    }
};
export const closeModalButton = () => {
    const closeModalButtons = document.querySelectorAll(".close");
    closeModalButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const modal = button.closest(".modal");
            if (modal) {
                console.log("close", modal.id);
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
            const modalBox = modal.querySelectorAll(".modal__box");
            const closeButton = modal.querySelector(".close");
            const modalBodyContent = modal.querySelector(".body");
            if (modal instanceof HTMLElement &&
                modal.style.display === "block" &&
                modalBox instanceof HTMLElement &&
                modalBox.contains(event.target) &&
                event.target instanceof HTMLElement &&
                (event.target === closeButton ||
                    // Event.target.classList.contains("modal__box") ||
                    event.target.id === "modal__box" ||
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
export const resetImage = () => {
    const bodyPhoto = document.querySelector("#modalPhoto");
    bodyPhoto?.setAttribute("src", "");
};
