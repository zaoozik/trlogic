"use strict";

let language_select_form = document.getElementById('language_select_form');
let language_select_select = document.getElementById('language_select_select');

language_select_select.addEventListener("change", () => {
    language_select_form.submit();
});