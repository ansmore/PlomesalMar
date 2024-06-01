document.addEventListener('DOMContentLoaded', () => {
    setupModalEventListenersObservations();
});
export const setupModalEventListenersObservations = () => {
    const buttons = document.querySelectorAll('[data-bs-toggle="modal"]');
    buttons.forEach((button) => {
        button.removeEventListener("click", handleModalButtonClick);
        button.addEventListener("click", handleModalButtonClick);
    });
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach((button) => {
        button.removeEventListener("click", closeModalButtonClick);
        button.addEventListener("click", closeModalButtonClick);
    });
};
export const cleanupObservations = () => {
    const buttons = document.querySelectorAll('[data-bs-toggle="modal"]');
    buttons.forEach((button) => {
        button.removeEventListener("click", handleModalButtonClick);
    });
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach((button) => {
        button.removeEventListener("click", closeModalButtonClick);
    });
};
const handleModalButtonClick = (event) => {
    const button = event.currentTarget;
    const modalId = button.getAttribute("data-bs-target");
    if (!modalId) {
        console.error("No se encontró el ID del modal en el botón:", button);
        return;
    }
    const modal = document.getElementById(modalId);
    if (!modal) {
        console.error("No se encontró el elemento modal para el objetivo:", modalId);
        return;
    }
    const observationId = button.getAttribute("data-id");
    const observationName = button.getAttribute("data-name");
    if (!observationId || !observationName) {
        console.error("Faltan atributos de datos");
        return;
    }
    switch (modalId) {
        case "deleteObservationModal":
            handleDeleteObservationModal(modal, observationId, observationName);
            break;
        default:
            console.error("Objetivo del modal desconocido:", modalId);
            break;
    }
};
const closeModalButtonClick = (event) => {
    const button = event.currentTarget;
    const modal = button.closest(".modal");
    if (modal) {
        modal.style.display = "none";
    }
};
const openModal = (modal) => {
    modal.style.display = "block";
};
const handleDeleteObservationModal = (modal, observationId, observationName) => {
    const deleteForm = modal.querySelector("form#deleteObservationForm");
    const textObservationName = modal.querySelector("#deleteObservationName");
    const inputObservationId = modal.querySelector("#deleteObservationId");
    if (!deleteForm || !textObservationName || !inputObservationId) {
        console.error("Faltan el formulario o campos de texto en el modal de eliminación");
        return;
    }
    const actionTemplate = deleteForm.dataset.actionTemplate;
    if (actionTemplate) {
        deleteForm.action = actionTemplate.replace(":id", observationId.toString());
    }
    else {
        console.error("Falta la plantilla de URL de eliminación en el formulario");
        return;
    }
    textObservationName.textContent = observationName;
    inputObservationId.value = observationId;
    openModal(modal);
};
