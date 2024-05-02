import { setupModalEventListeners } from '../modals/species/editDeleteModal';
document.addEventListener("DOMContentLoaded", () => {
    const filtro = document.getElementById('filtro');
    let debounceTimeout;
    function loadData(url) {
        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html',
            },
        })
            .then(response => response.text())
            .then(html => {
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
        })
            .catch(error => {
            console.error('Fetch error:', error.message);
        });
    }
    function bindPaginationLinks() {
        document.querySelectorAll('.pagination__box a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const pageUrl = e.target.href;
                const searchValue = filtro ? filtro.value : '';
                const baseUrl = window.location.href.split('?')[0];
                const newUrl = `${baseUrl}?search=${encodeURIComponent(searchValue)}&${pageUrl.split('?')[1]}`;
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
