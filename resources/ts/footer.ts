import { loadTextComponent } from "./helpers/dictionary.js";
export const footer = "footer";

const main = async () => {
  loadTextComponent(footer);
};

document.addEventListener("DOMContentLoaded", main);
