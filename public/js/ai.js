const fileInput = document.getElementById("file-input");
const previewImage = document.getElementById("preview-image");

fileInput.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = (e) => {
            previewImage.src = e.target.result;
            previewImage.style.display = "block";
        };

        reader.readAsDataURL(file);
    } else {
        previewImage.src = "";
        previewImage.style.display = "none";
    }
});
