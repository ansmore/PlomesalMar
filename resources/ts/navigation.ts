import { chargeTextComponent } from "./helpers/dictionary.js";
export const navbar = "navigation";

const main = async () => {
  chargeTextComponent(navbar);
};
document.addEventListener("DOMContentLoaded", main);
