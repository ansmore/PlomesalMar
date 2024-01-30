// Función para mostrar el modal
function showModal(modalId: string) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = "block";
  }
}

// Función para ocultar el modal
function closeModal(modalId: string) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = "none";
  }
}

// Función para manejar el evento clic y determinar qué modal mostrar
function handleModalClick(event: Event) {
  const target = event.target as HTMLElement;
  const modalId = target.getAttribute("data-modal-id");

  if (modalId) {
    showModal(modalId);
  }
}

function onContentLoaded() {
  // Asignar manejadores de eventos a todos los discos
  const circleElements = document.querySelectorAll(".circle");
  circleElements.forEach((circle) => {
    circle.addEventListener("click", (event) => handleModalClick(event));
  });

  // También puedes asignar manejadores para ocultar el modal, por ejemplo, al hacer clic fuera del modal
  const closeModalButton = document.getElementById("closeModalButton");
  if (closeModalButton) {
    closeModalButton.addEventListener("click", () =>
      closeModal("specificModalId"),
    );
  }

  // Asignar manejador de eventos al contenedor principal para delegación de eventos
  const mainContainer = document.getElementById("mainContainer");
  if (mainContainer) {
    // También puedes asignar manejadores para ocultar el modal al hacer clic fuera de él
    mainContainer.addEventListener("click", () => closeModal("modalId"));
  }
}

// Agregar un manejador de eventos al contenido cargado
document.addEventListener("DOMContentLoaded", onContentLoaded);
