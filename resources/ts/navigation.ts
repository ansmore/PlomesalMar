import {
  loadDictionary,
  loadAbailablesLanguages,
} from "./helpers/dictionary.js";

const chargeText = async () => {
  const abailableLanguages = await loadAbailablesLanguages();

  const navigatorLanguage = navigator.language.slice(0, 2);

  const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
    ? navigatorLanguage
    : "es";

  // Hardcode for components
  let selectedPage = "navigation";

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

document.addEventListener("DOMContentLoaded", chargeText);
