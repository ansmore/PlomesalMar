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
  // let fileName = "home";

  const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
    ? navigatorLanguage
    : "es";
  const selectedPage = abailablePages.includes(fileName) ? fileName : "home";

  try {
    const dictionary = await loadDictionary(selectedLanguage, selectedPage);

    document.getElementById("title")!.textContent = dictionary.title;
    document.getElementById("description")!.textContent =
      dictionary.description;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
