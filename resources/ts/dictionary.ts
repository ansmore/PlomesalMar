// import fetch from "node-fetch";

// type Dictionary = {
//   [clave: string]: string;
// };

// const chargeDictionary = async (): Promise<Dictionary> => {
//   try {
//     const response = await fetch("../dictionary/es/es.json");
//     const datos: Dictionary = await response.json();
//     return datos;
//   } catch (error) {
//     console.error("Error al cargar json", error);
//     throw error;
//   }
// };

// const chargeText = async () => {
//   try {
//     const dictionary = await chargeDictionary();
//     document.getElementById("title")!.textContent = dictionary.title;
//     document.getElementById("description")!.textContent =
//       dictionary.description;
//   } catch (error) {
//     console.error("Error al cargar el texto", error);
//   }
// };

// chargeText();

type Dictionary = {
  [clave: string]: string;
};

// Función para cargar el diccionario desde un archivo JSON
const cargarDiccionario = (url: string): Promise<Dictionary> => {
  return fetch(url)
    .then((response) => response.json())
    .catch((error) => {
      console.error("Error al cargar el archivo JSON", error);
      throw error;
    });
};

// Función principal asincrónica
const cargarTexto = () => {
  cargarDiccionario("./dictionary/es/es.json")
    .then((diccionario) => {
      document.getElementById("title")!.textContent = diccionario.title;
      document.getElementById("description")!.textContent =
        diccionario.description;
    })
    .catch((error) => {
      console.error("Error al cargar el texto", error);
    });
};

// Llamar a la función principal para cargar el texto
cargarTexto();
