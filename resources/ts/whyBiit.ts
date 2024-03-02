import { loadText } from "./helpers/dictionary.js";
import { loadModal } from "./modals/whyBiitModal.js";

const main = (): void => {
  loadText();
  loadModal();
};

document.addEventListener("DOMContentLoaded", main);
