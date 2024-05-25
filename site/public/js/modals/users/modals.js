export const setupModalEventListenersUsers = () => {
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
export const cleanupUsers = () => {
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
    const userId = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const email = button.getAttribute("data-email");
    switch (modalId) {
        case "createUser":
            openModal(modal);
            break;
        case "deleteUsersModal":
            if (!userId || !name || !email) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleDeleteUsersModal(modal, userId, name, email);
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
const handleDeleteUsersModal = (modal, userId, name, email) => {
    const deleteForm = modal.querySelector("form");
    const textName = modal.querySelector("#deleteName");
    const textEmail = modal.querySelector("#deleteEmail");
    if (!deleteForm || !textName || !textEmail) {
        console.error("Faltan el formulario o campos de texto en el modal de eliminación");
        return;
    }
    const deleteUrlTemplate = deleteForm.dataset.deleteUrlTemplate;
    if (deleteUrlTemplate) {
        deleteForm.action = deleteUrlTemplate.replace(":id", userId.toString());
    }
    else {
        console.error("Falta la plantilla de URL de eliminación en el formulario");
        return;
    }
    textEmail.textContent = email;
    textName.textContent = name;
    openModal(modal);
};
