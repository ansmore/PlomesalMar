import {
	getFinalLanguage,
	loadTextComponent,
	setLanguage,
	getFirstSegment,
	getSecondSegment,
	getIdSegment,
	getThirdSegment,
	getOthersSegments,
} from "../helpers/dictionary.js";
export const navbar = "navigation";

let selectedOption = null;

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
		const currentUrl = window.location.href;
		const firstSegment = getFirstSegment(currentUrl)!;
		const secondSegment = await getSecondSegment(currentUrl)!;
		const idSegment = await getIdSegment(currentUrl)!;
		const thirdSegment = await getThirdSegment(currentUrl)!;
		const othersSegments = await getOthersSegments(currentUrl);

		// DeveloperMode
		console.log("current", currentUrl);
		console.log("first", firstSegment);
		console.log("second", secondSegment);
		console.log("id", idSegment);
		console.log("third", thirdSegment);
		console.log("others", othersSegments);

		const csrfToken = document
			.querySelector("meta[name=csrf-token]")
			?.getAttribute("content");

		const response = await fetch(`/sendLanguage`, {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": csrfToken ?? "",
			},
			body: JSON.stringify({
				language,
				firstSegment,
				secondSegment,
				idSegment,
				thirdSegment,
				othersSegments,
			}),
		});

		if (response.ok) {
			const responseData = await response.json();

			let {
				newUrl,
				firstItemQueriString,
				secondItemQueriString,
				thirdItemQueriString,
			} = responseData;

			if (firstItemQueriString !== "") {
				console.log("newUrl String ->", newUrl);
				console.log(
					"ordenation firstItemQueriString->",
					firstItemQueriString,
				);
				newUrl += `?${firstItemQueriString}`;

				console.log("Aqui newURL string->", newUrl);
			} else if (secondItemQueriString !== "") {
				console.log("newUrl secondItemQueriString->", newUrl);
				console.log(
					"ordenation secondItemQueriString->",
					secondItemQueriString,
				);
				newUrl += `?${secondItemQueriString}`;

				console.log("Aqui newURL secondItemQueriString->", newUrl);
			} else if (thirdItemQueriString !== "") {
				console.log("newUrl thirdItemQueriString->", newUrl);
				console.log(
					"ordenation thirdItemQueriString->",
					thirdItemQueriString,
				);
				newUrl += `?${thirdItemQueriString}`;

				console.log("Aqui newURL thirdItemQueriString->", newUrl);
			}

			if (typeof newUrl === "string") {
				history.replaceState({ url: newUrl }, "", newUrl);
			}
		}

		// DeveloperMode
		// if (!response.ok) {
		// 	console.error("! response.ok->", language);
		// 	throw new Error(`-> Error en la solicitud: ${response.status}`);
		// }
	} catch (error) {
		console.error("Error al cambiar el idioma:", error);
	}
};

document.addEventListener("DOMContentLoaded", main);
