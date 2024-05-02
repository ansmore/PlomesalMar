"use strict";
document.addEventListener('DOMContentLoaded', () => {
    const editModal = document.getElementById('editSpeciesModal');
    const deleteModal = document.getElementById('deleteSpeciesModal');
    // Check if either modal is missing in the DOM. If so, log an error and halt further execution.
    if (!editModal || !deleteModal) {
        console.error('One or more modals are missing in the DOM');
        return;
    }
    const buttons = document.querySelectorAll('[data-bs-toggle="modal"]');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const specieId = button.getAttribute('data-id');
            const commonName = button.getAttribute('data-common-name');
            const scientificName = button.getAttribute('data-scientific-name');
            // Check if the necessary data attributes are missing on the button. If so, log an error and stop processing.
            if (!specieId || !commonName || !scientificName) {
                console.error('Missing data attributes on button');
                return;
            }
            // Depending on the target modal, perform different actions:
            if (button.getAttribute('data-bs-target') === '#editSpeciesModal') {
                const editForm = document.getElementById('editSpeciesForm');
                const inputCommonName = document.getElementById('nombreComun');
                const inputScientificName = document.getElementById('nombreCientifico');
                // Check if the form or any necessary input fields are missing in the edit modal. If so, log an error and stop processing.
                if (!editForm || !inputCommonName || !inputScientificName) {
                    console.error('Form or input fields are missing in the edit modal');
                    return;
                }
                // Update the form action and input values with data from the button attributes.
                editForm.action = `/species/${specieId}/update`;
                inputCommonName.value = commonName;
                inputScientificName.value = scientificName;
            }
            else if (button.getAttribute('data-bs-target') === '#deleteSpeciesModal') {
                const deleteForm = document.getElementById('deleteSpeciesForm');
                const textCommonName = document.getElementById('deleteCommonName');
                const textScientificName = document.getElementById('deleteScientificName');
                // Check if the form or any necessary text fields are missing in the delete modal. If so, log an error and stop processing.
                if (!deleteForm || !textCommonName || !textScientificName) {
                    console.error('Form or text fields are missing in the delete modal');
                    return;
                }
                // Update the form action and text fields with data from the button attributes.
                deleteForm.action = `/species/${specieId}/destroy`;
                textCommonName.textContent = commonName;
                textScientificName.textContent = scientificName;
            }
        });
    });
});
