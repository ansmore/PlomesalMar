import { openModal } from "../helpers/modal.js";
import { loadTextComponent } from "../helpers/dictionary.js";

const component = "aside";
const modalTitle = document.getElementById("modalTitle");
const teamTitle = document.getElementById("teamTitle");
const modalTitle2 = document.getElementById("modalTitle2");
const modalPosition = document.getElementById("modalPosition");
const teamPosition = document.getElementById("teamPosition");
const modalContent = document.getElementById("modalContent");
const modalPhoto = document.querySelector("#modalPhoto") as HTMLElement;
let imageUrl = "";

const loadImage = async (url: string): Promise<void> => {
	if (modalPhoto) {
		modalPhoto?.setAttribute("src", url);
	} else {
		console.error(
			"Error: Elemento body__photo no es una etiqueta de imagen válida.",
		);
	}
};

const firstModal = () => {
	console.log("1");
	// modalTitle?.setAttribute("data-text", "team1");
	// modalPosition?.setAttribute("data-text", "team1position");
	// modalContent?.setAttribute("data-text", "12");
	// // team1description
	// imageUrl = "../../img/logos/logo_biit.png";
};

const secondModal = () => {
	console.log("2");
	modalTitle?.setAttribute("data-text", "services3");
	modalPosition?.setAttribute("data-text", "aboutButton");
	modalContent?.setAttribute("data-text", "services4");
	imageUrl = "../../img/logos/logo_biit.png";
};

const thirdModal = () => {
	console.log("3");
	teamTitle?.setAttribute("data-text", "services1");
	modalTitle2?.setAttribute("data-text", "services4");
	teamPosition?.setAttribute("data-text", "aboutButton");
	modalContent?.setAttribute("data-text", "homeIntro3");
	imageUrl = "../../img/logos/logo_biit.png";
};

const fourthModal = () => {
	console.log("4");
	modalTitle?.setAttribute("data-text", "team4");
	modalPosition?.setAttribute("data-text", "team4position");
	modalContent?.setAttribute("data-text", "team4description");
	imageUrl = "../../img/logos/logo_biit.png";
};

export const selectContend = async (modalId: string): Promise<void> => {
	if (modalTitle && modalContent) {
		try {
			switch (modalId) {
				case "firstModal":
					firstModal();
					break;
				case "secondModal":
					secondModal();
					break;
				case "thirdModal":
					thirdModal();
					break;
				case "fourthModal":
					fourthModal();
					break;
				default:
					modalTitle.setAttribute("data-text", "");
					modalContent.setAttribute("data-text", " ");
					break;
			}

			await loadTextComponent(component);
			await loadImage(imageUrl);
		} catch (error) {
			console.error("Error updating modal attributes", error);
		}
	}
};

export const loadModal = async (): Promise<void> => {
	// Pendiente de cambiar a abrir por Id
	const modalButtons = document.querySelectorAll(".modal-button");

	modalButtons.forEach((button) => {
		button.addEventListener("click", async () => {
			const modalId = button.getAttribute("data-modal-id");
			if (modalId) {
				// // Open modal with specific id to modal
				// openModal("#infoModal");
				if (modalId === "secondModal") {
					openModal("1");
				} else {
					openModal("2");
				}

				// // Update contend after modal open
				await selectContend(modalId);
			}
		});
	});
};
