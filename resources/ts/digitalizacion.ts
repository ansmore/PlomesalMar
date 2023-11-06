import { loadDictionary, loadAbailablesLanguages } from "./helpers/dictionary.js";

const chargeText = async () => {
    const abailableLanguages = await loadAbailablesLanguages();
  
    const navigatorLanguage = navigator.language.slice(0, 2);
  
    const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
      ? navigatorLanguage
      : "es";
  
    try {
      const dictionary = await loadDictionary(selectedLanguage);
  
      document.querySelector("#titleNuevo")!.textContent = dictionary.titleNuevo;
      document.querySelector("#descriptionDigitalizacion")!.textContent = dictionary.descriptionDigitalizacion;
        
    } 
    catch (error) {
      console.error("Error loading the text", error);
    }
  };
  
  chargeText();