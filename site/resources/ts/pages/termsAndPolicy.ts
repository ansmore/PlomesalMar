import { loadText } from "../helpers/dictionary.js";

const main = async (): Promise<void> => {
	await loadText();
};

document.addEventListener("DOMContentLoaded", main);
