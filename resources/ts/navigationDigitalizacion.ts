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

  let selectedPage = "navigationDigitalizacion";
  try {
    const dictionary = await loadDictionary(selectedLanguage, selectedPage);

    document.getElementById("nav-service")!.textContent = dictionary.navService;
    document.getElementById("nav-agente")!.textContent = dictionary.navAgente;
    document.getElementById("nav-requisitos")!.textContent =
      dictionary.navRequisitos;
    document.getElementById("nav-bono")!.textContent = dictionary.navBono;
    document.getElementById("nav-faq")!.textContent = dictionary.navFaq;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
