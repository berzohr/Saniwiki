var postToDelete;

window.onload = function () {
    var close = document.getElementById("close");
    var cont1 = document.getElementById("newPostInfo");
    postToDelete = document.getElementById("post_id");
}


function postDelete(id) {
    postToDelete.value = id;
}

