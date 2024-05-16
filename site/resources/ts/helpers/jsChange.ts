document.addEventListener('DOMContentLoaded', async () => {
    const main = document.querySelector('main[data-view]');
    const viewType = main ? main.getAttribute('data-view') : undefined;
    let currentCleanupFunction: any = null;

    try {
        if (currentCleanupFunction) {
            currentCleanupFunction();
        }

        switch (viewType) {
            case 'boats': {
                const boatsModule = await import('../modals/boats/modals.js');
                boatsModule.setupModalEventListenersBoats();
                currentCleanupFunction = boatsModule.cleanupBoats;
                console.log("Barcos cargados.");
                break;
            }

            case 'species': {
                const speciesModule = await import('../modals/species/modals.js');
                speciesModule.setupModalEventListenersSpecies();
                currentCleanupFunction = speciesModule.cleanupSpecies;
                console.log("Species cargadas.");
                break;
            }
            
            default:
                console.warn('No hay un tipo que soporte este vista:', viewType);
                break;
        }
    } catch (error) {
        console.error('Fallo en cargar:', error);
    }
});
