import { loadModal } from "../modals/loginModal.js";
import { loadText } from "../helpers/dictionary.js";

const main = async (): Promise<void> => {
	await loadText();
	await loadModal();
};

document.addEventListener("DOMContentLoaded", main);
