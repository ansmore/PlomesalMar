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

    document.querySelector("#titleNuevo")!.textContent = dictionary.titleNuevo;
    document.querySelector("#descriptionDigitalizacion")!.textContent =
      dictionary.descriptionDigitalizacion;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};
chargeText();
