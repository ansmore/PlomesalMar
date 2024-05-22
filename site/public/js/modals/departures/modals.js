export const setupModalEventListenersDepartures = () => {
    const buttons = document.querySelectorAll('[data-bs-toggle="modal"]');
    buttons.forEach((button) => {
        button.removeEventListener("click", handleModalButtonClick);
        button.addEventListener("click", handleModalButtonClick);
    });
    document
        .querySelectorAll('[data-bs-dismiss="modal"]')
        .forEach((button) => {
        button.removeEventListener("click", closeModalButtonClick);
        button.addEventListener("click", closeModalButtonClick);
    });
};
export const cleanupDepartures = () => {
    const buttons = document.querySelectorAll('[data-bs-toggle="modal"]');
    buttons.forEach((button) => {
        button.removeEventListener("click", handleModalButtonClick);
    });
    document
        .querySelectorAll('[data-bs-dismiss="modal"]')
        .forEach((button) => {
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
    const departureId = button.getAttribute("data-id");
    const departureName = button.getAttribute("data-name");
    switch (modalId) {
        case "createDeparture":
            openModal(modal);
            break;
        case "editDepartureModal":
            if (!departureId) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleEditDepartureModal(modal, departureId);
            break;
        case "detailsDepartureModal":
            if (!departureId) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleDetailsDepartureModal(modal, departureId);
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
const handleEditDepartureModal = (modal, departureId) => {
    const editForm = modal.querySelector("form");
    const inputDepartureId = modal.querySelector("#departureId");
    if (!editForm || !inputDepartureId) {
        console.error("Faltan el formulario o campos de entrada en el modal de edición");
        return;
    }
    const editUrlTemplate = editForm.dataset.editUrlTemplate;
    if (editUrlTemplate) {
        editForm.action = editUrlTemplate.replace(":id", departureId.toString());
    }
    else {
        console.error("Falta la plantilla de URL de edición en el formulario");
        return;
    }
    inputDepartureId.value = departureId;
    openModal(modal);
};
const handleDetailsDepartureModal = (modal, departureId) => {
    const textDepartureId = modal.querySelector("#departureIdDetails");
    if (!textDepartureId) {
        console.error("Falta el camp de text en el modal de detalles");
        return;
    }
    textDepartureId.textContent = departureId;
    openModal(modal);
};
