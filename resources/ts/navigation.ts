import { loadTextComponent, setLanguage } from "./helpers/dictionary.js";
export const navbar = "navigation";
let selectedOption = "en";

const main = async () => {
  loadTextComponent(navbar);
  changeLanguage(selectedOption);
  console.log("main->", selectedOption);
};

const handleClick = (event: MouseEvent) => {
  event.preventDefault();

  selectedOption = (event.target as HTMLElement).id;
  setLanguage(selectedOption);
  console.log("aqui->", selectedOption);
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
    console.log("before->", language);
    // fetch `/{language}/set-language`
    const response = await fetch(`/set-language`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ language }),
    });

    if (!response.ok) {
      console.log("response.ok->", language);
      throw new Error(`-> Error en la solicitud: ${response.status}`);
    }
    window.location.reload();
    console.log("change->", language);
  } catch (error) {
    console.error("Error al cambiar el idioma:", error);
  }
};
document.addEventListener("DOMContentLoaded", main);
