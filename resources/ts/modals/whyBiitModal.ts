import { openModal } from "../helpers/modal.js";
import { loadTextComponent } from "../helpers/dictionary.js";

// Change created by eslint to ampliate concept!
// Interface LottiePlayerElement extends Element {
//   load: (url: string) => void;
// }
type LottiePlayerElement = {
	load: (url: string) => void;
} & Element;

const component = "whyBiit";
const modalTitle = document.getElementById("modalTitle");
const modalContent = document.getElementById("modalContent");
const modalPhoto = document.querySelector("#modalPhoto") as LottiePlayerElement;
let imageUrl = "";

const loadImage = async (url: string): Promise<void> => {
	// Eliminado del if el campo -> "instanceof HTMLElement"

	if (modalPhoto && modalPhoto.tagName.toLowerCase() === "lottie-player") {
		// Modifica el atributo src de la imagen
		modalPhoto.load(url);
		// ModalPhoto?.setAttribute("src", url);
	} else {
		console.error(
			"Error: Elemento body__photo no es una etiqueta de imagen válida.",
		);
	}
};

const firstModal = () => {
	console.log("1");
	modalTitle?.setAttribute("value-text", "modulosCliente");
	modalContent?.setAttribute("value-text", "modulosClienteText");
	imageUrl =
		"https://lottie.host/9addabc8-898b-4ee6-962e-34f3df25d702/q2VBNhlQ5Y.json";
};

const secondModal = () => {
	console.log("2");
	modalTitle?.setAttribute("value-text", "modulosComercio");
	modalContent?.setAttribute("value-text", "modulosComercioText");
	imageUrl =
		"https://lottie.host/a5e8a5f8-6431-471c-bff3-69cdda4020bb/UiDRnszEKS.json";
};

const thirdModal = () => {
	console.log("3");
	modalTitle?.setAttribute("value-text", "modulosProcesos");
	modalContent?.setAttribute("value-text", "modulosProcesosText");
	imageUrl =
		"https://lottie.host/00a7d5c0-3302-4c36-8e6f-08a6c3d85be7/xwvdrMnD4u.json";
};

const fourthModal = () => {
	console.log("4");
	modalTitle?.setAttribute("value-text", "modulosFactura");
	modalContent?.setAttribute("value-text", "modulosFacturaText");
	imageUrl =
		"https://lottie.host/928097fb-7738-4e2d-9eb4-6e4fb4641d89/wivNW9NuVC.json";
};

const fiveModal = () => {
	console.log("5");
	modalTitle?.setAttribute("value-text", "modulosBusiness");
	modalContent?.setAttribute("value-text", "modulosBusinessText");
	imageUrl =
		"https://lottie.host/4988d73d-0d49-4562-8729-c12a9add5725/6HwavVnFbt.json";
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
				case "fifthModal":
					fiveModal();
					break;
				default:
					modalTitle.setAttribute("value-text", "");
					modalContent.setAttribute("value-text", " ");
					break;
			}

			void loadTextComponent(component);
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
				openModal("#infoModal");

				// // Update contend after modal open
				await selectContend(modalId);
			}
		});
	});
};
