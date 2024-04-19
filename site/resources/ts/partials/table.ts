import { loadTextComponent } from "../helpers/dictionary.js";
export const table = "table";

const main = async () => {
	await loadTextComponent(table);
};

document.addEventListener("DOMContentLoaded", main);
