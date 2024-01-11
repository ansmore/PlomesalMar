import {
  loadDictionary,
  loadAbailablesLanguages,
  loadAbailablesFiles,
  isLanguageSupported,
  getNavigatorLanguage,
  getCurrentFileName,
  getSelectedLanguage,
} from "./helpers/dictionary.js";

let countersetLanguage = 0;
let countersetupLanguageDropdown = 0;
let counterchargeText = 0;

const setLanguage = async (selectedLanguage: string) => {
  countersetLanguage += 1;
  try {
    let navigatorLanguage = await getNavigatorLanguage();
    // const supportedLanguages = await loadAbailablesLanguages();

    // If return true, this language is not in white list!
    if (!isLanguageSupported(navigatorLanguage)) {
      console.log(
        `Your navigator languages unsuported! ${navigatorLanguage}. Sorry!`,
      );
      navigatorLanguage = "";
    }

    // Check if selected language an browser language is the same! -> To delete!
    if (navigatorLanguage === selectedLanguage) {
      console.log(
        "Selected language is the same of browser:",
        selectedLanguage,
      );
    }
    localStorage.setItem("selectedLanguage", selectedLanguage);
    console.log("Selected language:", selectedLanguage);
    await chargeText();
  } catch (error) {
    console.error("Error handling language click", error);
  }
};

const setupLanguageDropdown = async () => {
  countersetupLanguageDropdown += 1;
  const setLanguages = document.getElementById("setLanguages");
  const availableLanguages = await loadAbailablesLanguages();

  if (setLanguages) {
    setLanguages.addEventListener("click", async (event) => {
      event.preventDefault();

      const selectedLanguageElement = event.target as HTMLElement;
      const selectedLanguage = selectedLanguageElement.id;

      if (availableLanguages.includes(selectedLanguage)) {
        await setLanguage(selectedLanguage);
      }
    });
  }
};

const chargeText = async () => {
  counterchargeText += 1;
  const abailableLanguages = await loadAbailablesLanguages();
  const abailablePages = await loadAbailablesFiles();
  setupLanguageDropdown();
  const selectedLanguage = await getSelectedLanguage();

  const navigatorLanguage = await getNavigatorLanguage();
  const fileName = await getCurrentFileName();

  const finalSelectedLanguage =
    abailableLanguages.includes(selectedLanguage) ||
    abailableLanguages.includes(navigatorLanguage)
      ? selectedLanguage || navigatorLanguage
      : "en";

  const selectedPage = abailablePages.includes(fileName) ? fileName : "home";

  console.log("navigator", navigatorLanguage);
  try {
    const dictionary = await loadDictionary(
      finalSelectedLanguage,
      selectedPage,
    );

    const textsToChange = document.querySelectorAll("[value-text]");

    textsToChange.forEach((element) => {
      const dataValue = element.getAttribute("value-text");
      if (dataValue && dictionary[dataValue]) {
        element!.textContent = dictionary[dataValue];
      }
    });
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

document.addEventListener("DOMContentLoaded", chargeText);
