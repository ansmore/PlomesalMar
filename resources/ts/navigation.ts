import {
  getFinalLanguage,
  getNavigatorLanguage,
  loadTextComponent,
  setLanguage,
} from "./helpers/dictionary.js";
export const navbar = "navigation";
let selectedOption = null;

const main = async () => {
  loadTextComponent(navbar);
  const finalSelectedLanguage = await getFinalLanguage();
  changeLanguage(finalSelectedLanguage);

  // selectedOption = localStorage.getItem("selectedLanguage") || "";
  // console.log("navigation storage->", selectedOption);
  const navigatorLanguage = await getNavigatorLanguage();
  console.log("navigation navigator->", navigatorLanguage);
  // console.log("navigation final->", finalSelectedLanguage);
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
    console.log("chLang before send->", language);

    const csrfToken = document
      .querySelector("meta[name=csrf-token]")
      ?.getAttribute("content");

    console.log("CSRF Token:", csrfToken);
    console.log("JSON a enviar:", JSON.stringify({ language }));
    // fetch `/${language}/sendLanguage`
    const response = await fetch(`/sendLanguage`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": csrfToken || "",
      },
      body: JSON.stringify({ language }),
    });

    if (!response.ok) {
      console.log("response.ok->", language);
      throw new Error(`-> Error en la solicitud: ${response.status}`);
    }
    if (response.ok) {
      const responseData = await response.json();
      // Redirige a la nueva URL después de la solicitud POST exitosa
      window.location.href = responseData.newUrl;
      // window.location.reload();
    }
    window.location.reload();
    console.log("change->", language);
  } catch (error) {
    console.error("Error al cambiar el idioma:", error);
  }
};
document.addEventListener("DOMContentLoaded", main);
