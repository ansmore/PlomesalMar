import {
  getFinalLanguage,
  getNavigatorLanguage,
  loadTextComponent,
  setLanguage,
  getCurrentFileName,
} from "../helpers/dictionary.js";
export const navbar = "navigation";
let selectedOption = null;

const main = async () => {
  loadTextComponent(navbar);
  const finalSelectedLanguage = await getFinalLanguage();
  changeLanguage(finalSelectedLanguage);
};

const handleClick = (event: MouseEvent) => {
  event.preventDefault();

  selectedOption = (event.target as HTMLElement).id;
  setLanguage(selectedOption);
  changeLanguage(selectedOption);
};

document.addEventListener("DOMContentLoaded", () => {
  const dropDownLinks = document.querySelectorAll("#setLanguages a");
  dropDownLinks.forEach((link) => {
    link.addEventListener("click", handleClick as EventListener);
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
        "X-CSRF-TOKEN": csrfToken || "",
      },
      body: JSON.stringify({ language, fileName }),
    });

    if (!response.ok) {
      console.error("response.ok->", language);
      throw new Error(`-> Error en la solicitud: ${response.status}`);
    }
    if (response.ok) {
      const responseData = await response.json();

      const newUrl = responseData.newUrl;
      history.pushState({}, "", newUrl);
    }
  } catch (error) {
    console.error("Error al cambiar el idioma:", error);
  }
};
document.addEventListener("DOMContentLoaded", main);