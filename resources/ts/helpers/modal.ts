// helpers/modal.ts

export const openModal = (idModalToOpen: string): void => {
  const infoModalBox = document.querySelector(idModalToOpen) as HTMLElement;

  if (infoModalBox) {
    infoModalBox.style.display = "block";
  }
  closeModalButton();
  closeModalOutside();
};

export const closeModal = (modalId: string): void => {
  const modal = document.getElementById(modalId);

  if (modal) {
    modal.style.display = "none";
    resetImage();
    // resetContend();
  }
};

export const closeModalButton = (): void => {
  const closeModalButtons = document.querySelectorAll("#closeModalButton");

  closeModalButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const modal = button.closest("#infoModal");
      if (modal) {
        closeModal(modal.id);
      }
    });
  });
};

export const closeModalOutside = (): void => {
  document.addEventListener("click", (event: MouseEvent) => {
    const modals = document.querySelectorAll("#infoModal");
    let clickedInsideModal = false;

    modals.forEach((modal) => {
      const modalBox = modal.querySelector("#modalBox");
      const closeButton = modal.querySelector("#closeModalButton");
      const modalBodyContent = modal.querySelector("#modalBodyContent");

      if (
        modal instanceof HTMLElement &&
        modal.style.display === "block" &&
        modalBox instanceof HTMLElement &&
        modalBox.contains(event.target as Node) &&
        event.target instanceof HTMLElement &&
        (event.target === closeButton ||
          // event.target.classList.contains("modal__box") ||
          event.target.id === "modalBox" ||
          (modalBodyContent &&
            (modalBodyContent.contains(event.target as Node) ||
              modalBodyContent.isSameNode(event.target as Node))))
      ) {
        clickedInsideModal = true;
      }
    });

    if (!clickedInsideModal) {
      const modalButton = (event.target as HTMLElement).closest(".modal");
      if (modalButton) {
        closeModal(modalButton.id);
      }
    }
  });
};

export const resetContend = (): void => {
  const modalBodyContent = document.querySelector("#modalBodyContent");

  if (modalBodyContent) {
    modalBodyContent.innerHTML = "";
  }
};

export const resetImage = (): void => {
  const bodyPhoto = document.querySelector("#modalPhoto");

  bodyPhoto?.setAttribute("src", "");
};
