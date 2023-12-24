function loginAdmin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    if (username === 'admin' && password === '123456') {
        window.location.href = '../results/res.html'
    } else {
        alert('Invalid username or password. Please try again.');
    }
}
