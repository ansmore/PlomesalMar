type Dictionary = {
  [clave: string]: string;
};

const chargeDictionary = async (language: string): Promise<Dictionary> => {
  try {
    // let languageCode = language;
    const response = await fetch(`./dictionary/${language}/${language}.json`);
    if (!response.ok) {
      throw new Error(`Error loading the language ${language}.`);
    }
    return await response.json();
  } catch (error) {
    console.error("Error loading json", error);
    throw error;
  }
};

// const abailableLanguages = ["en", "es"];
const loadAbailablesLanguages = async (): Promise<string[]> => {
  try {
    const response = await fetch(`./dictionary/listLanguages.json`);
    if (!response.ok) {
      throw new Error("Error loading white language list");
    }
    return await response.json();
  } catch (error) {
    console.error("Error loading white language list", error);
    throw error;
  }
};

const chargeText = async () => {
  const abailableLanguages = await loadAbailablesLanguages();

  const navigatorLanguage = navigator.language.slice(0, 2);

  const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
    ? navigatorLanguage
    : "es";

  try {
    const dictionary = await chargeDictionary(selectedLanguage);
    document.getElementById("title")!.textContent = dictionary.title;
    document.getElementById("description")!.textContent =
      dictionary.description;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
