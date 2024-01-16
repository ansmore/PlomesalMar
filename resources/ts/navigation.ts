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
    console.log("before->", selectedOption);

    const response = await fetch("/set-language", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ language }),
    });

    if (!response.ok) {
      throw new Error(`Error en la solicitud: ${response.status}`);
    }
    window.location.reload();
    console.log("change->", selectedOption);
  } catch (error) {
    console.error("Error al cambiar el idioma:", error);
  }
};
document.addEventListener("DOMContentLoaded", main);

// Variable en JavaScript
// let language = "es";

// // Redirige a la misma página incluyendo la variable en la URL
// window.location.href = "main.blade.php?language=" + language;

// // Crea un formulario dinámico y envía la variable por POST
// let form = document.createElement("form");
// form.method = "get";
// form.action = "main.blade.php";

// let input = document.createElement("input");
// input.type = "hidden";
// input.name = "language";
// input.value = language;

// form.appendChild(input);
// document.body.appendChild(form);

// form.submit();
