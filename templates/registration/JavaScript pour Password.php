<?php

// Mettre un id dans ta balise p
<p class="fw-lighter text-medium-grey " id='contraintLength'></p>
<p class="fw-lighter text-medium-grey " id= 'contraintMajuscule'></p>
<p class="fw-lighter text-medium-grey " id= 'contraintChiffre'></p>
<p class="fw-lighter text-medium-grey " id= 'contraintSpecial'></p>

// faire une class dans ton css
.textGreen {
    color: rgb(0, 225, 0) !important;
}

//Code Javascript
<script>
    const inputPassword = document.getElementById('registration_form_plainPassword_first');
    const contraintLength = document.getElementById('contraintLength');
    const contraintMajuscule = document.getElementById('contraintMajuscule');
    const contraintChiffre = document.getElementById('contraintChiffre');
    const contraintSpecial = document.getElementById('contraintSpecial');

    const checkLength = (item) => {
        if (item >= 8 && item <= 40) {
            contraintLength.classList.add('textGreen');

        } else {
            contraintLength.classList.remove('textGreen');
        }
    }

    const checkMajuscule = (item) => {
        if (item.match(new RegExp("[A-Z]"))) {
            contraintMajuscule.classList.add('textGreen');
        } else {
            contraintMajuscule.classList.remove('textGreen');

        }
    }

    const checkChiffre = (item) => {
        if (item.match(new RegExp("[0-9]"))) {

            contraintChiffre.classList.add('textGreen');
        } else {
            contraintChiffre.classList.remove('textGreen');

        }
    }

    inputPassword.addEventListener('keyup', () => {
        let actualLength = inputPassword.value.length;
        // console.log(actualLength);
        checkLength(actualLength);

        let inputValue = inputPassword.value;
        checkMajuscule(inputValue);
        checkChiffre(inputValue);
    })
</script>