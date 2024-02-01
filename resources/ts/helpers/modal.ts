// helpers/modal.ts

export const openModal = (modalId: string): void => {
  const modal = document.getElementById(modalId);
  const infoModalBox = document.getElementById("infoModal");

  if (modal && infoModalBox) {
    // console.log("modal -> ", modalId);
    infoModalBox.style.display = "block";
  }
};

export const closeModal = (modalId: string): void => {
  const modal = document.getElementById(modalId);

  if (modal) {
    // console.log("close trueeee -> ", modalId);
    modal.style.display = "none";
  }
};

export const setupModalButtons = (): void => {
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

export const setupCloseModalButtons = (): void => {
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

export const setupOutsideModalClick = (): void => {
  document.addEventListener("click", (event: MouseEvent) => {
    const modals = document.querySelectorAll(".modal");
    let clickedInsideModal = false;

    modals.forEach((modal) => {
      const modalContent = modal.querySelector(".modal-content");

      if (
        modal instanceof HTMLElement &&
        modal.style.display === "block" &&
        modalContent instanceof HTMLElement &&
        modalContent.contains(event.target as Node) &&
        event.target instanceof HTMLElement &&
        (event.target.classList.contains("modal-button") ||
          event.target.classList.contains("modal-content"))
      ) {
        // console.log("click detectado dentro del modal", modal.id);
        clickedInsideModal = true;
      }
    });

    if (!clickedInsideModal) {
      const modalButton = (event.target as HTMLElement).closest(".modal");
      if (modalButton) {
        // console.log("detectado click outside", modalButton.id);
        closeModal(modalButton.id);
      }
    }
  });
};
