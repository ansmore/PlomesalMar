export const openModal = (idModalToOpen: string): void => {
	const infoModalBox = document.querySelector(
		`[data-type="${idModalToOpen}"]`,
	) as HTMLElement;

	if (infoModalBox) {
		infoModalBox.style.display = "block";

		closeModalButton();
		closeModalOutside();
	}
};

export const closeModal = (modalId: string): void => {
	const modal = document.getElementById(modalId);

	if (modal) {
		modal.style.display = "none";
		resetImage();
	}
};

export const closeModalButton = (): void => {
	const closeModalButtons = document.querySelectorAll(".close");

	closeModalButtons.forEach((button) => {
		button.addEventListener("click", () => {
			const modal = button.closest(".modal");
			if (modal) {
				closeModal(modal.id);
			}
		});
	});
};

export const closeModalOutside = (): void => {
	document.addEventListener("click", (event: MouseEvent) => {
		const modals = document.querySelectorAll(".modal");
		let clickedInsideModal = false;

		modals.forEach((modal) => {
			const modalBox = modal.querySelectorAll(".modal__box");
			const closeButton = modal.querySelector(".close");
			const modalBodyContent = modal.querySelector(".body");

			if (
				modal instanceof HTMLElement &&
				modal.style.display === "block" &&
				modalBox instanceof HTMLElement &&
				modalBox.contains(event.target as Node) &&
				event.target instanceof HTMLElement &&
				(event.target === closeButton ||
					// Event.target.classList.contains("modal__box") ||
					event.target.id === "modal__box" ||
					(modalBodyContent &&
						(modalBodyContent.contains(event.target as Node) ||
							modalBodyContent.isSameNode(event.target as Node))))
			) {
				clickedInsideModal = true;
			}
		});

		if (!clickedInsideModal) {
			const modalButton = (event.target as HTMLElement).closest(".modal");
			if (modalButton) {
				closeModal(modalButton.id);
			}
		}
	});
};

export const resetImage = (): void => {
	const bodyPhoto = document.querySelector("#modalPhoto");

	bodyPhoto?.setAttribute("src", "");
};
