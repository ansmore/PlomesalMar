import { loadTextComponent } from "../helpers/dictionary.js";
export const footer = "footer";
const main = async () => {
    await loadTextComponent(footer);
};
document.addEventListener("DOMContentLoaded", main);
