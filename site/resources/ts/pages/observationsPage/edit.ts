interface User {
    id: string;
    name: string;
}

interface Departure {
    id: string;
    observer_users: User[];
}

declare const users: User[];

document.addEventListener('DOMContentLoaded', function () {
    const departureSelect = document.getElementById('departure') as HTMLSelectElement;
    const newUserSelects = document.querySelectorAll('select[name="image_user_new[]"]');

    function filterUsers(departureId: string) {
        const selectedDeparture = Array.from(departureSelect.options).find(option => option.value === departureId);
        const observerUsers: User[] = selectedDeparture ? JSON.parse(selectedDeparture.dataset.observers || '[]') : [];

        newUserSelects.forEach(select => {
            select.innerHTML = observerUsers.map(user => `<option value="${user.id}">${user.name}</option>`).join('');
        });
    }

    departureSelect.addEventListener('change', function () {
        filterUsers(departureSelect.value);
    });

    filterUsers(departureSelect.value);

    document.querySelectorAll<HTMLInputElement>('.edit-image-file, .new-image-input').forEach(input => {
        handleImagePreview(input);
    });

    document.querySelectorAll<HTMLImageElement>('.editable-image').forEach(image => {
        image.addEventListener('click', function () {
            const imageId = (this as HTMLImageElement).dataset.imageId;
            const editInput = document.querySelector<HTMLInputElement>(`.edit-image-file[data-image-id='${imageId}']`);
            if (editInput) {
                editInput.click();
            }
        });
    });

    document.querySelectorAll<HTMLButtonElement>('.delete-image').forEach(button => {
        button.addEventListener('click', function () {
            const imageId = (this as HTMLButtonElement).dataset.imageId;
            if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
                const deleteImageIdInput = document.getElementById('delete-image-id') as HTMLInputElement;
                if (deleteImageIdInput) {
                    deleteImageIdInput.value = imageId || '';
                    const deleteImageForm = document.getElementById('delete-image-form') as HTMLFormElement;
                    if (deleteImageForm) {
                        deleteImageForm.submit();
                    }
                }
            }
        });
    });

    const addNewImageBtn = document.getElementById('add-new-image');
    if (addNewImageBtn) {
        addNewImageBtn.addEventListener('click', function () {
            const container = document.getElementById('new-images-container');
            if (container) {
                const newImageDiv = document.createElement('div');
                newImageDiv.classList.add('new-image');
                newImageDiv.innerHTML = `
                    <input type="file" name="image_file_new[]" accept="image/*" class="new-image-input">
                    <img src="" class="new-image-preview" style="display:none; width:10%;">
                    <select name="image_user_new[]"></select>
                    <input type="number" name="image_number_new[]" placeholder="Photography Number">
                `;
                container.appendChild(newImageDiv);

                const newImageInput = newImageDiv.querySelector('.new-image-input') as HTMLInputElement;
                handleImagePreview(newImageInput, true);

                const newUserSelect = newImageDiv.querySelector('select[name="image_user_new[]"]') as HTMLSelectElement;
                newUserSelects[newUserSelects.length] = newUserSelect;
                filterUsers(departureSelect.value);
            }
        });
    }
});

function handleImagePreview(input: HTMLInputElement, isNew = false): void {
    const container = input.closest('.new-image') || input.closest('.image-container');
    if (!container) return;

    let preview = container.querySelector<HTMLImageElement>('.new-image-preview');
    let previewContainer = container.querySelector<HTMLDivElement>('.image-preview-container');

    if (!preview || !previewContainer) {
        previewContainer = document.createElement('div');
        previewContainer.classList.add('image-preview-container');
        previewContainer.style.display = 'none';

        previewContainer.innerHTML = `
            <img src="" class="new-image-preview" style="width:10%;">
        `;

        container.appendChild(previewContainer);
        preview = previewContainer.querySelector('.new-image-preview') as HTMLImageElement;
    }

    input.addEventListener('change', function (event: Event) {
        const file = (event.target as HTMLInputElement).files?.[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if (preview) {
                    preview.src = e.target?.result as string;
                    preview.style.display = 'block';
                }
                if (previewContainer) {
                    previewContainer.style.display = 'flex';
                }
            };
            reader.readAsDataURL(file);
        }
    });
}
