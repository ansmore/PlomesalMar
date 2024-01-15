import { loadTextComponent, setLanguage } from "./helpers/dictionary.js";
export const navbar = "navigation";

const main = async () => {
  loadTextComponent(navbar);
};

const handleClick = (event: MouseEvent) => {
  event.preventDefault();

  const selectedOption = (event.target as HTMLElement).id;
  setLanguage(selectedOption);
};

document.addEventListener("DOMContentLoaded", () => {
  const dropDownLinks = document.querySelectorAll("#setLanguages a");
  dropDownLinks.forEach((link) => {
    link.addEventListener("click", handleClick as EventListener);
  });
});

document.addEventListener("DOMContentLoaded", main);
