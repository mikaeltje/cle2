  <label for='Datum'>Datum</label>
    <input class='border' id='Datum' type='date' name='Datum' value="<?= $datum ?? '' ?>" REQUIRED>
    <!--    <p class='help is-danger'>-->
    <!--        --><?//= $errors['Datum'] ?? '' ?>
    <!--    </p>-->
    <label for='Tijd'>Tijd</label>
    <input class='border' id='Tijd' type='date' name='Tijd' value="<?= $datum ?? '' ?>" REQUIRED>

    <label for='Plaats'>Plaats</label>
    <input class='border' id='Plaats' type='text' name='Plaats' value="<?= $datum ?? '' ?>" REQUIRED>

    <label for='Klant_id'>Klant_id</label>
    <input class='border' id='Klant_id' type='number' name='Klant_id' value="<?= $datum ?? '' ?>" REQUIRED>

    <label for='Fotograaf_id'>Fotograad_id</label>
    <input class='border' id='Fotograaf_id' type='number' name='Fotograaf_id' vvalue="<?= $datum ?? '' ?>" REQUIRED>

    <button class='dark:bg-gray-900 mt-4 ml-3 py-2.5 px-4 dark:text-white rounded' type='submit' name='submit'>Save</button>

</form>