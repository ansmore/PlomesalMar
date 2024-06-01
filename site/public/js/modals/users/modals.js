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
        console.error("No s'ha trobat l'ID del modal al botó:", button);
        return;
    }
    const modal = document.getElementById(modalId);
    if (!modal) {
        console.error("No s'ha trobat l'element modal per a l'objectiu:", modalId);
        return;
    }
    const userId = button.getAttribute("data-id");
    const name = button.getAttribute("data-name");
    const surname = button.getAttribute("data-surname") ?? undefined;
    const surnameSecond = button.getAttribute("data-surnameSecond") ?? undefined;
    const email = button.getAttribute("data-email");
    const userModalData = {
        modal,
        userId: userId,
        name: name,
        email: email,
        surname,
        surnameSecond,
    };
    switch (modalId) {
        case "createUser":
            openModal(modal);
            break;
        case "editUsersModal":
            if (!userId || !name || !email) {
                console.error("Falten atributs de dades");
                return;
            }
            handleEditUsersModal(userModalData);
            break;
        case "deleteUsersModal":
            if (!userId || !name) {
                console.error("Falten atributs de dades");
                return;
            }
            handleDeleteUsersModal(userModalData);
            break;
        default:
            console.error("Objectiu del modal desconegut:", modalId);
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
const handleEditUsersModal = ({ modal, userId, name, email, surname, surnameSecond, }) => {
    const editForm = modal.querySelector("form");
    const inputUserId = modal.querySelector("#edit_user_id");
    const inputUserName = modal.querySelector("#edit_user_name");
    const inputUserSurname = modal.querySelector("#edit_user_surname");
    const inputUserSurnameSecond = modal.querySelector("#edit_user_surnameSecond");
    const inputUserEmail = modal.querySelector("#edit_user_email");
    if (!editForm || !inputUserName || !inputUserEmail) {
        console.error("Falten el formulari o camps d'entrada en el modal d'edició");
        return;
    }
    const editUrlTemplate = editForm.dataset.editUrlTemplate;
    if (editUrlTemplate) {
        editForm.action = editUrlTemplate.replace(":id", userId.toString());
    }
    else {
        console.error("Falta la plantilla de URL d'edició en el formulari");
        return;
    }
    if (inputUserId) {
        inputUserId.value = userId;
    }
    inputUserName.value = name;
    inputUserEmail.value = email;
    if (inputUserSurname) {
        inputUserSurname.value = surname ?? "";
    }
    if (inputUserSurnameSecond) {
        inputUserSurnameSecond.value = surnameSecond ?? "";
    }
    openModal(modal);
};
const handleDeleteUsersModal = ({ modal, userId, name, surname, surnameSecond, }) => {
    const deleteForm = modal.querySelector("form");
    const textName = modal.querySelector("#deleteName");
    const textSurname = modal.querySelector("#deleteSurname");
    const textSurnameSecond = modal.querySelector("#deleteSurnameSecond");
    if (!deleteForm || !textName) {
        console.error("Falten el formulari o camps de text en el modal d'eliminació");
        return;
    }
    const deleteUrlTemplate = deleteForm.dataset.deleteUrlTemplate;
    if (deleteUrlTemplate) {
        deleteForm.action = deleteUrlTemplate.replace(":id", userId.toString());
    }
    else {
        console.error("Falta la plantilla de URL d'eliminació en el formulari");
        return;
    }
    textName.textContent = name;
    if (textSurname) {
        textSurname.textContent = surname ?? "";
    }
    if (textSurnameSecond) {
        textSurnameSecond.textContent = surnameSecond ?? "";
    }
    openModal(modal);
};
