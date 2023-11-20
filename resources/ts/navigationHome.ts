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

  let selectedPage = "navigationHome";
  try {
    const dictionary = await loadDictionary(selectedLanguage, selectedPage);

    document.getElementById("nav-home")!.textContent = dictionary.navHome;
    document.getElementById("nav-digitalizacion")!.textContent =
      dictionary.navDigitalizacion;
    document.getElementById("nav-service")!.textContent = dictionary.navService;
    document.getElementById("nav-porfolio")!.textContent =
      dictionary.navPorfolio;
    document.getElementById("nav-location")!.textContent =
      dictionary.navLocation;
    document.getElementById("nav-contact")!.textContent = dictionary.navContact;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
