// Type Dictionary = Record<string, string>;
type Dictionary = {
	[clave: string]: string;
};

// Here-> Pending import from globals
const defaultLanguage = "es";
import { navbar } from "../components/navigation.js";
import { footer } from "../components/footer.js";
// Export let counterComponent = 0;
// Export let counterPage = 0;

export const loadDictionary = async (
	language: string,
	page: string,
): Promise<Dictionary> => {
	try {
		const response = await fetch(
			`./../dictionary/${language}/${language}_${page}.json`,
		);
		if (!response.ok) {
			throw new Error(`Error loading the language ${language}.`);
		}

		return (await response.json()) as Dictionary;
	} catch (error) {
		console.error("Error loading json", error);
		throw error;
	}
};

// Const availableLanguages = ["en", "es", "ca"];
export const loadAvailablesLanguages = async (): Promise<string[]> => {
	try {
		const response = await fetch("./../dictionary/listLanguages.json");
		if (!response.ok) {
			throw new Error("Error loading white language list");
		}

		return (await response.json()) as string[];
	} catch (error) {
		console.error("Error loading white language list", error);
		throw error;
	}
};

export const loadAvailablesFiles = async (): Promise<string[]> => {
	try {
		const response = await fetch("./../dictionary/listPages.json");
		if (!response.ok) {
			throw new Error("Error loading white page list");
		}

		return (await response.json()) as string[];
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
		}

		console.error("fileName es undefined después de split('#').");
	} else {
		console.error("La URL no tiene segmentos.");
	}

	return undefined;
};

export const isLanguageSupported = async (
	language: string,
): Promise<boolean> => {
	const supportedLanguages = await loadAvailablesLanguages();

	return !supportedLanguages.includes(language);
};

export const getNavigatorLanguage = async (): Promise<string> =>
	navigator.language.slice(0, 2) || "";

export const getCurrentFileName = async (): Promise<string> => {
	const currentUrl = window.location.href;
	const fileName = getFileNameFromUrl(currentUrl)!;
	return fileName;
};

export const getSelectedLanguage = async (): Promise<string> => {
	const selectedLanguage = localStorage.getItem("selectedLanguage") ?? "";

	return selectedLanguage;
};

export const getFinalLanguage = async (): Promise<string> => {
	try {
		const availableLanguages = await loadAvailablesLanguages();

		const selectedLanguage = await getSelectedLanguage();
		const navigatorLanguage = await getNavigatorLanguage();

		const finalSelectedLanguage =
			availableLanguages.includes(selectedLanguage) ||
			availableLanguages.includes(navigatorLanguage)
				? selectedLanguage || navigatorLanguage
				: defaultLanguage;

		localStorage.setItem("selectedLanguage", finalSelectedLanguage);

		return finalSelectedLanguage;
	} catch (error) {
		console.error("Error loading the text", error);

		return defaultLanguage;
	}
};

export const setLanguage = async (selectedLanguage: string) => {
	try {
		let navigatorLanguage = await getNavigatorLanguage();

		// If return false, this language is not in white list!
		if (await isLanguageSupported(navigatorLanguage)) {
			console.log(
				`Your navigator languages unsuported! ${navigatorLanguage}. Sorry!`,
			);
			navigatorLanguage = "";
		}

		localStorage.setItem("selectedLanguage", selectedLanguage);

		await loadText();
		await loadTextComponent(navbar);
		await loadTextComponent(footer);
	} catch (error) {
		console.error("Error handling language click", error);
	}
};

export const loadText = async () => {
	try {
		// CounterPage += 1;
		const availablePages = await loadAvailablesFiles();

		const fileName = await getCurrentFileName();
		const finalSelectedLanguage = await getFinalLanguage();

		const selectedPage = availablePages.includes(fileName) ? fileName : "home";

		const dictionary = await loadDictionary(
			finalSelectedLanguage,
			selectedPage,
		);

		const textsToChange = document.querySelectorAll("[value-text]");

		textsToChange.forEach((element) => {
			const dataValue = element.getAttribute("value-text");
			if (dataValue && dictionary[dataValue]) {
				element.textContent = dictionary[dataValue];
			}
		});
	} catch (error) {
		console.error("Error loading text", error);
	}
};

export const loadTextComponent = async (component: string) => {
	try {
		const finalSelectedLanguage = await getFinalLanguage();

		// From components parameter
		const selectedPage = component;

		const dictionary = await loadDictionary(
			finalSelectedLanguage,
			selectedPage,
		);

		const textsToChange = document.querySelectorAll("[value-text]");

		textsToChange.forEach((element) => {
			const dataValue = element.getAttribute("value-text");
			if (dataValue && dictionary[dataValue]) {
				element.textContent = dictionary[dataValue];
			}
		});
	} catch (error) {
		console.error("Error loading the text", error);
	}
};
