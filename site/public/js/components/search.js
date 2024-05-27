import { setupModalEventListenersSpecies } from "../modals/species/modals.js";
import { setupModalEventListenersBoats } from "../modals/boats/modals.js";
import { setupModalEventListenersTransects } from "../modals/transects/modals.js";
import { setupModalEventListenersDepartures } from "../modals/departures/modals.js";
import { setupModalEventListenersObservations } from "../modals/observations/modals.js";
document.addEventListener("DOMContentLoaded", () => {
    const body = document.querySelector("main");
    const view = body
        ? body.getAttribute("data-view") ?? undefined
        : undefined;
    const filtro = document.getElementById("filtro");
    let debounceTimeout;
    const setupModals = (view) => {
        if (view === "species") {
            setupModalEventListenersSpecies();
        }
        else if (view === "boats") {
            setupModalEventListenersBoats();
        }
        else if (view === "transects") {
            setupModalEventListenersTransects();
        }
        else if (view === "departures") {
            setupModalEventListenersDepartures();
        }
        else if (view === "observations") {
            setupModalEventListenersObservations();
        }
    };
    const bindPaginationLinks = () => {
        document.querySelectorAll(".pagination__box a").forEach((link) => {
            link.addEventListener("click", (e) => {
                e.preventDefault();
                const pageUrl = e.target.href;
                const searchValue = filtro ? filtro.value : "";
                const orderByField = new URLSearchParams(window.location.search).get("orderByField");
                const orderByDirection = new URLSearchParams(window.location.search).get("orderByDirection");
                const baseUrl = window.location.href.split("?")[0];
                let newUrl = `${baseUrl}?`;
                if (searchValue) {
                    newUrl += `search=${encodeURIComponent(searchValue)}&`;
                }
                if (orderByField && orderByDirection) {
                    newUrl += `orderByField=${orderByField}&orderByDirection=${orderByDirection}&`;
                }
                newUrl += pageUrl.split("?")[1];
                void loadData(newUrl);
            });
        });
    };
    const loadData = async (url) => {
        try {
            const response = await fetch(url, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    accept: "text/html",
                },
            });
            const html = await response.text();
            const tempDiv = document.createElement("div");
            tempDiv.innerHTML = html;
            const newTbody = tempDiv.querySelector("table tbody");
            const currentTbody = document.querySelector("#table-container table tbody");
            if (newTbody && currentTbody) {
                currentTbody.innerHTML = newTbody.innerHTML;
                setupModals(view);
            }
            const newPagination = tempDiv.querySelector(".pagination__box");
            const currentPagination = document.querySelector(".pagination__box");
            if (newPagination && currentPagination) {
                currentPagination.innerHTML = newPagination.innerHTML;
                setupModals(view);
            }
            bindPaginationLinks();
        }
        catch (error) {
            console.error("Fetch error:", error.message);
        }
    };
    bindPaginationLinks();
    if (filtro !== undefined) {
        filtro.addEventListener("input", () => {
            clearTimeout(debounceTimeout);
            debounceTimeout = window.setTimeout(() => {
                const searchValue = filtro.value;
                const baseUrl = window.location.href.split("?")[0];
                const newUrl = `${baseUrl}?search=${encodeURIComponent(searchValue)}`;
                void loadData(newUrl);
            }, 300);
        });
    }
});
