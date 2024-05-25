import { loadText } from "../helpers/dictionary.js";
const main = async () => {
    await loadText();
};
document.addEventListener("DOMContentLoaded", main);
