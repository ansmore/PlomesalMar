document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector<HTMLDivElement>('#table-container');

    if (!container) {
        console.error('The container #table-container does not exist in the DOM.');
        return;
    }

    const updateContent = async (url: string) => {
        try {
            const response = await fetch(url);
            const html = await response.text();
            container.innerHTML = html;
            console.log("Received HTML:", html);
        } catch (error) {
            console.error('Error loading the page:', error);
        }
    };

    container.addEventListener('click', (event: Event) => {
        const target = event.target as HTMLElement;

        if (target.matches('[data-bs-toggle="modal"], [data-bs-toggle="modal"] *')) {
            const button = target.closest<HTMLButtonElement>('[data-bs-toggle="modal"]');
            if (button) {
                const selector = button.getAttribute('data-bs-target');
                if (selector) {
                    const modal = document.querySelector<HTMLElement>(selector);
                    if (modal) {
                        modal.style.display = 'flex';
                    } else {
                        console.error("Modal not found:", selector);
                    }
                }
            }
        }

        if (target.matches('[data-bs-dismiss="modal"], [data-bs-dismiss="modal"] *')) {
            const modal = target.closest<HTMLElement>('.modal-wrapper, .modal-create');
            if (modal) {
                modal.style.display = 'none';
            }
        }

        if (target.matches('.pagination .page-link, .pagination .page-link *')) {
            event.preventDefault();
            const link = target.closest<HTMLAnchorElement>('.page-link');
            if (link && link.href) {
                updateContent(link.href);
            }
        }
    });
});
