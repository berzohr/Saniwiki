var userToDelete;
var userToEdit;
var nameToEdit;
var emailToEdit;
var passwordToEdit;
var groupToEdit;

window.onload = function () {
    userToDelete = document.getElementById("user_id");
    userToEdit = document.getElementById("userEdit_id");
    nameToEdit = document.getElementById("userEdit_name");
    emailToEdit = document.getElementById("userEdit_email");
    passwordToEdit = document.getElementById("userEdit_password");
    groupToEdit = document.getElementById("userEdit_group");
}
function userDelete(id) {
    userToDelete.value = id;
}
function userEdit(id, name, email, password, group) {
    userToEdit.value = id;
    nameToEdit.value = name;
    emailToEdit.value = email;
    passwordToEdit.value = password;
    groupToEdit.value = group;
}