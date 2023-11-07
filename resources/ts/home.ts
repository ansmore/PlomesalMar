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

  try {
    const dictionary = await loadDictionary(selectedLanguage);

    document.getElementById("title")!.textContent = dictionary.title;
    document.getElementById("description")!.textContent =
      dictionary.description;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
