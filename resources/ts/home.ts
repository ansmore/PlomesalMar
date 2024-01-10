import {
  loadDictionary,
  loadAbailablesLanguages,
  loadAbailablesFiles,
  getFileNameFromUrl,
} from "./helpers/dictionary.js";

const setLanguage = async (selectedLanguage: string) => {
  try {
    const navigatorLanguage = navigator.language.slice(0, 2);

    if (navigatorLanguage === selectedLanguage) {
      console.log(
        "Selected language is the same of browser:",
        selectedLanguage,
      );
    }

    localStorage.setItem("selectedLanguage", selectedLanguage);
    console.log("Selected language:", selectedLanguage);
    await chargeText();
  } catch (error) {
    console.error("Error handling language click", error);
  }
};

const setupLanguageDropdown = (availableLanguages: string[]) => {
  const setLanguages = document.getElementById("setLanguages");

  if (setLanguages) {
    setLanguages.addEventListener("click", async (event) => {
      event.preventDefault();

      const selectedLanguageElement = event.target as HTMLElement;
      const selectedLanguage = selectedLanguageElement.id;

      if (availableLanguages.includes(selectedLanguage)) {
        await setLanguage(selectedLanguage);
      }
    });
  }
};

const chargeText = async () => {
  const abailableLanguages = await loadAbailablesLanguages();
  const abailablePages = await loadAbailablesFiles();

  // Recupera el idioma almacenado localmente
  const selectedLanguage = localStorage.getItem("selectedLanguage") || "";

  const navigatorLanguage = navigator.language.slice(0, 2);
  const currentUrl = window.location.href;
  const fileName = getFileNameFromUrl(currentUrl) as string;

  const finalSelectedLanguage =
    abailableLanguages.includes(navigatorLanguage) ||
    abailableLanguages.includes(navigatorLanguage)
      ? selectedLanguage || navigatorLanguage
      : "es";
  const selectedPage = abailablePages.includes(fileName) ? fileName : "home";

  try {
    const dictionary = await loadDictionary(
      finalSelectedLanguage,
      selectedPage,
    );

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

document.addEventListener("DOMContentLoaded", async () => {
  const availableLanguages = await loadAbailablesLanguages();
  setupLanguageDropdown(availableLanguages);
});
