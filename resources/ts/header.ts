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

  let selectedPage = "header";
  try {
    const dictionary = await loadDictionary(selectedLanguage, selectedPage);

    document.querySelector("#intro-lead-in")!.textContent =
      dictionary.introLeadIn;
    document.querySelector("#intro-heading")!.textContent =
      dictionary.introHeading;
    document.querySelector("#intro-button")!.textContent =
      dictionary.introButton;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
