import {
  loadDictionary,
  loadAbailablesLanguages,
  loadAbailablesFiles,
} from "./helpers/dictionary.js";

const chargeText = async () => {
  const abailableLanguages = await loadAbailablesLanguages();
  const abailablePages = await loadAbailablesFiles();

  const navigatorLanguage = navigator.language.slice(0, 2);
  const fileName = window.location.href.split("/").slice(-1)[0];
  // temporal HardCode
  // let fileName = "home";

  const selectedLanguage = abailableLanguages.includes(navigatorLanguage)
    ? navigatorLanguage
    : "es";
  const selectedPage = abailablePages.includes(fileName) ? fileName : "home";

  try {
    const dictionary = await loadDictionary(selectedLanguage, selectedPage);

    document.querySelector("#home-services")!.textContent =
      dictionary.homeServices;
    document.querySelector("#home-services-subheading")!.textContent =
      dictionary.homeServicesSubheading;

    document.querySelector("#services-1")!.textContent = dictionary.services1;

    document.querySelector("#services-2")!.textContent = dictionary.services2;
    document.querySelector("#services-3")!.textContent = dictionary.services3;
    document.querySelector("#services-4")!.textContent = dictionary.services4;
    document.querySelector("#services-5")!.textContent = dictionary.services5;

    document.querySelector("#about-heading")!.textContent =
      dictionary.aboutHeading;
    document.querySelector("#about-text")!.textContent = dictionary.aboutText;
    document.querySelector("#about-button")!.textContent =
      dictionary.aboutButton;

    document.querySelector("#sitemap-heading")!.textContent =
      dictionary.sitemapHeading;
    document.querySelector("#sitemap-address")!.textContent =
      dictionary.sitemapAddress;

    document.querySelector("#contact-heading")!.textContent =
      dictionary.contactHeading;
    document.querySelector("#contact-phone")!.textContent =
      dictionary.contactPhone;

    document.querySelector("#contact-name")!.textContent =
      dictionary.contactName;
    document.querySelector("#contact-email")!.textContent =
      dictionary.contactEmail;
    document.querySelector("#contact-telephone")!.textContent =
      dictionary.contactTelephone;
    document.querySelector("#contact-message")!.textContent =
      dictionary.contactMessage;
    document.querySelector("#contacto-clausulaContacto")!.textContent =
      dictionary.contactoClausulaContacto;
    document.querySelector("#contacto-clausulaContacto2")!.textContent =
      dictionary.contactoClausulaContacto2;

    document.querySelector("#contact-accept")!.textContent =
      dictionary.contactAccept;
    document.querySelector("#contact-politica")!.textContent =
      dictionary.contactPolitica;
    document.querySelector("#contact-accept2")!.textContent =
      dictionary.contactAccept2;
    document.querySelector("#contact-use")!.textContent = dictionary.contactUse;
    document.querySelector("#contact-button")!.textContent =
      dictionary.contactButton;
  } catch (error) {
    console.error("Error loading the text", error);
  }
};

chargeText();
