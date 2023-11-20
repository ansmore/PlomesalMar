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

  let selectedPage = "footer";
  try {
    const dictionary = await loadDictionary(selectedLanguage, selectedPage);

    document.querySelector("#footer-politica")!.textContent =
      dictionary.footerPolitica;
    document.querySelector("#footer-use")!.textContent = dictionary.footerUse;
    document.querySelector("#footer-copyright")!.textContent =
      dictionary.footerCopyright;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
