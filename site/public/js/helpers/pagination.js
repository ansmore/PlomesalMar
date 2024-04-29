"use strict";
document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('#table-container');
    if (!container) {
        console.error('The container #table-container does not exist in the DOM.');
        return;
    }
    const updateContent = async (url) => {
        try {
            const response = await fetch(url);
            const html = await response.text();
            container.innerHTML = html;
            console.log("Received HTML:", html);
        }
        catch (error) {
            console.error('Error loading the page:', error);
        }
    };
    container.addEventListener('click', (event) => {
        const target = event.target;
        if (target.matches('[data-bs-toggle="modal"], [data-bs-toggle="modal"] *')) {
            const button = target.closest('[data-bs-toggle="modal"]');
            if (button) {
                const selector = button.getAttribute('data-bs-target');
                if (selector) {
                    const modal = document.querySelector(selector);
                    if (modal) {
                        modal.style.display = 'flex';
                    }
                    else {
                        console.error("Modal not found:", selector);
                    }
                }
            }
        }
        if (target.matches('[data-bs-dismiss="modal"], [data-bs-dismiss="modal"] *')) {
            const modal = target.closest('.modal-wrapper, .modal-create');
            if (modal) {
                modal.style.display = 'none';
            }
        }
        if (target.matches('.pagination .page-link, .pagination .page-link *')) {
            event.preventDefault();
            const link = target.closest('.page-link');
            if (link && link.href) {
                updateContent(link.href);
            }
        }
    });
});
