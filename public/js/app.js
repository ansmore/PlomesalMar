"use strict";
// const sayHello = () => {
//   alert("Hello, Welcomed!");
// };
// document.getElementById("buttonHello")?.addEventListener("click", sayHello);
// // ¡charge text new version
// import {
//   loadDictionary,
//   loadAbailablesLanguages,
//   loadAbailablesFiles,
//   getFileNameFromUrl,
// } from "./helpers/dictionary.js";
// const chargeText = async () => {
//   try {
//     const [availableLanguages, availablePages] = await Promise.all([
//       loadAvailableLanguages(),
//       loadAvailableFiles(),
//     ]);
//     const [selectedLanguage, fileName] = await Promise.all([
//       getSelectedLanguage(navigator.language.slice(0, 2), availableLanguages),
//       getFileNameFromUrl(window.location.href) as string,
//     ]);
//     const dictionary = await loadDictionary(selectedLanguage, selectedPage);
//     const textsToChange = document.querySelectorAll("[value-text]");
//     updateTexts(textsToChange, dictionary);
//   } catch (error) {
//     console.error("Error loading the text", error);
//   }
// };
// document.addEventListener("DOMContentLoaded", chargeText);
// // dictionary
// // helpers/dictionary.js
// export const loadDictionary = async (
//   language: string,
//   page: string,
// ): Promise<Dictionary> => {
//   try {
//     const response = await fetch(
//       `./dictionary/${language}/${language}_${page}.json`,
//     );
//     if (!response.ok) {
//       throw new Error(
//         `Error loading the dictionary for ${language}/${page}. Status: ${response.status}`,
//       );
//     }
//     return await response.json();
//   } catch (error) {
//     console.error("Error loading dictionary", error);
//     throw error;
//   }
// };
// // main.ts
// const chargeText = async () => {
//   try {
//     const [availableLanguages, availablePages] = await Promise.all([
//       loadAvailableLanguages(),
//       loadAvailableFiles(),
//     ]);
//     const [selectedLanguage, fileName] = await Promise.all([
//       getSelectedLanguage(navigator.language.slice(0, 2), availableLanguages),
//       getFileNameFromUrl(window.location.href) as string,
//     ]);
//     const dictionary = await loadDictionary(selectedLanguage, fileName);
//     const textsToChange = document.querySelectorAll("[value-text]");
//     updateTexts(textsToChange, dictionary);
//   } catch (error) {
//     console.error("Error loading the text:", error.message);
//   }
// };
