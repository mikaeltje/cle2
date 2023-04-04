<?php
include 'C:\xampp\htdocs\php\cle2\test\includes\layout\basic-layout.php';

//session_start();


if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

//pak voornaam en id van sessie
$name = $_SESSION['loggedInUser']['u_Voornaam'];
$user = $_SESSION['loggedInUser']['id'];


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header('Location: index.php');
    exit;
    //als de user id niet klopt met de id uit de reservering
    // wordt de user geredirect naar de index pagina(overzicht pagina)
}
// haal de id op uit de url
$id = $_GET['id'];


//haal alle gegevens uit de database met hetzelfde id als de url'
$sql = '    SELECT * FROM reserveringen where id =' . $id;

$result = $conn->query($sql);



?>

<a href="index.php">
    <button class="dark:bg-gray-900 mt-4 ml-3 py-2.5 px-4 dark:text-white rounded">Terug</button>
</a>
<!--<form action="" method="post">-->
<div class="">
    <label for="Artist">Reservering</label>
    <input type="text">
</div>

<?php
if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {

if ($row['user_id'] != $user ){
    //als de id van de ingelogde user niet gelijk staat aan het user_id krijg je een redirect
$message = "Je hebt hier geen toegang voor";

header("Location: index.php?Message=".$message);
exit;
}
        ?>
        <form action='' method='post'>

            <label for='Datum'>Datum:</label>
            <input class='border' id='Datum' min="<?= date("Y-m-d", strtotime("+1 day"))?>" type='date' name='Datum' value=<?= $row["Datum"] ?> REQUIRED>

            <label for='Tijd'>Tijd:</label>
            <input class='border' id='Tijd' min="09:00" max="16:00" type='time' name='Tijd' value=<?= $row["Tijd"] ?> REQUIRED>

            <label for='Plaats'>Plaats:</label>
            <input class='border' id='Plaats' type='text' name='Plaats' value=<?= $row["Plaats"] ?> REQUIRED>

            <label>Fotograaf:</label>
            <select name="fotograaf">
                <?php
                $sql = 'SELECT * FROM fotograven;';
                //haal alles uit de database van fotograven
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <option name="Fotograaf_id" id="Fotograaf_id"
                                value="<?= $row["id"] ?>"><?= $row["Voornaam"] ?></option>
                        <?php
                    }
//                    $conn->close();

                } else {
                    echo "0 results";
                }
                //                    $conn->close();
                ?>

            </select>


            <button class='dark:bg-gray-900 mt-4 ml-3 py-2.5 px-4 dark:text-white rounded' type='submit' name='update'>
                update
            </button>

        </form>
        <?php
    }
} else {
    echo "0 results";
}
//$conn->close();
?>







