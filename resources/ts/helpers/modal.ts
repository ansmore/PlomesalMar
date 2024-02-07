// helpers/modal.ts

import {
  loadTextComponent,
  loadText,
  getFinalLanguage,
  loadDictionary,
} from "./dictionary.js";

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

export const setupOutsideModalClick = (): void => {
  document.addEventListener("click", (event: MouseEvent) => {
    const modals = document.querySelectorAll(".modal");
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
          event.target.classList.contains("modal__box") ||
          (modalBodyContent &&
            (modalBodyContent.contains(event.target as Node) ||
              modalBodyContent.isSameNode(event.target as Node))))
      ) {
        console.log("click detectado dentro del modal", modal.id);
        clickedInsideModal = true;
      }
    });

    if (!clickedInsideModal) {
      const modalButton = (event.target as HTMLElement).closest(".modal");
      if (modalButton) {
        console.log("detectado click outside", modalButton.id);
        closeModal(modalButton.id);
      }
    }
  });
};

// Claro, desglosemos cada una de las comprobaciones dentro del if en la función setupOutsideModalClick:

// modal instanceof HTMLElement:

// Verifica si la variable modal es una instancia de la clase HTMLElement. Es una forma de asegurarse de que la variable que estamos tratando es un elemento HTML válido.
// modal.style.display === "block":

// Comprueba si el modal está actualmente visible (es decir, tiene la propiedad display configurada como "block"). Esto asegura que solo se procesen los modales que están mostrándose en la interfaz.
// modalBox instanceof HTMLElement:

// Confirma si modalBox es una instancia de la clase HTMLElement. En este contexto, modalBox es el contenedor principal del modal.
// modalBox.contains(event.target as Node):

// Comprueba si el objetivo del evento (event.target) está contenido dentro de modalBox. Esto significa que el clic ocurrió dentro del área del modal que está representada por modalBox.
// event.target instanceof HTMLElement:

// Asegura que el objetivo del evento es realmente un elemento HTML. Este control adicional es necesario porque TypeScript no puede inferir el tipo exacto del objetivo del evento.
// (event.target === closeButton || event.target.classList.contains("modal__box"):

// Verifica si el objetivo del evento es el botón de cierre (closeButton) o si pertenece a la clase modal__box. Si es así, se considera que el clic ocurrió en un área específica dentro del modal.
// (modalBodyContent && (modalBodyContent.contains(event.target as Node) || modalBodyContent.isSameNode(event.target as Node))):

// Asegura que modalBodyContent existe y luego verifica si el clic ocurrió dentro de modalBodyContent o si el objetivo del evento es exactamente el mismo nodo que modalBodyContent. Esto se añadió para incluir todo el espacio del #modalBodyContent como parte del modal.

// export const setupOutsideModalClick2 = (): void => {
//   document.addEventListener("click", (event: MouseEvent) => {
//     const modals = document.querySelectorAll(".modal");
//     const clickedInsideModal = Array.from(modals).some((modal) => {
//       const modalBox = modal.querySelector("#modalBox");
//       const closeButton = modal.querySelector("#closeModalButton");
//       const modalBodyContent = modal.querySelector("#modalBodyContent");

//       return (
//         modal instanceof HTMLElement &&
//         modal.style.display === "block" &&
//         modalBox instanceof HTMLElement &&
//         modalBox.contains(event.target as Node) &&
//         event.target instanceof HTMLElement &&
//         (event.target === closeButton ||
//           event.target.classList.contains("modal__box") ||
//           (modalBodyContent && modalBodyContent.contains(event.target as Node)))
//       );
//     });

//     if (!clickedInsideModal) {
//       const modalButton = (event.target as HTMLElement).closest(".modal");
//       if (modalButton) {
//         console.log("detectado click outside", modalButton.id);
//         closeModal(modalButton.id);
//       }
//     }
//   });
// };

export const updateModalAttributes = async (modalId: string): Promise<void> => {
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
    } catch (error) {
      console.error("Error updating modal attributes", error);
    }
  }
};
