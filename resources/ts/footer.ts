import { chargeTextComponent } from "./helpers/dictionary.js";
export const footer = "navigation";

const main = async () => {
  chargeTextComponent(footer);
};
document.addEventListener("DOMContentLoaded", main);
