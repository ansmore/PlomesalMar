type Dictionary = {
  [clave: string]: string;
};
const defaultLanguage = "es";

export const loadDictionary = async (
  language: string,
  page: string,
): Promise<Dictionary> => {
  try {
    const response = await fetch(
      `./dictionary/${language}/${language}_${page}.json`,
    );
    if (!response.ok) {
      throw new Error(`Error loading the language ${language}.`);
    }
    return await response.json();
  } catch (error) {
    console.error("Error loading json", error);
    throw error;
  }
};

// const abailableLanguages = ["en", "es", "ca"];
export const loadAbailablesLanguages = async (): Promise<string[]> => {
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

export const loadAbailablesFiles = async (): Promise<string[]> => {
  try {
    const response = await fetch(`./dictionary/listPages.json`);
    if (!response.ok) {
      throw new Error("Error loading white page list");
    }
    return await response.json();
  } catch (error) {
    console.error("Error loading white page list", error);
    throw error;
  }
};

export const getFileNameFromUrl = (url: string): string | undefined => {
  const segments = url.split("/");
  const lastSegment = segments.pop();

  // Verifica si hay al menos un segmento en la URL
  if (lastSegment !== undefined) {
    const fileName = lastSegment.split("#")[0];

    // Verifica si fileName no es undefined
    if (fileName !== undefined) {
      return fileName;
    } else {
      console.error("fileName es undefined después de split('#').");
    }
  } else {
    console.error("La URL no tiene segmentos.");
  }

  return undefined;
};

export const isLanguageSupported = async (
  language: string,
): Promise<boolean> => {
  const supportedLanguages = await loadAbailablesLanguages();
  console.log(supportedLanguages);
  console.log(language);
  console.log("dictionary->", supportedLanguages.includes(language));

  // const suported = supportedLanguages.includes(language);
  // Si el idioma no está en la lista, devolverá false
  return !supportedLanguages.includes(language);
};

export const getNavigatorLanguage = (): string => {
  return navigator.language.slice(0, 2) || "";
};

export const getCurrentFileName = (): string => {
  const currentUrl = window.location.href;
  const fileName = getFileNameFromUrl(currentUrl) as string;
  return fileName;
};

export const getSelectedLanguage = (): string => {
  let selectedLanguage = localStorage.getItem("selectedLanguage") || "";

  return selectedLanguage;
};

export const getFinalLanguage = async (): Promise<string> => {
  try {
    const abailableLanguages = await loadAbailablesLanguages();

    const selectedLanguage = await getSelectedLanguage();
    const navigatorLanguage = await getNavigatorLanguage();

    const finalSelectedLanguage =
      abailableLanguages.includes(selectedLanguage) ||
      abailableLanguages.includes(navigatorLanguage)
        ? selectedLanguage || navigatorLanguage
        : defaultLanguage;

    return finalSelectedLanguage;
  } catch (error) {
    console.error("Error loading the text", error);

    return defaultLanguage;
  }
};
