"use strict";
// import fetch from "node-fetch";
// Función para cargar el diccionario desde un archivo JSON
const cargarDiccionario = (url) => {
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
        document.getElementById("title").textContent = diccionario.title;
        document.getElementById("description").textContent =
            diccionario.description;
    })
        .catch((error) => {
        console.error("Error al cargar el texto", error);
    });
};
// Llamar a la función principal para cargar el texto
cargarTexto();
