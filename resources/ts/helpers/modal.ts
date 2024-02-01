// helpers/modal.ts

import {
  loadTextComponent,
  loadText,
  getFinalLanguage,
  loadDictionary,
} from "./dictionary";

export const openModal = (modalId: string): void => {
  const modal = document.getElementById(modalId);
  const infoModalBox = document.getElementById("infoModal");

  if (modal && infoModalBox) {
    console.log("modal -> ", modalId);
    updateModalAttributes(modalId);
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

export const updateModalAttributes = async (modalId: string): Promise<void> => {
  const modalTitle = document.getElementById("modalTitle");
  const modalDynamicContent = document.getElementById("modalDynamicContent");
  const component = "whyBiit";

  if (modalTitle && modalDynamicContent) {
    try {
      const finalSelectedLanguage = await getFinalLanguage();
      const dictionary = await loadDictionary(finalSelectedLanguage, component);

      console.log("dictionary", dictionary);
      console.log("language", finalSelectedLanguage);
      // Ajusta el valor de value-text según el data-modal-id
      switch (modalId) {
        case "firstModal":
          console.log("1");
          modalTitle.setAttribute("value-text", "modulosCliente");
          modalDynamicContent.setAttribute("value-text", "modulosClienteText");

          break;
        case "secondModal":
          console.log("2");
          modalTitle.setAttribute("value-text", "modulosComercio");
          modalDynamicContent.setAttribute("value-text", "modulosComercioText");
          break;
        case "thirdModal":
          console.log("3");
          modalTitle.setAttribute("value-text", "modulosProcesos");
          modalDynamicContent.setAttribute("value-text", "modulosProcesosText");
          break;
        case "fourthModal":
          console.log("4");
          modalTitle.setAttribute("value-text", "modulosBusiness");
          modalDynamicContent.setAttribute("value-text", "modulosBusinessText");
          break;
        case "fifthModal":
          console.log("5");
          modalTitle.setAttribute("value-text", "modulosFactura");
          modalDynamicContent.setAttribute("value-text", "modulosFacturaText");
          break;
        // Añade más casos según sea necesario para otros modales
        default:
          // Por defecto
          modalTitle.setAttribute("value-text", "");
          modalDynamicContent.setAttribute("value-text", "");
          break;
      }
      // Carga el contenido desde el archivo JSON
      const modalContentText =
        dictionary[modalDynamicContent.getAttribute("value-text") || "1"];
      modalDynamicContent.innerHTML = modalContentText || "2";
    } catch (error) {
      console.error("Error updating modal attributes", error);
    }
  }
};
