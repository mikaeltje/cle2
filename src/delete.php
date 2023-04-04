<?php
include 'C:\xampp\htdocs\php\cle2\test\includes\layout\basic-layout.php' ;

//session_start();


if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

//pak voornaam van sessie
$name = $_SESSION['loggedInUser']['u_Voornaam'];

?>

<a href="index.php">
    <button class="dark:bg-gray-900 mt-4 ml-3 py-2.5 px-4 dark:text-white rounded">Terug</button>
</a>

<!--<form action="" method="post">-->
    <div class="">
        <label for="Artist">Reservering</label>
    </div>
    <?php
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (!isset($_GET['id']) || $_GET['id'] === '') {
        header('Location: index.php');
        exit;
    }
    $id = $_GET['id'];

    //Retrieve the GET parameter from the 'Super global'
    $sql = '   SELECT reserveringen.id,reserveringen.user_id,reserveringen.fotograaf_id, reserveringen.Plaats, reserveringen.Tijd, reserveringen.Datum, fotograven.Voornaam, users.u_Voornaam
FROM reserveringen 
  INNER JOIN users ON reserveringen.user_id = users.id INNER JOIN fotograven ON reserveringen.fotograaf_id = fotograven.id where reserveringen.id ='. $id  ;

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row

        while ($row = $result->fetch_assoc()) {
           ?>
 <form action=''  method='post'>

 <label for='Datum'>Datum</label>
    <input class='border' id='Datum' type='date' name='Datum' value=<?= htmlentities($row["Datum"]) ?> readonly REQUIRED>


    <label for='Tijd'>Tijd</label>
    <input class='border' id='Tijd' type='time' name='Tijd' value=<?= htmlentities($row["Tijd"] )?> readonly REQUIRED>


     <label for='Plaats'>Plaats</label>
    <input class='border' id='Plaats' type='text' name='Plaats' value=<?= htmlentities($row["Plaats"]) ?> readonly REQUIRED>

    <label for='user_id'>user naam:</label>
    <input class='border' id='user_id' type='text' name='user_id' value=<?= htmlentities($row["u_Voornaam"]) ?> readonly REQUIRED>

    <label for='Fotograaf_id'>Fotograad Naam:</label>
    <input class='border' id='Fotograaf_id' type='text' name='Fotograaf_id' value=<?= htmlentities($row["Voornaam"])?> readonly REQUIRED>

    <button class='dark:bg-gray-900 mt-4 ml-3 py-2.5 px-4 dark:text-white rounded' type='delete' name='delete'>Delete</button>

</form>

        <?php }?>
        </table></div>
    <?php } else {
        echo "0 results";
    }
    $conn->close();
    ?>

