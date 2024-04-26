"use strict";
document.addEventListener("DOMContentLoaded", () => {
    const filtro = document.getElementById('filtro');
    if (filtro !== null) {
        filtro.addEventListener('input', function () {
            const searchValue = this.value;
            const baseUrl = window.location.href.split('?')[0];
            const newUrl = `${baseUrl}?search=${encodeURIComponent(searchValue)}`;
            fetch(newUrl, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                },
            })
                .then((response) => response.text())
                .then((html) => {
                const tableContainer = document.querySelector('#table-container');
                if (tableContainer !== null) {
                    tableContainer.innerHTML = html;
                }
            })
                .catch((error) => {
                console.error('Fetch error:', error.message);
            });
        });
    }
});
