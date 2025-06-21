@props([
'name' => 'Usuário',
'image' => null,
'inputName' => 'profile_image',
])

<style>
    .avatar-upload {
        position: relative;
        width: 150px;
        height: 150px;
        margin: auto;
    }

    .avatar-preview {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ccc;
        transition: 0.3s;
    }

    .avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        font-size: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        cursor: pointer;
        transition: 0.3s;
    }

    .avatar-upload:hover .avatar-overlay {
        opacity: 1;
    }

    input[type="file"] {
        display: none;
    }
</style>

<div class="position-relative d-inline-block rounded-circle overflow-hidden mb-3 group" style="width: 150px; height: 150px;">
    <label for="profileImageInput" class="w-100 h-100 m-0 d-block position-relative">
        <img
            id="previewImage"
            src="{{ $image ? asset('storage/' . $image) : 'https://ui-avatars.com/api/?name=' . urlencode($name) }}"
            alt="Foto de perfil"
            class="img-fluid w-100 h-100 border rounded-circle object-fit-cover"
            style="object-fit: cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center text-white rounded-circle"
            style="opacity: 0; transition: opacity 0.3s;"
            onmouseenter="this.style.opacity = 1"
            onmouseleave="this.style.opacity = 0">
            Alterar foto de perfil
        </div>
    </label>
    <input type="file" name="{{ $inputName }}" id="profileImageInput" accept="image/*" class="d-none" onchange="previewFile(this)">
</div>




<script>
    function previewFile(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>