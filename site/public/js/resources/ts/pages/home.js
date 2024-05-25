import { loadText } from "../helpers/dictionary.js";
export const main = async () => {
    await loadText();
};
document.addEventListener("DOMContentLoaded", main);
