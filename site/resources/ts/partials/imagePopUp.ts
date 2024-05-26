export function setupImagePopup() {
    const imagePopup = document.getElementById("image-popup");
    if (!imagePopup) {
        console.error("No se encontró el elemento con id 'image-popup'");
        return;
    }

    const imagePopupImg = imagePopup.querySelector("img");
    if (!imagePopupImg) {
        console.error("No se encontró el elemento <img> dentro de 'image-popup'");
        return;
    }

    const handleMouseOver = (event: MouseEvent) => {
        const target = event.target as HTMLImageElement;
        imagePopupImg.src = target.src;

        const rect = target.getBoundingClientRect();
        const tableRow = target.closest('tr');
        const tableBody = target.closest('tbody');
        const rows = tableBody ? Array.from(tableBody.rows) : [];
        const rowIndex = rows.indexOf(tableRow as HTMLTableRowElement);

        // Position the popup above the image for all rows
        imagePopup.style.top = `${rect.top + window.scrollY - imagePopup.offsetHeight}px`;
        imagePopup.style.left = `${rect.left + window.scrollX}px`;
        imagePopup.style.display = "block";
    };

    const handleMouseOut = () => {
        imagePopup.style.display = "none";
    };

    document.querySelectorAll(".contenedorImagen img").forEach((img) => {
        const imageElement = img as HTMLImageElement;
        imageElement.addEventListener("mouseover", handleMouseOver);
        imageElement.addEventListener("mouseout", handleMouseOut);
        (imageElement as any).mouseoverHandler = handleMouseOver;
        (imageElement as any).mouseoutHandler = handleMouseOut;
    });
}

export function cleanupImagePopup() {
    document.querySelectorAll(".contenedorImagen img").forEach((img) => {
        const imageElement = img as HTMLImageElement;
        const handleMouseOver = (imageElement as any).mouseoverHandler;
        const handleMouseOut = (imageElement as any).mouseoutHandler;

        if (handleMouseOver) {
            imageElement.removeEventListener("mouseover", handleMouseOver);
        }

        if (handleMouseOut) {
            imageElement.removeEventListener("mouseout", handleMouseOut);
        }
    });
}
