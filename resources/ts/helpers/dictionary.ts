type Dictionary = {
  [clave: string]: string;
};

export const loadDictionary = async (
  language: string,
  page: string,
): Promise<Dictionary> => {
  try {
    // console.log("page:", page, "language:", language);
    // let languageCode = language;
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

export const getSelectedLanguage = async (): Promise<string> => {
  try {
    const response = await fetch("./dictionary/selectedLanguage.json");
    if (!response.ok) {
      throw new Error("Error loading selected language");
    }
    return await response.json();
  } catch (error) {
    console.error("Error loading selected language", error);
    throw error;
  }
};

// export const getCurrentPage = () => {
//   const currentUrl = window.location.href;
//   const fileName = getFileNameFromUrl(currentUrl) as string;
//   return fileName || "home";
// };

export const changeLanguage = async (language: string): Promise<void> => {
  try {
    const response = await fetch("./dictionary/selectedLanguage.json", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ language }),
    });

    if (!response.ok) {
      throw new Error("Error changing language");
    }
  } catch (error) {
    console.error("Error changing language", error);
    throw error;
  }
};
