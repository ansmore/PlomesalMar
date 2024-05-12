import { loadText } from "../helpers/dictionary.js";

export const main = async (): Promise<void> => {
	await loadText();
};

document.addEventListener("DOMContentLoaded", main);
