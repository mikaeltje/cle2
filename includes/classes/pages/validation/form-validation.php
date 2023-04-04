<?php
//Require database in this file & image helpers

    $errors = [];
    if ($datum == "") {
        $errors['Datum'] = 'Datum kan niet leeg zijn';
    }
    if ($tijd == "") {
        $errors['Tijd'] = 'tijd kan niet leeg zijn';
    }
    if ($plaats == "") {
        $errors['Plaats'] = 'Plaats kan niet leeg zijn';
    }
    if (!is_numeric($klant_id)) {
        $errors['Klant_id'] = 'klant_id moet een nummer zijn';
    }
    if ($klant_id == "") {
        $errors['Klant_id'] = 'Klant_id kan niet leeg zijn';
    }
    if (!is_numeric($fotograaf_id)) {
        $errors['Fotograaf_id'] = 'fotograaf_id moet een nummer zijn';
    }
    if ($fotograaf_id == "") {
        $errors['Fotograaf_id'] = 'fotograaf_id kan niet leeg zijn';
    }
