document.addEventListener("DOMContentLoaded", async () => {
	const main = document.querySelector("main[data-view]");
	const viewType = main ? main.getAttribute("data-view") : null;
	let currentCleanupFunction: any = null;

	try {
		if (currentCleanupFunction) {
			currentCleanupFunction();
		}

		switch (viewType) {
			case "boats":
				const boatsModule = await import("../modals/boats/modals.js");
				boatsModule.setupModalEventListenersBoats();
				currentCleanupFunction = boatsModule.cleanupBoats;
				break;

			case "species":
				const speciesModule = await import("../modals/species/modals.js");
				speciesModule.setupModalEventListenersSpecies();
				currentCleanupFunction = speciesModule.cleanupSpecies;
				break;

			case "transects":
				const transectsModule = await import("../modals/transects/modals.js");
				transectsModule.setupModalEventListenersTransects();
				currentCleanupFunction = transectsModule.cleanupTransects;
				break;

			case "departures":
				const departuresModule = await import("../modals/departures/modals.js");
				departuresModule.setupModalEventListenersDepartures();
				currentCleanupFunction = departuresModule.cleanupDepartures;
				break;

			case "users":
				const usersModule = await import("../modals/users/modals.js");
				usersModule.setupModalEventListenersUsers();
				currentCleanupFunction = usersModule.cleanupUsers;
				break;

			case "observations":
				// const observationsImageModule = await import("../partials/imagePopUp.js");
				// observationsImageModule.setupImagePopup();
				// currentCleanupFunction = observationsImageModule.cleanupImagePopup;
				break;

			default:
				console.warn("No hay un tipo que soporte este vista:", viewType);
				break;
		}
	} catch (error) {
		console.error("Fallo en cargar:", error);
	}
});
