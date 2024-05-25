export const setupModalEventListenersUsers = () => {
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

export const cleanupUsers = () => {
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

	const userId = button.getAttribute("data-id");
	const name = button.getAttribute("data-common-name");
	const email = button.getAttribute("data-scientific-name");

	switch (modalId) {
		case "createUser":
			openModal(modal);
			break;

		// case "editUserModal":
		// 	if (!userId || !name || !email) {
		// 		console.error("Faltan atributos de datos");
		// 		return;
		// 	}

		// 	handleeditUserModal(modal, userId, name, email);
		// 	break;

		// case "deleteUserModal":
		// 	if (!userId || !name || !email) {
		// 		console.error("Faltan atributos de datos");
		// 		return;
		// 	}

		// 	handleDeleteUserModal(modal, userId, name, email);
		// 	break;

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

// const handleeditUserModal = (
// 	modal: HTMLDivElement,
// 	userId: string,
// 	name: string,
// 	email: string,
// ) => {
// 	const editForm = modal.querySelector<HTMLFormElement>("form");
// 	const inputCommonName = modal.querySelector<HTMLInputElement>("#nombreComun");
// 	const inputScientificName =
// 		modal.querySelector<HTMLInputElement>("#nombreCientifico");

// 	if (!editForm || !inputCommonName || !inputScientificName) {
// 		console.error(
// 			"Faltan el formulario o campos de entrada en el modal de edición",
// 		);
// 		return;
// 	}

// 	const editUrlTemplate = editForm.dataset.editUrlTemplate;
// 	if (editUrlTemplate) {
// 		editForm.action = editUrlTemplate.replace(":id", userId.toString());
// 	} else {
// 		console.error("Falta la plantilla de URL de eliminación en el formulario");
// 		return;
// 	}

// 	// console.log("URL de eliminación configurada:", editForm.action);
// 	inputCommonName.value = name;
// 	inputScientificName.value = email;
// 	openModal(modal);
// };

// const handleDeleteUserModal = (
// 	modal: HTMLDivElement,
// 	userId: string,
// 	name: string,
// 	email: string,
// ) => {
// 	const deleteForm = modal.querySelector<HTMLFormElement>("form");
// 	const textCommonName = modal.querySelector<HTMLElement>("#deleteCommonName");
// 	const textScientificName = modal.querySelector<HTMLElement>(
// 		"#deleteScientificName",
// 	);

// 	if (!deleteForm || !textCommonName || !textScientificName) {
// 		console.error(
// 			"Faltan el formulario o campos de texto en el modal de eliminación",
// 		);
// 		return;
// 	}

// 	const deleteUrlTemplate = deleteForm.dataset.deleteUrlTemplate;
// 	if (deleteUrlTemplate) {
// 		deleteForm.action = deleteUrlTemplate.replace(":id", userId.toString());
// 	} else {
// 		console.error("Falta la plantilla de URL de eliminación en el formulario");
// 		return;
// 	}

// 	textCommonName.textContent = name;
// 	textScientificName.textContent = email;
// 	openModal(modal);
// };
