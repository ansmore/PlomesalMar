document.addEventListener('DOMContentLoaded', () => {
    initAlertMessages();
});

function initAlertMessages(): void {
    const alerts = document.querySelectorAll('.alert-success, .alert-danger') as NodeListOf<HTMLElement>;
    alerts.forEach(alert => {
        if (alert.textContent && alert.textContent.trim() !== '') {
            setTimeout(() => {
                closeAlert(alert);
            }, 5000);
        }
    });
}

export function showToast(message: string, isError: boolean = false): void {
    const alertDiv = document.createElement('div');
    alertDiv.className = `custom-alert ${isError ? 'alert-danger' : 'alert-success'}`;
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);

    // Iniciar la desaparición después de 5 segundos
    setTimeout(() => {
        closeAlert(alertDiv);
    }, 5000);
}

function closeAlert(alertElement: HTMLElement): void {
    alertElement.style.opacity = '0';
    // Esperar a que la transición de opacidad termine antes de cambiar el display
    setTimeout(() => {
        alertElement.style.display = 'none'; // Cambia display a 'none' después de que la opacidad llegue a 0
        alertElement.remove(); // Opcional: elimina el elemento del DOM
    }, 500); // Este timeout debe coincidir con la duración de la transición CSS
}

