'use strict';


const form = document.getElementById('auth_form');
// Loop over them and prevent submission
form.addEventListener('submit', function (event) {
    if (form.checkValidity() === false) {
        console.log('sdfsdf');
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
}, false);
