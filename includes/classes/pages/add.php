<?php
/** @var mysqli $db */

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $datum   = $_POST['Datum'];
    $tijd = $_POST['Tijd'];
    $plaats  = $_POST['Plaats'];
    $klant_id   = $_POST['Klant_id'];
    $fotograaf_id = $_POST['Fotograaf_id'];

//    //Require the form validation handling
//    require_once "includes/form-validation.php";

    if (empty($errors)) {
        //Require database in this file & image helpers
        require_once "includes/database.php";

        //Save the record to the database
        $query = "INSERT INTO reserveringen (Datum, Tijd, Plaats, Klant_id, Fotograaf_id)
                  VALUES ('$datum', '$tijd', '$plaats', $klant_id, $fotograaf_id)";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        //Close connection
        mysqli_close($db);

        // Redirect to index.php
        header('Location: index.php');
        exit;
    }
}
?>