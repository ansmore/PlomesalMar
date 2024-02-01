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
    const padre = document.querySelector("#infoModal");
    // const padreId = padre.id;
    // && (activeModalId === modalId || (padre && padre.id === modalId))
    // Verificar si el ID corresponde al modal o al padre
    const esModal = modalId === (modal === null || modal === void 0 ? void 0 : modal.id);
    const esPadre = modalId === (padre === null || padre === void 0 ? void 0 : padre.id);
    // console.log("Modal esPadre -> ", esPadre);
    // console.log("Modal esHijo -> ", esModal);
    // if (modalId === "infoModal") {
    //   console.log("dentro de infoModal -> ", modalId);
    // }
    // // Ocultar el modal
    // if (modal && esModal) {
    //   console.log("Modal hijo -> ", modalId);
    //   modal.style.display = "none";
    // }
    // // Ocultar el padre solo si es un elemento HTML con propiedad style
    // if (padre && esPadre) {
    //   console.log("Modal padre -> ", modalId);
    //   if (padre instanceof HTMLElement && padre.style) {
    //     padre.style.display = "none";
    //   }
    // }
    if (modal) {
        console.log("close trueeee -> ", modalId);
        modal.style.display = "none";
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
                console.log("click detectado", modal.id);
                modal.addEventListener("click", () => {
                    const modalButton = modal.closest(".modal");
                    if (modalButton) {
                        console.log("detectado click outside?", modalButton.id);
                        // closeModal(modalButton.id);
                    }
                });
            }
        });
    });
};
