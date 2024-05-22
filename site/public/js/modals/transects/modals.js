export const setupModalEventListenersTransects = () => {
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
export const cleanupTransects = () => {
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
    const transectId = button.getAttribute("data-id");
    const transectName = button.getAttribute("data-name");
    switch (modalId) {
        case "createTransect":
            openModal(modal);
            break;
        case "editTransectModal":
            if (!transectId || !transectName) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleEditTransectModal(modal, transectId, transectName);
            break;
        case "detailsTransectModal":
            if (!transectId || !transectName) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleDetailsTransectModal(modal, transectId, transectName);
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
const handleEditTransectModal = (modal, transectId, transectName) => {
    const editForm = modal.querySelector("form");
    const inputTransectName = modal.querySelector("#transectName");
    if (!editForm || !inputTransectName) {
        console.error("Faltan el formulario o campos de entrada en el modal de edición");
        return;
    }
    const editUrlTemplate = editForm.dataset.editUrlTemplate;
    if (editUrlTemplate) {
        editForm.action = editUrlTemplate.replace(":id", transectId.toString());
    }
    else {
        console.error("Falta la plantilla de URL de edición en el formulario");
        return;
    }
    inputTransectName.value = transectName;
    openModal(modal);
};
const handleDetailsTransectModal = (modal, transectId, transectName) => {
    const deleteForm = modal.querySelector("form");
    const textTransectId = modal.querySelector("#deleteTransectId");
    const textTransectName = modal.querySelector("#deleteTransectName");
    if (!deleteForm || !textTransectId || !textTransectName) {
        console.error("Faltan el formulario o campos de texto en el modal de eliminación");
        return;
    }
    const deleteUrlTemplate = deleteForm.dataset.deleteUrlTemplate;
    if (deleteUrlTemplate) {
        deleteForm.action = deleteUrlTemplate.replace(":id", transectId.toString());
    }
    else {
        console.error("Falta la plantilla de URL de eliminación en el formulario");
        return;
    }
    textTransectName.textContent = transectName;
    openModal(modal);
};
