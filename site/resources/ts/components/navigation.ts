import {
	getFinalLanguage,
	getNavigatorLanguage,
	loadTextComponent,
	setLanguage,
	getCurrentFileName,
} from "../helpers/dictionary.js";
export const navbar = "navigation";

let selectedOption = null;

console.log("Aqui! Padel!!!!");

const main = async () => {
	void loadTextComponent(navbar);
	const finalSelectedLanguage = await getFinalLanguage();
	void changeLanguage(finalSelectedLanguage);
};

const handleClick = (event: MouseEvent) => {
	event.preventDefault();

	selectedOption = (event.target as HTMLElement).id;
	void setLanguage(selectedOption);
	void changeLanguage(selectedOption);

	const toggleCheckbox = document.getElementById(
		"toggle-menu-checkbox",
	) as HTMLInputElement;
	toggleCheckbox.checked = false;
};

document.addEventListener("DOMContentLoaded", () => {
	const dropDownLinks = document.querySelectorAll("#setLanguages a");
	dropDownLinks.forEach((link) => {
		link.addEventListener("click", handleClick as EventListener);
	});

	const menuLinks = document.querySelectorAll(
		".navbar__menu .list__item__link",
	);
	menuLinks.forEach((link) => {
		link.addEventListener("click", () => {
			const toggleCheckbox = document.getElementById(
				"toggle-menu-checkbox",
			) as HTMLInputElement;
			toggleCheckbox.checked = false;
		});
	});

	const submenuLinks = document.querySelectorAll(".dropdown__menu__item");
	submenuLinks.forEach((link) => {
		link.addEventListener("click", () => {
			const toggleCheckbox = document.getElementById(
				"toggle-menu-checkbox",
			) as HTMLInputElement;
			toggleCheckbox.checked = false;
		});
	});
});

const changeLanguage = async (language: string) => {
	try {
		const fileName = await getCurrentFileName();
		const csrfToken = document
			.querySelector("meta[name=csrf-token]")
			?.getAttribute("content");

		const response = await fetch(`/sendLanguage`, {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": csrfToken ?? "",
			},
			body: JSON.stringify({ language, fileName }),
		});

		if (response.ok) {
			const responseData = await response.json();
			// const responseData = (await response.json()) as string[];

			const { newUrl } = responseData;

			if (typeof newUrl === "string") {
				history.replaceState({ url: newUrl }, "", newUrl);
			}
		}

		if (!response.ok) {
			console.error("! response.ok->", language);
			throw new Error(`-> Error en la solicitud: ${response.status}`);
		}
	} catch (error) {
		console.error("Error al cambiar el idioma:", error);
	}
};

document.addEventListener("DOMContentLoaded", main);