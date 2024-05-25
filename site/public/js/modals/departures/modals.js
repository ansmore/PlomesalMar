export const setupModalEventListenersDepartures = () => {
    console.log("Setting up modal event listeners for departures.");
    const buttons = document.querySelectorAll('[data-bs-toggle="modal"]');
    buttons.forEach((button) => {
        console.log("Adding event listener to button:", button);
        button.removeEventListener("click", handleModalButtonClick);
        button.addEventListener("click", handleModalButtonClick);
    });
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach((button) => {
        console.log("Adding event listener to close button:", button);
        button.removeEventListener("click", closeModalButtonClick);
        button.addEventListener("click", closeModalButtonClick);
    });
};
export const cleanupDepartures = () => {
    console.log("Cleaning up modal event listeners for departures.");
    const buttons = document.querySelectorAll('[data-bs-toggle="modal"]');
    buttons.forEach((button) => {
        console.log("Removing event listener from button:", button);
        button.removeEventListener("click", handleModalButtonClick);
    });
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach((button) => {
        console.log("Removing event listener from close button:", button);
        button.removeEventListener("click", closeModalButtonClick);
    });
};
const handleModalButtonClick = (event) => {
    console.log("Modal button clicked.");
    const button = event.currentTarget;
    const modalId = button.getAttribute("data-bs-target");
    console.log("Modal ID:", modalId);
    if (!modalId) {
        console.error("No se encontró el ID del modal en el botón:", button);
        return;
    }
    const modal = document.getElementById(modalId);
    if (!modal) {
        console.error("No se encontró el elemento modal para el objetivo:", modalId);
        return;
    }
    console.log("Found modal element:", modal);
    const departureId = button.getAttribute("data-id");
    const departureName = button.getAttribute("data-name");
    const boatId = button.getAttribute("data-boat-id");
    const transectId = button.getAttribute("data-transect-id");
    const date = button.getAttribute("data-date");
    const observers = button.getAttribute("data-observers")?.split(',').map(name => name.trim()) || [];
    console.log("Button data attributes:", { departureId, departureName, boatId, transectId, date, observers });
    switch (modalId) {
        case "createDeparture":
            openModal(modal);
            break;
        case "editDepartureModal":
            if (!departureId || !boatId || !transectId || !date) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleEditDepartureModal(modal, departureId, boatId, transectId, date, observers);
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
    console.log("Close modal button clicked.");
    const button = event.currentTarget;
    const modal = button.closest(".modal");
    if (modal) {
        modal.style.display = "none";
        console.log("Modal closed:", modal.id);
    }
};
const openModal = (modal) => {
    modal.style.display = "block";
    console.log("Modal opened:", modal.id);
};
const handleEditDepartureModal = (modal, departureId, boatId, transectId, date, observers) => {
    console.log("Handling edit departure modal.");
    const editForm = modal.querySelector("form");
    const inputBoatId = modal.querySelector("#edit_boat_id");
    const inputTransectId = modal.querySelector("#edit_transect_id");
    const inputDate = modal.querySelector("#edit_date");
    const checkboxes = modal.querySelectorAll("#edit_users input[type='checkbox']");
    if (!editForm || !inputBoatId || !inputTransectId || !inputDate) {
        console.error("Faltan el formulario o campos de entrada en el modal de edición");
        return;
    }
    const editUrlTemplate = editForm.dataset.editUrlTemplate;
    if (editUrlTemplate) {
        editForm.action = editUrlTemplate.replace(":id", departureId.toString());
        console.log("Form action set to:", editForm.action);
    }
    else {
        console.error("Falta la plantilla de URL de edición en el formulario");
        return;
    }
    inputBoatId.value = boatId;
    inputTransectId.value = transectId;
    inputDate.value = date;
    console.log("Form inputs set:", { boatId: inputBoatId.value, transectId: inputTransectId.value, date: inputDate.value });
    checkboxes.forEach(checkbox => {
        checkbox.checked = observers.includes(checkbox.nextElementSibling?.textContent?.trim() || '');
        console.log("Checkbox set:", { checkboxId: checkbox.id, checked: checkbox.checked });
    });
    openModal(modal);
};
const handleDetailsDepartureModal = (modal, departureId) => {
    console.log("Handling details departure modal.");
    const textDepartureId = modal.querySelector("#departureIdDetails");
    if (!textDepartureId) {
        console.error("Falta el camp de text en el modal de detalles");
        return;
    }
    textDepartureId.textContent = departureId;
    console.log("Text departure ID set to:", departureId);
    openModal(modal);
};
