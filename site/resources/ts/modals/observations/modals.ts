document.addEventListener('DOMContentLoaded', () => {
    setupModalEventListenersObservations();
});

export const setupModalEventListenersObservations = (): void => {
    const buttons = document.querySelectorAll<HTMLButtonElement>('[data-bs-toggle="modal"]');
    buttons.forEach((button) => {
        button.removeEventListener("click", handleModalButtonClick);
        button.addEventListener("click", handleModalButtonClick);
    });
    document.querySelectorAll<HTMLButtonElement>('[data-bs-dismiss="modal"]').forEach((button) => {
        button.removeEventListener("click", closeModalButtonClick);
        button.addEventListener("click", closeModalButtonClick);
    });
};

export const cleanupObservations = (): void => {
    const buttons = document.querySelectorAll<HTMLButtonElement>('[data-bs-toggle="modal"]');
    buttons.forEach((button) => {
        button.removeEventListener("click", handleModalButtonClick);
    });
    document.querySelectorAll<HTMLButtonElement>('[data-bs-dismiss="modal"]').forEach((button) => {
        button.removeEventListener("click", closeModalButtonClick);
    });
};

const handleModalButtonClick = (event: Event): void => {
    const button = event.currentTarget as HTMLButtonElement;
    const modalId = button.getAttribute("data-bs-target");

    if (!modalId) {
        console.error("No se encontró el ID del modal en el botón:", button);
        return;
    }

    const modal = document.getElementById(modalId) as HTMLDivElement;
    if (!modal) {
        console.error("No se encontró el elemento modal para el objetivo:", modalId);
        return;
    }

    const observationId = button.getAttribute("data-id");
    const observationName = button.getAttribute("data-name");

    console.log("observationId:", observationId); // Log para observationId
    console.log("observationName:", observationName); // Log para observationName
    
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

const closeModalButtonClick = (event: Event): void => {
    const button = event.currentTarget as HTMLButtonElement;
    const modal = button.closest(".modal") as HTMLDivElement;
    if (modal) {
        modal.style.display = "none";
    }
};

const openModal = (modal: HTMLDivElement): void => {
    modal.style.display = "block";
};

const handleDeleteObservationModal = (modal: HTMLDivElement, observationId: string, observationName: string): void => {
    const deleteForm = modal.querySelector<HTMLFormElement>("form#deleteObservationForm");
    const textObservationName = modal.querySelector<HTMLElement>("#deleteObservationName");
    const inputObservationId = modal.querySelector<HTMLInputElement>("#deleteObservationId");

    if (!deleteForm || !textObservationName || !inputObservationId) {
        console.error("Faltan el formulario o campos de texto en el modal de eliminación");
        return;
    }

    const actionTemplate = deleteForm.dataset.actionTemplate;
    if (actionTemplate) {
        deleteForm.action = actionTemplate.replace(":id", observationId.toString());
    } else {
        console.error("Falta la plantilla de URL de eliminación en el formulario");
        return;
    }

    textObservationName.textContent = observationName;
    inputObservationId.value = observationId;

    openModal(modal);
};
