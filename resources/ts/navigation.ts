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

    document.getElementById("nav-service")!.textContent = dictionary.navService;
    document.getElementById("nav-porfolio")!.textContent =
      dictionary.navPorfolio;
    document.getElementById("nav-team")!.textContent = dictionary.navTeam;
    document.getElementById("nav-location")!.textContent =
      dictionary.navLocation;
    document.getElementById("nav-contact")!.textContent = dictionary.navContact;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
