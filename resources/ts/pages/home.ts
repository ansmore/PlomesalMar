import { loadText } from "../helpers/dictionary.js";
import { loadModal } from "../modals/loginModal.js";

const main = async (): Promise<void> => {
	await loadText();
	await loadModal();
};

document.addEventListener("DOMContentLoaded", main);
