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
	const name = button.getAttribute("data-name");
	const surname = button.getAttribute("data-surname");
	const surnameSecond = button.getAttribute("data-surnameSecond");

	switch (modalId) {
		case "createUser":
			openModal(modal);
			break;

		case "deleteUsersModal":
			if (!userId || !name || surname || surnameSecond) {
				console.error("Faltan atributos de datos");
				return;
			}

			handleDeleteUsersModal(modal, userId, name, surname, surnameSecond);
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

const handleDeleteUsersModal = (
	modal: HTMLDivElement,
	userId: string,
	name: string,
	surname: string,
	surnameSecond: string,
) => {
	const deleteForm = modal.querySelector<HTMLFormElement>("form");
	const textName = modal.querySelector<HTMLElement>("#deleteName");
	const textSurname = modal.querySelector<HTMLElement>("#deleteSurname");
	const textSurnameSecond = modal.querySelector<HTMLElement>(
		"#deleteSurnameSecond",
	);

	if (!deleteForm || !textName || !textSurname || !textSurnameSecond) {
		console.error(
			"Faltan el formulario o campos de texto en el modal de eliminación",
		);
		return;
	}

	const deleteUrlTemplate = deleteForm.dataset.deleteUrlTemplate;
	if (deleteUrlTemplate) {
		deleteForm.action = deleteUrlTemplate.replace(":id", userId.toString());
	} else {
		console.error("Falta la plantilla de URL de eliminación en el formulario");
		return;
	}

	textName.textContent = name;
	textSurname.textContent = surname;
	textSurnameSecond.textContent = surnameSecond;
	openModal(modal);
};
