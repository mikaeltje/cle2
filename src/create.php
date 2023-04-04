<?php
include 'C:\xampp\htdocs\php\cle2\test\includes\layout\basic-layout.php' ;

//session_start();


if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

//pak voornaam van sessie

?>
<a href="index.php">
    <button class="dark:bg-gray-900 mt-4 ml-3 py-2.5 px-4 dark:text-white rounded">Terug</button>
</a>
<form action="" method="post">
    <div class="">
        <label for="Artist">Reservering</label>
        <input type="text">
    </div>


    <label for="Datum">Datum:</label>
    <input class="border" id="Datum" type="date" name="Datum" min="<?= date("Y-m-d", strtotime("+1 day"))?>" value="<?= $datum ?? '' ?>" REQUIRED>

    <label for="Tijd">Tijd:<span>(tussen 09:30 en 16:00)</span></label>
    <input class="border" id="Tijd" min="09:30" max="16:00" type="time" name="Tijd" value="<?= $tijd ?? '' ?>" REQUIRED>

    <label for="Plaats">Plaats:</label>
    <input class="border" id="Plaats" type="text" name="Plaats" value="<?= $plaats ?? '' ?>" REQUIRED>

    <label>Selecteer een fotograaf</label>
    <select name="fotograaf">
        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = 'SELECT * FROM fotograven;';

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <option name="Fotograaf_id" id="Fotograaf_id"
                        value="<?= $row["id"] ?>"><?= $row["Voornaam"] ?></option>
                <?php
            }

        } else {
            echo "0 results";
        }
        ?>

    </select>

    <button class="dark:bg-gray-900 mt-4 ml-3 py-2.5 px-4 dark:text-white rounded" type="submit" name="submit">Save</button>

</form>
