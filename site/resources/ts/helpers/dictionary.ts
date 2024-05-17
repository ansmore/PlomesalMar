type Dictionary = {
	[clave: string]: string;
};
// Type Dictionary = Record<string, string>;

// Here-> Pending import from globals
const defaultLanguage = "es";
import { navbar } from "../components/navigation.js";
import { aside } from "../components/aside.js";

import { table } from "../partials/table.js";

export const loadDictionary = async (
	language: string,
	page: string,
): Promise<Dictionary> => {
	try {
		const response = await fetch(
			`/dictionary/${language}/${language}_${page}.json`,
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
		const response = await fetch("/dictionary/listLanguages.json");
		if (!response.ok) {
			throw new Error("Error loading white language list");
		}

		return (await response.json()) as string[];
	} catch (error) {
		console.error("Error loading white language list", error);
		throw error;
	}
};

// Const availablePages = ["home", "management", "species" ...];
export const loadAvailablesFiles = async (): Promise<string[]> => {
	try {
		const response = await fetch("/dictionary/listPages.json");
		if (!response.ok) {
			throw new Error("Error loading white page list");
		}

		return (await response.json()) as string[];
	} catch (error) {
		console.error("Error loading white page list", error);
		throw error;
	}
};

export const isLanguageSupported = async (
	language: string,
): Promise<boolean> => {
	const supportedLanguages = await loadAvailablesLanguages();

	return !supportedLanguages.includes(language);
};

export const getNavigatorLanguage = async (): Promise<string> => {
	const language = navigator.language.slice(0, 2) || "";

	return language;
};

export const getFirstSegment = (url: string): string | undefined => {
	try {
		const segments = url.split("/");

		console.log("current", segments);
		const languageIndex = segments.findIndex((segment) =>
			/^[a-z]{2}$/i.test(segment),
		);

		if (languageIndex !== -1 && segments.length > languageIndex + 1) {
			const nextPageSegment = segments[languageIndex + 1];
			if (nextPageSegment) {
				// Comprovació addicional per seguretat
				return nextPageSegment.split("#")[0];
			}
		}

		throw new Error(
			"No es pot determinar el fitxer des de la URL proporcionada.",
		);
	} catch (error) {
		console.error("Error en processar la URL:", error);
		return undefined;
	}
};

export const getSecondSegment = (url: string): string | undefined => {
	try {
		const segments = url.split("/");
		const languageIndex = segments.findIndex((segment) =>
			/^[a-z]{2}$/i.test(segment),
		);

		if (languageIndex !== -1 && segments.length > languageIndex + 1) {
			const nextPageSegment = segments[languageIndex + 2];
			if (nextPageSegment) {
				// Comprovació addicional per seguretat
				return nextPageSegment.split("#")[0];
			} else {
				return undefined;
			}
		}

		throw new Error(
			"No es pot determinar el sub-fitxer des de la URL proporcionada.",
		);
	} catch (error) {
		console.error("Error en processar la URL:", error);
		return undefined;
	}
};

export const getIdSegment = (url: string): string | undefined => {
	try {
		const segments = url.split("/");
		const languageIndex = segments.findIndex((segment) =>
			/^[a-z]{2}$/i.test(segment),
		);

		if (languageIndex !== -1 && segments.length > languageIndex + 1) {
			const nextPageSegment = segments[languageIndex + 3];
			if (nextPageSegment) {
				// Comprovació addicional per seguretat
				return nextPageSegment.split("#")[0];
			} else {
				return undefined;
			}
		}

		throw new Error("No es pot determinar la id des de la URL proporcionada.");
	} catch (error) {
		console.error("Error en processar la URL:", error);
		return undefined;
	}
};

export const getOthersSegments = async (url: string): Promise<string> => {
	const segments = url.split("/");

	// Mostrar segments per a depuració
	console.log("Aqui-> segments-> ", segments);

	// Començar des del sisè element (índex 5)
	const relevantSegments = segments.slice(5).join("/");

	// Mostrar segments per a depuració
	console.log("Aqui-> resultat-> ", relevantSegments);

	// Retorna els segments rellevants com a cadena
	return relevantSegments;
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
		await loadTextComponent(aside);
		await loadTextComponent(table);
		await loadTextComponent(table);
	} catch (error) {
		console.error("Error handling language click", error);
	}
};

export const loadText = async () => {
	try {
		const currentUrl = window.location.href;
		const availablePages = await loadAvailablesFiles();
		const firstSegment = await getFirstSegment(currentUrl)!;
		const finalSelectedLanguage = await getFinalLanguage();

		const selectedPage = availablePages.includes(firstSegment)
			? firstSegment
			: "home";

		const dictionary = await loadDictionary(
			finalSelectedLanguage,
			selectedPage,
		);

		const textsToChange = document.querySelectorAll("[data-text]");

		textsToChange.forEach((element) => {
			const dataValue = element.getAttribute("data-text");
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

		const textsToChange = document.querySelectorAll("[data-text]");

		textsToChange.forEach((element) => {
			const dataValue = element.getAttribute("data-text");
			if (dataValue && dictionary[dataValue]) {
				element.textContent = dictionary[dataValue];
			}
		});
	} catch (error) {
		console.error("Error loading the text", error);
	}
};
