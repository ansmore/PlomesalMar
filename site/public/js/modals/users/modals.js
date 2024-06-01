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
    console.log("Modal ID encontrado:", modalId);
    const modal = document.getElementById(modalId);
    if (!modal) {
        console.error("No se encontró el elemento modal para el objetivo:", modalId);
        return;
    }
    console.log("Modal encontrado:", modal);
    const userId = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const surname = button.getAttribute("data-surname") !== null
        ? button.getAttribute("data-surname")
        : undefined;
    const surnameSecond = button.getAttribute("data-surnameSecond") !== null
        ? button.getAttribute("data-surnameSecond")
        : undefined;
    const email = button.getAttribute("data-email");
    console.log("Datos del usuario obtenidos:", {
        userId,
        name,
        surname,
        surnameSecond,
        email,
    });
    switch (modalId) {
        case "createUser":
            openModal(modal);
            break;
        case "editUsersModal":
            if (!userId || !name || !email) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleEditUsersModal(modal, userId, name, email, surname, surnameSecond);
            break;
        case "deleteUsersModal":
            if (!userId || !name) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleDeleteUsersModal(modal, userId, name);
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
    console.log("Abriendo modal:", modal);
    modal.style.display = "block";
};
const handleEditUsersModal = (modal, userId, name, email, surname, surnameSecond) => {
    const editForm = modal.querySelector("form");
    const inputUserId = modal.querySelector("#edit_user_id");
    const inputUserName = modal.querySelector("#edit_user_name");
    const inputUserSurname = modal.querySelector("#edit_user_surname");
    const inputUserSurnameSecond = modal.querySelector("#edit_user_surnameSecond");
    const inputUserEmail = modal.querySelector("#edit_user_email");
    console.log("Elementos del formulario encontrados:", {
        editForm,
        inputUserId,
        inputUserName,
        inputUserSurname,
        inputUserSurnameSecond,
        inputUserEmail,
    });
    if (!editForm || !inputUserName || !inputUserEmail) {
        console.error("Faltan el formulario o campos de entrada en el modal de edición");
        return;
    }
    const editUrlTemplate = editForm.dataset.editUrlTemplate;
    if (editUrlTemplate) {
        editForm.action = editUrlTemplate.replace(":id", userId.toString());
    }
    else {
        console.error("Falta la plantilla de URL de edición en el formulario");
        return;
    }
    if (inputUserId) {
        inputUserId.value = userId;
    }
    inputUserName.value = name;
    inputUserEmail.value = email;
    if (inputUserSurname) {
        inputUserSurname.value = surname || "";
    }
    if (inputUserSurnameSecond) {
        inputUserSurnameSecond.value = surnameSecond || "";
    }
    console.log("Datos asignados al formulario:", {
        userId,
        name,
        email,
        surname,
        surnameSecond,
    });
    openModal(modal);
};
const handleDeleteUsersModal = (modal, userId, name, surname, surnameSecond) => {
    const deleteForm = modal.querySelector("form");
    const textName = modal.querySelector("#deleteName");
    const textSurname = modal.querySelector("#deleteSurname");
    const textSurnameSecond = modal.querySelector("#deleteSurnameSecond");
    if (!deleteForm || !textName) {
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
    textName.textContent = name;
    if (textSurname) {
        textSurname.textContent = surname || "";
    }
    if (textSurnameSecond) {
        textSurnameSecond.textContent = surnameSecond || "";
    }
    openModal(modal);
};
