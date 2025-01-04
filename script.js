// Mouad Garroud 
// to toggle between login and signup form
document.getElementById('loginBtn').addEventListener('click', function () {
    document.getElementById('login').style.display = 'block';
    document.getElementById('signup').style.display = 'none';
});
// to toggle between login and signup form
document.getElementById('signupBtn').addEventListener('click', function () {
    document.getElementById('login').style.display = 'none';
    document.getElementById('signup').style.display = 'block';
});
