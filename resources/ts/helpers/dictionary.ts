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

// const abailableLanguages = ["en", "es"];
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
