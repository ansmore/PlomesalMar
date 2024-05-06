import { setupModalEventListeners } from "../modals/species/editDeleteModal.js";
document.addEventListener("DOMContentLoaded", () => {
    const filtro = document.getElementById('filtro');
    let debounceTimeout;
    async function loadData(url) {
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
                setupModalEventListeners();
            }
            const newPagination = tempDiv.querySelector('.pagination__box');
            const currentPagination = document.querySelector('.pagination__box');
            if (newPagination && currentPagination) {
                currentPagination.innerHTML = newPagination.innerHTML;
                setupModalEventListeners();
            }
            bindPaginationLinks();
        }
        catch (error) {
            console.error('Fetch error:', error.message);
        }
    }
    function bindPaginationLinks() {
        document.querySelectorAll('.pagination__box a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const pageUrl = e.target.href;
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
        filtro.addEventListener('input', function () {
            clearTimeout(debounceTimeout);
            debounceTimeout = window.setTimeout(() => {
                const searchValue = filtro.value;
                const baseUrl = window.location.href.split('?')[0];
                const newUrl = `${baseUrl}?search=${encodeURIComponent(searchValue)}`;
                loadData(newUrl);
            }, 300);
        });
    }
});
