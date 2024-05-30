const addButton = document.querySelector<HTMLButtonElement>('button[data-text="addImage"]');

document.getElementById('departure')!.addEventListener('change', function() {
    const selectedOption = (this as HTMLSelectElement).options[(this as HTMLSelectElement).selectedIndex];
    const observersData = selectedOption.getAttribute('data-observers');

    if (observersData) {
        const observers = JSON.parse(observersData) as Array<{ id: string, name: string }>;

        document.querySelectorAll<HTMLSelectElement>('.image-user-select').forEach(select => {
            select.innerHTML = observers.map(observer =>
                `<option value="${observer.id}">${observer.name}</option>`
            ).join('');
        });

        addButton!.disabled = observers.length === 0;
    } else {
        console.error('No observers data found for the selected option');
        
        document.querySelectorAll<HTMLSelectElement>('.image-user-select').forEach(select => {
            select.innerHTML = '';
        });
        
        addButton!.disabled = true;
    }
});

function addImageField(): void {
    const container = document.getElementById('image-container')!;
    const div = document.createElement('div');
    div.classList.add('table__group');

    const index = container.children.length;

    div.innerHTML = `
        <label for="image_user_${index}" class="table__group__content" data-text="user">Usuari</label>
        <select name="image_user[]" id="image_user_${index}" class="table__group__select image-user-select" required></select>
        <label for="image_number_${index}" class="table__group__content" data-text="imageNumber">Numero de la imatge</label>
        <input type="number" name="image_number[]" id="image_number_${index}" class="table__group__input" required>
        <label for="image_file_${index}" class="table__group__content" data-text="image">Imatge</label>
        <input type="file" name="image_file[]" id="image_file_${index}" class="table__group__input" accept="image/*" required onchange="previewImage(event, ${index})">
        <img id="image_preview_${index}" src="" alt="Vista previa de la imagen" style="display:none; max-width: 200px; margin-top: 10px;">
    `;
    container.appendChild(div);

    const departureSelect = document.getElementById('departure') as HTMLSelectElement;
    const selectedOption = departureSelect.options[departureSelect.selectedIndex];
    const observersData = selectedOption.getAttribute('data-observers');

    if (observersData) {
        const observers = JSON.parse(observersData) as Array<{ id: string, name: string }>;
        const newSelect = div.querySelector<HTMLSelectElement>('.image-user-select')!;
        newSelect.innerHTML = observers.map(observer => `<option value="${observer.id}">${observer.name}</option>`).join('');
    } else {
        console.error('No observers data found for the selected option');
    }
}

function previewImage(event: Event, index: number): void {
    const input = event.target as HTMLInputElement;
    const preview = document.getElementById(`image_preview_${index}`) as HTMLImageElement;

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = (e.target as FileReader).result as string;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}

(window as any).addImageField = addImageField;
(window as any).previewImage = previewImage;

document.addEventListener('DOMContentLoaded', () => {
    addButton!.disabled = true;
});
