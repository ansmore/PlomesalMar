import {
  loadDictionary,
  loadAbailablesLanguages,
  loadAbailablesFiles,
  isLanguageSupported,
  getNavigatorLanguage,
  getCurrentFileName,
  getSelectedLanguage,
  getFinalLanguage,
} from "./helpers/dictionary.js";

const setLanguage = async (selectedLanguage: string) => {
  try {
    let navigatorLanguage = await getNavigatorLanguage();
    // const supportedLanguages = await loadAbailablesLanguages();

    // If return false, this language is not in white list!
    if (await isLanguageSupported(navigatorLanguage)) {
      console.log(
        `Home->Your navigator languages unsuported! ${navigatorLanguage}. Sorry!`,
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
  try {
    const abailablePages = await loadAbailablesFiles();
    setupLanguageDropdown();
    const fileName = await getCurrentFileName();
    const finalSelectedLanguage = await getFinalLanguage();

    const selectedPage = abailablePages.includes(fileName) ? fileName : "home";

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
