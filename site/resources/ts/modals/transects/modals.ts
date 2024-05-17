export const setupModalEventListenersTransects = () => {
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

export const cleanupTransects = () => {
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

	const transectId = button.getAttribute("data-id");
	const transectName = button.getAttribute("data-name");

	switch (modalId) {
		case "createTransect":
			openModal(modal);
			break;

		case "editTransectModal":
			if (!transectId || !transectName) {
				console.error("Faltan atributos de datos");
				return;
			}

			handleEditTransectModal(modal, transectId, transectName);
			break;

		case "deleteTransectModal":
			if (!transectId || !transectName) {
				console.error("Faltan atributos de datos");
				return;
			}

			handleDeleteTransectModal(modal, transectId, transectName);
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

const handleEditTransectModal = (
	modal: HTMLDivElement,
	transectId: string,
	transectName: string,
) => {
	const editForm = modal.querySelector<HTMLFormElement>("form");
	const inputTransectName =
		modal.querySelector<HTMLInputElement>("#transectName");

	if (!editForm || !inputTransectName) {
		console.error(
			"Faltan el formulario o campos de entrada en el modal de edición",
		);
		return;
	}

	const editUrlTemplate = editForm.dataset.editUrlTemplate;
	if (editUrlTemplate) {
		editForm.action = editUrlTemplate.replace(":id", transectId.toString());
	} else {
		console.error("Falta la plantilla de URL de eliminación en el formulario");
		return;
	}

	inputTransectName.value = transectName;
	openModal(modal);
};

const handleDeleteTransectModal = (
	modal: HTMLDivElement,
	transectId: string,
	transectName: string,
) => {
	const deleteForm = modal.querySelector<HTMLFormElement>("form");
	const textTransectName = modal.querySelector<HTMLElement>(
		"#deleteTransectName",
	);

	if (!deleteForm || !textTransectName) {
		console.error(
			"Faltan el formulario o campos de texto en el modal de eliminación",
		);
		return;
	}

	const deleteUrlTemplate = deleteForm.dataset.deleteUrlTemplate;
	if (deleteUrlTemplate) {
		deleteForm.action = deleteUrlTemplate.replace(":id", transectId.toString());
	} else {
		console.error("Falta la plantilla de URL de eliminación en el formulario");
		return;
	}

	textTransectName.textContent = transectName;
	openModal(modal);
};