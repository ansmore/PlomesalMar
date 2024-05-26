document.addEventListener('DOMContentLoaded', () => {
    setupModalEventListenersDepartures();
});

export const setupModalEventListenersDepartures = (): void => {
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

export const cleanupDepartures = (): void => {
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
    const modal = document.querySelector(`[id=${modalId}]`);
    if (!modal || !(modal instanceof HTMLElement)) {
        console.error("No se encontró el elemento modal para el objetivo:", modalId);
        return;
    }

    const departureId = button.getAttribute("data-id");
    const departureName = button.getAttribute("data-name");
    const boatId = button.getAttribute("data-boat-id");
    const boatName = button.getAttribute("data-boat-name");
    const transectId = button.getAttribute("data-transect-id");
    const transectName = button.getAttribute("data-transect-name");
    const date = button.getAttribute("data-date");
    const observers = button.getAttribute("data-observers")?.split(',').map(name => name.trim()) || [];

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
            if (!departureId || !boatName || !transectName || !date || !observers) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleDetailsDepartureModal(modal, departureId, boatName, transectName, date, observers);
            break;
        case "deleteDepartureModal":
            if (!departureId || !departureName) {
                console.error("Faltan atributos de datos");
                return;
            }
            handleDeleteDepartureModal(modal, departureId, departureName);
            break;
        default:
            console.error("Objetivo del modal desconocido:", modalId);
            break;
    }
};

const closeModalButtonClick = (event: Event): void => {
    const button = event.currentTarget as HTMLButtonElement;
    const modal = button.closest(".modal") as HTMLElement;
    if (modal) {
        modal.style.display = "none";
    }
};

const openModal = (modal: HTMLElement): void => {
    modal.style.display = "block";
};

const handleEditDepartureModal = (
    modal: HTMLElement, 
    departureId: string, 
    boatId: string, 
    transectId: string, 
    date: string, 
    observers: string[]
): void => {
    const editForm = modal.querySelector<HTMLFormElement>("form");
    const inputBoatId = modal.querySelector<HTMLSelectElement>("#edit_boat_id");
    const inputTransectId = modal.querySelector<HTMLSelectElement>("#edit_transect_id");
    const inputDate = modal.querySelector<HTMLInputElement>("#edit_date");
    const checkboxes = modal.querySelectorAll<HTMLInputElement>("#edit_users input[type='checkbox']");

    if (!editForm || !inputBoatId || !inputTransectId || !inputDate) {
        console.error("Faltan el formulario o campos de entrada en el modal de edición");
        return;
    }

    const editUrlTemplate = editForm.dataset.editUrlTemplate;
    if (editUrlTemplate) {
        editForm.action = editUrlTemplate.replace(":id", departureId.toString());
    } else {
        console.error("Falta la plantilla de URL de edición en el formulario");
        return;
    }

    inputBoatId.value = boatId;
    inputTransectId.value = transectId;
    inputDate.value = date;

    checkboxes.forEach(checkbox => {
        checkbox.checked = observers.includes(checkbox.nextElementSibling?.textContent?.trim() || '');
    });

    openModal(modal);
};

const handleDetailsDepartureModal = (
    modal: HTMLElement, 
    departureId: string, 
    boatName: string, 
    transectName: string, 
    date: string, 
    observers: string[]
): void => {
    const detailsBoatName = modal.querySelector<HTMLElement>("#details_boat_name");
    const detailsTransectName = modal.querySelector<HTMLElement>("#details_transect_name");
    const detailsDate = modal.querySelector<HTMLElement>("#details_date");
    const detailsObservers = modal.querySelector<HTMLUListElement>("#details_observers");

    if (!detailsBoatName || !detailsTransectName || !detailsDate || !detailsObservers) {
        console.error("Faltan campos de texto en el modal de detalles");
        return;
    }

    detailsBoatName.textContent = boatName;
    detailsTransectName.textContent = transectName;
    detailsDate.textContent = date;

    detailsObservers.innerHTML = '';

    observers.forEach(observer => {
        const li = document.createElement('li');
        li.textContent = observer;
        detailsObservers.appendChild(li);
    });

    openModal(modal);
};

const handleDeleteDepartureModal = (modal: HTMLElement, departureId: string, departureName: string): void => {
    const deleteForm = modal.querySelector<HTMLFormElement>("form");
    const textDepartureName = modal.querySelector<HTMLElement>("#deleteDepartureName");

    if (!deleteForm || !textDepartureName) {
        console.error("Faltan el formulario o campos de texto en el modal de eliminación");
        return;
    }

    const actionTemplate = deleteForm.dataset.actionTemplate;
    if (actionTemplate) {
        deleteForm.action = actionTemplate.replace(":id", departureId.toString());
    } else {
        console.error("Falta la plantilla de URL de eliminación en el formulario");
        return;
    }

    textDepartureName.textContent = departureName;

    openModal(modal);
};
