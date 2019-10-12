function checkPasswordMatches() {
    var pwd1 = document.getElementById('p1').value;
    var pwd2 = document.getElementById('p2').value;
    var disabled = true;

    if (pwd1 == pwd2) {
        disabled = false;
    } else {
        disabled = true;
    }
    document.getElementById('save').disabled = disabled;
    return disabled;
}