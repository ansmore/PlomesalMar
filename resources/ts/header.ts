import { loadTextComponent } from "./helpers/dictionary.js";
export const header = "header";

const main = async () => {
  loadTextComponent(header);
};

document.addEventListener("DOMContentLoaded", main);
