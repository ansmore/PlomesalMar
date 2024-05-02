document.addEventListener('DOMContentLoaded', () => {
    setupModalEventListeners();
});
export const setupModalEventListeners = () => {
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
    if (modalId === 'createSpecies') {
        openModal(modal);
        return;
    }
    const specieId = button.getAttribute('data-id');
    const commonName = button.getAttribute('data-common-name');
    const scientificName = button.getAttribute('data-scientific-name');
    if (!specieId || !commonName || !scientificName) {
        console.error('Faltan atributos de datos');
        return;
    }
    switch (modalId) {
        case 'editSpeciesModal':
            handleEditSpeciesModal(modal, specieId, commonName, scientificName);
            break;
        case 'deleteSpeciesModal':
            handleDeleteSpeciesModal(modal, specieId, commonName, scientificName);
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
    if (modal.classList.contains('modal-delete') || modal.classList.contains('modal-create')) {
        modal.style.display = 'flex';
    }
    else {
        modal.style.display = 'block';
    }
};
const handleEditSpeciesModal = (modal, specieId, commonName, scientificName) => {
    const editForm = modal.querySelector('form');
    const inputCommonName = modal.querySelector('#nombreComun');
    const inputScientificName = modal.querySelector('#nombreCientifico');
    if (!editForm || !inputCommonName || !inputScientificName) {
        console.error('Faltan el formulario o campos de entrada en el modal de edición');
        return;
    }
    editForm.action = `/species/${specieId}?_method=PUT`;
    inputCommonName.value = commonName;
    inputScientificName.value = scientificName;
    openModal(modal);
};
const handleDeleteSpeciesModal = (modal, specieId, commonName, scientificName) => {
    const deleteForm = modal.querySelector('form');
    const textCommonName = modal.querySelector('#deleteCommonName');
    const textScientificName = modal.querySelector('#deleteScientificName');
    if (!deleteForm || !textCommonName || !textScientificName) {
        console.error('Faltan el formulario o campos de texto en el modal de eliminación');
        return;
    }
    deleteForm.action = `/species/${specieId}?_method=DELETE`;
    textCommonName.textContent = commonName;
    textScientificName.textContent = scientificName;
    openModal(modal);
};
