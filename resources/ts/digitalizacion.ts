import {
  loadDictionary,
  loadAbailablesLanguages,
  loadAbailablesFiles,
} from "./helpers/dictionary.js";

const chargeText = async () => {
  const abailableLanguages = await loadAbailablesLanguages();
  const abailablePages = await loadAbailablesFiles();

  const navigatorLanguage = navigator.language.slice(0, 2);
  const fileName = window.location.href.split("/").slice(-1)[0];
  // temporal HardCode
  // let fileName = "digitalizacion";

  const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
    ? navigatorLanguage
    : "es";
  const selectedPage = abailablePages.includes(fileName) ? fileName : "home";

  try {
    const dictionary = await loadDictionary(selectedLanguage, selectedPage);

    document.querySelector("#services-heading")!.textContent =
      dictionary.servicesHeading;
    document.querySelector("#services-text")!.textContent =
      dictionary.servicesText;
    document.querySelector("#services-letter")!.textContent =
      dictionary.servicesLetter;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};
chargeText();
