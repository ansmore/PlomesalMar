export const setupModalEventListenersDepartures = () => {
	console.log("Setting up modal event listeners for departures.");
	const buttons = document.querySelectorAll<HTMLButtonElement>('[data-bs-toggle="modal"]');

	buttons.forEach((button) => {
		button.removeEventListener("click", handleModalButtonClick);
		button.addEventListener("click", handleModalButtonClick);
	});

	document.querySelectorAll<HTMLElement>('[data-bs-dismiss="modal"]').forEach((button) => {
		button.removeEventListener("click", closeModalButtonClick);
		button.addEventListener("click", closeModalButtonClick);
	});
};

export const cleanupDepartures = () => {
	console.log("Cleaning up modal event listeners for departures.");
	const buttons = document.querySelectorAll<HTMLButtonElement>('[data-bs-toggle="modal"]');
	buttons.forEach((button) => {
		button.removeEventListener("click", handleModalButtonClick);
	});

	document.querySelectorAll<HTMLElement>('[data-bs-dismiss="modal"]').forEach((button) => {
		button.removeEventListener("click", closeModalButtonClick);
	});
};

const handleModalButtonClick = (event: Event) => {
	const button = event.currentTarget as HTMLButtonElement;
	const modalId = button.getAttribute("data-bs-target");
	console.log("Modal button clicked. Modal ID:", modalId);

	if (!modalId) {
		console.error("No se encontró el ID del modal en el botón:", button);
		return;
	}

	const modal = document.getElementById(modalId) as HTMLDivElement;
	if (!modal) {
		console.error("No se encontró el elemento modal para el objetivo:", modalId);
		return;
	}

	const departureId = button.getAttribute("data-id");
	const boatId = button.getAttribute("data-boat-id");
	const transectId = button.getAttribute("data-transect-id");
	const date = button.getAttribute("data-date");
	const observers = button.getAttribute("data-observers")?.split(',').map(Number) || [];
	console.log("Modal data attributes:", { departureId, boatId, transectId, date, observers });

	switch (modalId.substring(1)) {
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

const closeModalButtonClick = (event: Event) => {
	const button = event.currentTarget as HTMLElement;
	const modal = button.closest(".modal") as HTMLDivElement;
	if (modal) {
		modal.style.display = "none";
		console.log("Modal closed:", modal.id);
	}
};

const openModal = (modal: HTMLDivElement) => {
	modal.style.display = "block";
	console.log("Modal opened:", modal.id);
};

const handleEditDepartureModal = (
	modal: HTMLDivElement,
	departureId: string,
	boatId: string,
	transectId: string,
	date: string,
	observers: number[],
) => {
	console.log("Handling edit departure modal. Data:", { departureId, boatId, transectId, date, observers });

	const editForm = modal.querySelector<HTMLFormElement>("form");
	const inputBoatId = modal.querySelector<HTMLSelectElement>("edit_boat_id");
	const inputTransectId = modal.querySelector<HTMLSelectElement>("edit_transect_id");
	const inputDate = modal.querySelector<HTMLInputElement>("edit_date");
	const checkboxes = modal.querySelectorAll<HTMLInputElement>("edit_users input[type='checkbox']");

	if (!editForm || !inputBoatId || !inputTransectId || !inputDate) {
		console.error("Faltan el formulario o campos de entrada en el modal de edición");
		return;
	}

	const editUrlTemplate = editForm.dataset.editUrlTemplate;
	if (editUrlTemplate) {
		editForm.action = editUrlTemplate.replace(":id", departureId.toString());
		console.log("Form action set to:", editForm.action);
	} else {
		console.error("Falta la plantilla de URL de edición en el formulario");
		return;
	}

	inputBoatId.value = boatId;
	inputTransectId.value = transectId;
	inputDate.value = date;
	console.log("Form inputs set:", { boatId: inputBoatId.value, transectId: inputTransectId.value, date: inputDate.value });

	checkboxes.forEach(checkbox => {
		checkbox.checked = observers.includes(parseInt(checkbox.value));
		console.log("Checkbox set:", { checkboxId: checkbox.id, checked: checkbox.checked });
	});

	openModal(modal);
};

const handleDetailsDepartureModal = (
	modal: HTMLDivElement,
	departureId: string,
) => {
	console.log("Handling details departure modal. Departure ID:", departureId);

	const textDepartureId = modal.querySelector<HTMLElement>("departureIdDetails");

	if (!textDepartureId) {
		console.error("Falta el campo de texto en el modal de detalles");
		return;
	}

	textDepartureId.textContent = departureId;
	openModal(modal);
};
