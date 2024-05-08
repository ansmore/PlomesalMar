export const setupModalEventListenersBoats = () => {
    const buttons = document.querySelectorAll('[data-bs-toggle="modal"]');
    buttons.forEach(button => {
        button.removeEventListener('click', handleModalButtonClick);
        button.addEventListener('click', handleModalButtonClick);
    });
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
        button.removeEventListener('click', closeModalButtonClick);
        button.addEventListener('click', closeModalButtonClick);
    });
};
export const cleanupBoats = () => {
    const buttons = document.querySelectorAll('[data-bs-toggle="modal"]');
    buttons.forEach(button => {
        button.removeEventListener('click', handleModalButtonClick);
    });
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
        button.removeEventListener('click', closeModalButtonClick);
    });
};
const handleModalButtonClick = (event) => {
    const button = event.currentTarget;
    const modalId = button.getAttribute('data-bs-target');
    if (!modalId) {
        console.error('No se encontró el ID del modal en el botón:', button);
        return;
    }
    const modal = document.getElementById(modalId);
    if (!modal) {
        console.error('No se encontró el elemento modal para el objetivo:', modalId);
        return;
    }
    const boatId = button.getAttribute('data-id');
    const boatName = button.getAttribute('data-name');
    const registrationNumber = button.getAttribute('data-registration-number');
    switch (modalId) {
        case 'createBoat':
            openModal(modal);
            break;
        case 'editBoatModal':
            if (!boatId || !boatName || !registrationNumber) {
                console.error('Faltan atributos de datos');
                return;
            }
            handleEditBoatModal(modal, boatId, boatName, registrationNumber);
            break;
        case 'deleteBoatModal':
            if (!boatId || !boatName || !registrationNumber) {
                console.error('Faltan atributos de datos');
                return;
            }
            handleDeleteBoatModal(modal, boatId, boatName, registrationNumber);
            break;
        default:
            console.error('Objetivo del modal desconocido:', modalId);
            break;
    }
};
const closeModalButtonClick = (event) => {
    const button = event.currentTarget;
    const modal = button.closest('.modal');
    if (modal) {
        modal.style.display = 'none';
    }
};
const openModal = (modal) => {
    modal.style.display = 'block';
};
const handleEditBoatModal = (modal, boatId, boatName, registrationNumber) => {
    const editForm = modal.querySelector('form');
    const inputBoatName = modal.querySelector('#boatName');
    const inputRegistrationNumber = modal.querySelector('#registrationNumber');
    if (!editForm || !inputBoatName || !inputRegistrationNumber) {
        console.error('Faltan el formulario o campos de entrada en el modal de edición');
        return;
    }
    const editUrlTemplate = editForm.dataset.editUrlTemplate;
    if (editUrlTemplate) {
        editForm.action = editUrlTemplate.replace(':id', boatId);
    }
    else {
        console.error('Falta la plantilla de URL de edición en el formulario');
        return;
    }
    inputBoatName.value = boatName;
    inputRegistrationNumber.value = registrationNumber;
    openModal(modal);
};
const handleDeleteBoatModal = (modal, boatId, boatName, registrationNumber) => {
    const deleteForm = modal.querySelector('form');
    const textBoatName = modal.querySelector('#deleteBoatName');
    const textRegistrationNumber = modal.querySelector('#deleteRegistrationNumber');
    if (!deleteForm || !textBoatName || !textRegistrationNumber) {
        console.error('Faltan el formulario o campos de texto en el modal de eliminación');
        return;
    }
    const deleteUrlTemplate = deleteForm.dataset.deleteUrlTemplate;
    if (deleteUrlTemplate) {
        deleteForm.action = deleteUrlTemplate.replace(':id', boatId);
    }
    else {
        console.error('Falta la plantilla de URL de eliminación en el formulario');
        return;
    }
    textBoatName.textContent = boatName;
    textRegistrationNumber.textContent = registrationNumber;
    openModal(modal);
};
