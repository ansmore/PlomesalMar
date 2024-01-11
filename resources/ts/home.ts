import {
  loadDictionary,
  loadAbailablesLanguages,
  loadAbailablesFiles,
  isLanguageSupported,
  getNavigatorLanguage,
  getCurrentFileName,
  getSelectedLanguage,
} from "./helpers/dictionary.js";

const setLanguage = async (
  selectedLanguage: string,
  supportedLanguages: string[],
) => {
  try {
    let navigatorLanguage = await getNavigatorLanguage();
    console.log("before", navigatorLanguage);
    if (!isLanguageSupported(navigatorLanguage, supportedLanguages)) {
      console.log(
        `Home->Unsupported navigator language: ${navigatorLanguage}. Sorry!`,
      );
      navigatorLanguage = "";
    }
    console.log("after", navigatorLanguage);
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

const setupLanguageDropdown = (availableLanguages: string[]) => {
  const setLanguages = document.getElementById("setLanguages");

  if (setLanguages) {
    setLanguages.addEventListener("click", async (event) => {
      event.preventDefault();

      const selectedLanguageElement = event.target as HTMLElement;
      const selectedLanguage = selectedLanguageElement.id;

      if (availableLanguages.includes(selectedLanguage)) {
        await setLanguage(selectedLanguage, availableLanguages);
      }
    });
  }
};

const chargeText = async () => {
  const abailableLanguages = await loadAbailablesLanguages();
  const abailablePages = await loadAbailablesFiles();

  const selectedLanguage = await getSelectedLanguage();

  const navigatorLanguage = await getNavigatorLanguage();
  const fileName = await getCurrentFileName();

  const finalSelectedLanguage =
    abailableLanguages.includes(selectedLanguage) ||
    abailableLanguages.includes(navigatorLanguage)
      ? selectedLanguage || navigatorLanguage
      : "en";
  const selectedPage = abailablePages.includes(fileName) ? fileName : "home";
  console.log("list", abailableLanguages);
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
      // if (dataValue && dictionary[dataValue]) {
      //   const { textContent } = element;
      //   element.textContent = dictionary[dataValue];
      // }
    });
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

document.addEventListener("DOMContentLoaded", chargeText);

document.addEventListener("DOMContentLoaded", async () => {
  const availableLanguages = await loadAbailablesLanguages();
  setupLanguageDropdown(availableLanguages);
  chargeText();
});
