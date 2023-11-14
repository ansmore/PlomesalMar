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

    document.querySelector("#home-services")!.textContent =
      dictionary.homeServices;
    document.querySelector("#home-services-subheading")!.textContent =
      dictionary.homeServicesSubheading;

    document.querySelector("#services-1")!.textContent = dictionary.services1;

    document.querySelector("#services-2")!.textContent = dictionary.services2;
    document.querySelector("#services-3")!.textContent = dictionary.services3;
    document.querySelector("#services-4")!.textContent = dictionary.services4;
    document.querySelector("#services-5")!.textContent = dictionary.services5;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
