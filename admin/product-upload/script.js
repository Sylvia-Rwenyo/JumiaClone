function previewFiles() {
    const previewContainer = document.getElementById('file-preview-container');
    const fileInput = document.getElementById('file-input');
    const files = fileInput.files;

    // Check if there are uploaded files
    if (files.length === 0) {
        // No files selected, do nothing
        return;
    }

    // Append new images to the existing previewContainer
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();

        // Define container here to make it accessible in the event listener
        const container = document.createElement('div');

        reader.onload = function (e) {
            const imgElement = document.createElement('img');
            imgElement.src = e.target.result;
            imgElement.className = 'file-preview-image';

            // Create a cancel button
            const cancelButton = document.createElement('button');
            cancelButton.innerHTML = '<i class="fa-solid fa-trash"></i>';
            cancelButton.className = 'cancel-button';
            cancelButton.addEventListener('click', function () {
                // Remove the entire container and clear the file input
                previewContainer.removeChild(container);
                fileInput.value = '';
                document.getElementById('file-text').textContent = 'Choose files';
            });

            // Append the image and cancel button to the container
            container.appendChild(imgElement);
            container.appendChild(cancelButton);

            // Append the container to the previewContainer
            previewContainer.appendChild(container);
        };

        reader.readAsDataURL(files[i]);
    }

    
}
