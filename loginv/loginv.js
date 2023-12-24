document.addEventListener('DOMContentLoaded', function () {
    var loginButton = document.querySelector('button');
    loginButton.addEventListener('click', function () {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        window.location.href = '../dashboard/dashboard.html';
    });
});
