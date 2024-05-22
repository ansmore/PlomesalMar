export const setupModalEventListenersBoats = () => {
	const buttons = document.querySelectorAll<HTMLButtonElement>(
		'[data-bs-toggle="modal"]',
	);

	buttons.forEach((button) => {
		button.removeEventListener("click", handleModalButtonClick);
		button.addEventListener("click", handleModalButtonClick);
	});

	document
		.querySelectorAll<HTMLElement>('[data-bs-dismiss="modal"]')
		.forEach((button) => {
			button.removeEventListener("click", closeModalButtonClick);
			button.addEventListener("click", closeModalButtonClick);
		});
};

export const cleanupBoats = () => {
	const buttons = document.querySelectorAll<HTMLButtonElement>(
		'[data-bs-toggle="modal"]',
	);
	buttons.forEach((button) => {
		button.removeEventListener("click", handleModalButtonClick);
	});

	document
		.querySelectorAll<HTMLElement>('[data-bs-dismiss="modal"]')
		.forEach((button) => {
			button.removeEventListener("click", closeModalButtonClick);
		});
};

const handleModalButtonClick = (event: Event) => {
	const button = event.currentTarget as HTMLButtonElement;
	const modalId = button.getAttribute("data-bs-target");

	if (!modalId) {
		console.error("No se encontró el ID del modal en el botón:", button);
		return;
	}

	const modal = document.getElementById(modalId) as HTMLDivElement;
	if (!modal) {
		console.error(
			"No se encontró el elemento modal para el objetivo:",
			modalId,
		);
		return;
	}

	const boatId = button.getAttribute("data-id");
	const boatName = button.getAttribute("data-name");
	const registrationNumber = button.getAttribute("data-registration-number");

	switch (modalId) {
		case "createBoat":
			openModal(modal);
			break;

		case "editBoatModal":
			if (!boatId || !boatName || !registrationNumber) {
				console.error("Faltan atributos de datos");
				return;
			}

			handleEditBoatModal(modal, boatId, boatName, registrationNumber);
			break;

		case "deleteBoatModal":
			if (!boatId || !boatName || !registrationNumber) {
				console.error("Faltan atributos de datos");
				return;
			}

			handleDeleteBoatModal(modal, boatId, boatName, registrationNumber);
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
	}
};

const openModal = (modal: HTMLDivElement) => {
	modal.style.display = "block";
};

const handleEditBoatModal = (
	modal: HTMLDivElement,
	boatId: string,
	boatName: string,
	registrationNumber: string,
) => {
	const editForm = modal.querySelector<HTMLFormElement>("form");
	const inputBoatName = modal.querySelector<HTMLInputElement>("#boatName");
	const inputRegistrationNumber = modal.querySelector<HTMLInputElement>(
		"#registrationNumber",
	);

	if (!editForm || !inputBoatName || !inputRegistrationNumber) {
		console.error(
			"Faltan el formulario o campos de entrada en el modal de edición",
		);
		return;
	}

	const editUrlTemplate = editForm.dataset.editUrlTemplate;
	if (editUrlTemplate) {
		editForm.action = editUrlTemplate.replace(":id", boatId.toString());
	} else {
		console.error("Falta la plantilla de URL de edición en el formulario");
		return;
	}

	inputBoatName.value = boatName;
	inputRegistrationNumber.value = registrationNumber;
	openModal(modal);
};

const handleDeleteBoatModal = (
	modal: HTMLDivElement,
	boatId: string,
	boatName: string,
	registrationNumber: string,
) => {
	const deleteForm = modal.querySelector<HTMLFormElement>("form");
	const textBoatName = modal.querySelector<HTMLElement>("#deleteBoatName");
	const textRegistrationNumber = modal.querySelector<HTMLElement>(
		"#deleteRegistrationNumber",
	);

	if (!deleteForm || !textBoatName || !textRegistrationNumber) {
		console.error(
			"Faltan el formulario o campos de texto en el modal de eliminación",
		);
		return;
	}

	const deleteUrlTemplate = deleteForm.dataset.deleteUrlTemplate;
	if (deleteUrlTemplate) {
		deleteForm.action = deleteUrlTemplate.replace(":id", boatId.toString());
	} else {
		console.error("Falta la plantilla de URL de eliminación en el formulario");
		return;
	}

	textBoatName.textContent = boatName;
	textRegistrationNumber.textContent = registrationNumber;
	openModal(modal);
};
