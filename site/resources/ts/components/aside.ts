import { loadTextComponent } from "../helpers/dictionary.js";
export const aside = "aside";

const main = async () => {
	await loadTextComponent(aside);
};

document.addEventListener("DOMContentLoaded", main);
