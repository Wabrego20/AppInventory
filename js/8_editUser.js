/*
 *Función para deshabilitar la edición del perfil del usuario
 */

function cancelEditUser() {
    document.querySelector(".btnEditUser").style.pointerEvents = "auto";
    document.querySelector(".btnEditUser").style.opacity = 1;
    document.querySelector(".btnCancelEdit").style.pointerEvents = "none";
    document.querySelector(".btnCancelEdit").style.opacity = 0.5;
    document.querySelector(".btnSaveUser").style.pointerEvents = "none";
    document.querySelector(".btnEditPhoto").style.pointerEvents = "none";
    document.querySelector(".btnSaveUser").style.opacity = 0.5;
    document.querySelectorAll(".btnTxt").forEach(function (element) {
        element.style.pointerEvents = "none";
    });
}
/*
 *Función para habilitar la edición del perfil del usuario
 */
function EditUser() {
    document.querySelector(".btnEditUser").style.pointerEvents = "none";
    document.querySelector(".btnEditUser").style.opacity = 0.5;
    document.querySelector(".btnCancelEdit").style.pointerEvents = "auto";
    document.querySelector(".btnCancelEdit").style.opacity = 1;
    document.querySelector(".btnSaveUser").style.opacity = 1;
    document.querySelector(".btnSaveUser").style.pointerEvents = "auto";
    document.querySelector(".btnEditPhoto").style.pointerEvents = "auto";
    document.querySelectorAll(".btnTxt").forEach(function (element) {
        element.style.pointerEvents = "auto";
    });
}
/*
 *Función para editar o cargar la imagen de perfil del usuario
 */
function btnEditPhotoProfile() {
    document.getElementById("btnEditPhotoProfile").click();
}
document
    .getElementById("btnEditPhotoProfile")
    .addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.querySelector(".fa-camera-retro").style.display = "none";
                const preview = document.getElementById("users_profile_picture");
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    });