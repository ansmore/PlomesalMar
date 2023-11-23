import {
  loadDictionary,
  loadAbailablesLanguages,
  loadAbailablesFiles,
} from "./helpers/dictionary.js";

const chargeText = async () => {
  const abailableLanguages = await loadAbailablesLanguages();
  // const abailablePages = await loadAbailablesFiles();

  const navigatorLanguage = navigator.language.slice(0, 2);
  // const fileName = window.location.href.split("/").slice(-1)[0];
  // temporal HardCode
  const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
    ? navigatorLanguage
    : "es";
  // const selectedPage = abailablePages.includes(fileName)
  //   ? fileName
  //   : "home";

  // Hardcode for components
  let selectedPage = "navigationBiit";
  try {
    const dictionary = await loadDictionary(selectedLanguage, selectedPage);

    const textsToChange = document.querySelectorAll("[value-text]");

    textsToChange.forEach((element) => {
      const dataValue = element.getAttribute("value-text");
      if (dataValue && dictionary[dataValue]) {
        element!.textContent = dictionary[dataValue];
      }
    });
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

const toggleDropdown = (event: MouseEvent | Event) => {
  event.preventDefault();
  console.log("Clic en el párrafo");

  const dropdownMenu = document.querySelector(".dropdown-menu")!;
  dropdownMenu.classList.toggle("show");
};

const closeDropdown = (event: MouseEvent) => {
  const dropdownMenu = document.querySelector(".dropdown-menu")!;
  if (
    !(event.target instanceof Element) ||
    !event.target.matches(".dropdown-toggle")
  ) {
    dropdownMenu.classList.remove("show");
  }
};

const handleDOMContentLoaded = () => {
  const dropdownToggle = document.querySelector(".dropdown-toggle");
  dropdownToggle?.addEventListener("click", toggleDropdown);

  document.addEventListener("click", (event) => closeDropdown(event));
};

window.addEventListener("load", chargeText);
document.addEventListener("DOMContentLoaded", handleDOMContentLoaded);
