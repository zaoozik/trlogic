'use strict';


const form = document.getElementById('registration_form');
// Loop over them and prevent submission
form.addEventListener('submit', function (event) {
    if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
}, false);

//Login validation
let login = document.getElementById('login');
login.addEventListener('input', (e) => {

    let reg = /^[a-z0-9_-]{3,16}$/;
    if (e.target.value.match(reg)) {
        e.target.setCustomValidity("");
    } else {
        e.target.setCustomValidity("INVALID");
    }
    form.classList.add('was-validated')

});


let password = document.getElementById('password');
let password_confirm = document.getElementById('password_confirm');

//Password validation
password.addEventListener('input', (e) => {

    let reg = /^[a-z0-9_-]{4,20}$/;
    if (e.target.value.match(reg)) {
        e.target.setCustomValidity("");
    } else {
        e.target.setCustomValidity("INVALID");
    }

    if (e.target.value == password_confirm.value) {
        password_confirm.setCustomValidity("");
    } else {
        password_confirm.setCustomValidity("INVALID");
    }

    form.classList.add('was-validated')

});

//CONFIRM Password validation
password_confirm.addEventListener('input', (e) => {

    if (e.target.value == password.value) {
        e.target.setCustomValidity("");
    } else {
        e.target.setCustomValidity("INVALID");
    }
    form.classList.add('was-validated')

});