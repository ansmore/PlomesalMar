export const setupModalEventListenersSpecies = () => {
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

export const cleanupSpecies = () => {
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

	const specieId = button.getAttribute("data-id");
	const commonName = button.getAttribute("data-common-name");
	const scientificName = button.getAttribute("data-scientific-name");

	switch (modalId) {
		case "createSpecie":
			openModal(modal);
			break;

		case "editSpecieModal":
			if (!specieId || !commonName || !scientificName) {
				console.error("Faltan atributos de datos");
				return;
			}

			handleeditSpecieModal(modal, specieId, commonName, scientificName);
			break;

		case "deleteSpecieModal":
			if (!specieId || !commonName || !scientificName) {
				console.error("Faltan atributos de datos");
				return;
			}

			handleDeleteSpecieModal(modal, specieId, commonName, scientificName);
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

const handleeditSpecieModal = (
	modal: HTMLDivElement,
	specieId: string,
	commonName: string,
	scientificName: string,
) => {
	const editForm = modal.querySelector<HTMLFormElement>("form");
	const inputCommonName = modal.querySelector<HTMLInputElement>("#nombreComun");
	const inputScientificName =
		modal.querySelector<HTMLInputElement>("#nombreCientifico");

	if (!editForm || !inputCommonName || !inputScientificName) {
		console.error(
			"Faltan el formulario o campos de entrada en el modal de edición",
		);
		return;
	}

	const editUrlTemplate = editForm.dataset.editUrlTemplate;
	if (editUrlTemplate) {
		editForm.action = editUrlTemplate.replace(":id", specieId.toString());
	} else {
		console.error("Falta la plantilla de URL de eliminación en el formulario");
		return;
	}

	// console.log("URL de eliminación configurada:", editForm.action);
	inputCommonName.value = commonName;
	inputScientificName.value = scientificName;
	openModal(modal);
};

const handleDeleteSpecieModal = (
	modal: HTMLDivElement,
	specieId: string,
	commonName: string,
	scientificName: string,
) => {
	const deleteForm = modal.querySelector<HTMLFormElement>("form");
	const textCommonName = modal.querySelector<HTMLElement>("#deleteCommonName");
	const textScientificName = modal.querySelector<HTMLElement>(
		"#deleteScientificName",
	);

	if (!deleteForm || !textCommonName || !textScientificName) {
		console.error(
			"Faltan el formulario o campos de texto en el modal de eliminación",
		);
		return;
	}

	const deleteUrlTemplate = deleteForm.dataset.deleteUrlTemplate;
	if (deleteUrlTemplate) {
		deleteForm.action = deleteUrlTemplate.replace(":id", specieId.toString());
	} else {
		console.error("Falta la plantilla de URL de eliminación en el formulario");
		return;
	}

	textCommonName.textContent = commonName;
	textScientificName.textContent = scientificName;
	openModal(modal);
};
