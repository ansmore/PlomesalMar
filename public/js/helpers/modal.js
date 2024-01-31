// helpers/modal.ts
// let activeModalId: string | null = null;
export const openModal = (modalId) => {
    const modal = document.getElementById(modalId);
    const infoModalBox = document.getElementById("infoModal");
    if (modal && infoModalBox) {
        console.log("modal -> ", modalId);
        infoModalBox.style.display = "block";
        // activeModalId = modalId;
    }
};
export const closeModal = (modalId) => {
    const modal = document.getElementById(modalId);
    // const padre = document.querySelector("#infoModal");
    // && (activeModalId === modalId || (padre && padre.id === modalId))
    if (modal) {
        console.log("close -> ", modalId);
        modal.style.display = "none";
        // activeModalId = null;
    }
};
export const setupModalButtons = () => {
    const modalButtons = document.querySelectorAll(".modal-button");
    modalButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const modalId = button.getAttribute("data-modal-id");
            if (modalId) {
                console.log("click -> ", modalId);
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
                console.log("cierre modal button", modal.id);
                closeModal(modal.id);
            }
        });
    });
};
export const setupOutsideModalClick = () => {
    document.addEventListener("click", (event) => {
        const modals = document.querySelectorAll(".modal");
        // const padre = document.querySelector("#infoModal");
        modals.forEach((modal) => {
            const modalContent = modal.querySelector(".modal-content");
            if (modal instanceof HTMLElement &&
                modal.style.display === "block" &&
                modalContent &&
                !modalContent.contains(event.target) &&
                !(event.target instanceof HTMLElement &&
                    event.target.classList.contains("modal-button")) &&
                !(event.target instanceof HTMLElement &&
                    event.target.classList.contains("modal-content"))) {
                // const modalOpener = event.target as HTMLElement;
                // if (!modalOpener.classList.contains("modal-button")) {
                console.log("cierre modal outside", modal.id);
                //   // const padreId = padre.id;
                //   closeModal(modal.id);
                // }
            }
        });
    });
};
