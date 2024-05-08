import { setupModalEventListenersSpecies } from "../modals/species/modals.js";
import { setupModalEventListenersBoats } from "../modals/boats/modals.js";

document.addEventListener("DOMContentLoaded", () => {
    const body = document.querySelector('main');
    const view = body ? body.getAttribute('data-view') : null;

    const filtro: HTMLInputElement | null = document.getElementById('filtro') as HTMLInputElement;
    let debounceTimeout: number;

    async function loadData(url: string) {
        try {
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                },
            });
            const html = await response.text();
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;

            const newTbody = tempDiv.querySelector('table tbody');
            const currentTbody = document.querySelector('#table-container table tbody');
            if (newTbody && currentTbody) {
                currentTbody.innerHTML = newTbody.innerHTML;
                setupModals(view);
            }

            const newPagination = tempDiv.querySelector('.pagination__box');
            const currentPagination = document.querySelector('.pagination__box');
            if (newPagination && currentPagination) {
                currentPagination.innerHTML = newPagination.innerHTML;
                setupModals(view);
            }

            bindPaginationLinks();
        } catch (error) {
            console.error('Fetch error:', (error as Error).message);
        }
    }

    function setupModals(view: string | null) {
        if (view === 'species') {
            setupModalEventListenersSpecies();
        } else if (view === 'boats') {
            setupModalEventListenersBoats();
        }
    }

    function bindPaginationLinks() {
        document.querySelectorAll('.pagination__box a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const pageUrl = (e.target as HTMLAnchorElement).href;
                const searchValue = filtro ? filtro.value : '';
                const orderByField = new URLSearchParams(window.location.search).get('orderByField');
                const orderByDirection = new URLSearchParams(window.location.search).get('orderByDirection');
                const baseUrl = window.location.href.split('?')[0];
                let newUrl = `${baseUrl}?`;

                if (searchValue) {
                    newUrl += `search=${encodeURIComponent(searchValue)}&`;
                }

                if (orderByField && orderByDirection) {
                    newUrl += `orderByField=${orderByField}&orderByDirection=${orderByDirection}&`;
                }
    
                newUrl += pageUrl.split('?')[1];
    
                loadData(newUrl);
            });
        });
    }    

    bindPaginationLinks();

    if (filtro !== null) {
        filtro.addEventListener('input', function() {
            clearTimeout(debounceTimeout);
            debounceTimeout = window.setTimeout(() => {
                const searchValue: string = filtro.value;
                const baseUrl: string = window.location.href.split('?')[0];
                const newUrl: string = `${baseUrl}?search=${encodeURIComponent(searchValue)}`;

                loadData(newUrl);
            }, 300);
        });
    }
});
