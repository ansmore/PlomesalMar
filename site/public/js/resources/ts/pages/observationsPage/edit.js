"use strict";
document.addEventListener("DOMContentLoaded", function () {
    const departureSelect = document.getElementById("departure");
    const newUserSelects = document.querySelectorAll('select[name="image_user_new[]"]');
    function filterUsers(departureId) {
        const selectedDeparture = Array.from(departureSelect.options).find((option) => option.value === departureId);
        const observerUsers = selectedDeparture
            ? JSON.parse(selectedDeparture.dataset.observers ?? "[]")
            : [];
        newUserSelects.forEach((select) => {
            select.innerHTML = observerUsers
                .map((user) => `<option value="${user.id}">${user.name}</option>`)
                .join("");
        });
    }
    departureSelect.addEventListener("change", function () {
        filterUsers(departureSelect.value);
    });
    filterUsers(departureSelect.value);
    document
        .querySelectorAll(".edit-image-file, .new-image-input")
        .forEach((input) => {
        handleImagePreview(input);
    });
    document
        .querySelectorAll(".editable-image")
        .forEach((image) => {
        image.addEventListener("click", function () {
            const imageId = this.dataset.imageId;
            const editInput = document.querySelector(`.edit-image-file[data-image-id='${imageId}']`);
            if (editInput) {
                editInput.click();
            }
        });
    });
    document
        .querySelectorAll(".delete-image")
        .forEach((button) => {
        button.addEventListener("click", function () {
            const imageId = this.dataset.imageId;
            if (confirm("¿Estás seguro de que deseas eliminar esta imagen?")) {
                const deleteImageIdInput = document.getElementById("delete-image-id");
                if (deleteImageIdInput) {
                    deleteImageIdInput.value = imageId ?? "";
                    const deleteImageForm = document.getElementById("delete-image-form");
                    if (deleteImageForm) {
                        deleteImageForm.submit();
                    }
                }
            }
        });
    });
    const addNewImageBtn = document.getElementById("add-new-image");
    if (addNewImageBtn) {
        addNewImageBtn.addEventListener("click", function () {
            const container = document.getElementById("new-images-container");
            if (container) {
                const newImageDiv = document.createElement("div");
                newImageDiv.classList.add("new-image");
                newImageDiv.innerHTML = `
                    <input type="file" name="image_file_new[]" accept="image/*" class="new-image-input">
                    <img src="" class="new-image-preview" style="display:none; width:10%;">
                    <select name="image_user_new[]"></select>
                    <input type="number" name="image_number_new[]" placeholder="Photography Number">
                `;
                container.appendChild(newImageDiv);
                const newImageInput = newImageDiv.querySelector(".new-image-input");
                handleImagePreview(newImageInput, true);
                const newUserSelect = newImageDiv.querySelector('select[name="image_user_new[]"]');
                newUserSelects[newUserSelects.length] = newUserSelect;
                filterUsers(departureSelect.value);
            }
        });
    }
});
function handleImagePreview(input, isNew = false) {
    const container = input.closest(".new-image") ?? input.closest(".image-container");
    if (!container)
        return;
    let preview = container.querySelector(".new-image-preview");
    let previewContainer = container.querySelector(".image-preview-container");
    if (!preview || !previewContainer) {
        previewContainer = document.createElement("div");
        previewContainer.classList.add("image-preview-container");
        previewContainer.style.display = "none";
        previewContainer.innerHTML = `
            <img src="" class="new-image-preview" style="width:10%;">
        `;
        container.appendChild(previewContainer);
        preview = previewContainer.querySelector(".new-image-preview");
    }
    input.addEventListener("change", function (event) {
        const file = event.target.files?.[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if (preview) {
                    preview.src = e.target?.result;
                    preview.style.display = "block";
                }
                if (previewContainer) {
                    previewContainer.style.display = "flex";
                }
            };
            reader.readAsDataURL(file);
        }
    });
}
