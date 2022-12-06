function checkPassword() {
    if (document.getElementById('psw').value != 'admin') {
        alert('Incorrect password: reenter your password');
        event.preventDefault();
    }
}

function checkUsername() {
    if (document.getElementById('uname').value != 'admin') {
        alert('Incorrect username: reenter your username');
        event.preventDefault();
    }
}

function checkLogin() {
    checkPassword();
    checkUsername();
}