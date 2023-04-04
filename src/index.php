<?php
include 'C:\xampp\htdocs\php\cle2\test\includes\layout\basic-layout.php' ;
//include '..\src\login.php' ;
//include 'C:\xampp\htdocs\php\cle2\test\includes\classes\pages\add.php';

//session_start();


if (!isset($_SESSION['loggedInUser'])) {
    header("Location: login.php");
    exit;
}

//pak voornaam van sessie
$name = $_SESSION['loggedInUser']['u_Voornaam'];
$id = $_SESSION['loggedInUser']['id'];

?>

<a href="create.php">
    <button class="dark:bg-gray-900 mt-4 ml-3 py-2.5 px-4 dark:text-white rounded">create</button>
</a>



<?php

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//
//if (!isset($_GET['id']) || $_GET['id'] === '') {
//    header('Location: index.php');
//    exit;
//}
//$id = $_GET['id'];

$sql = "SELECT reserveringen.id, reserveringen.Plaats, fotograven.Voornaam, users.u_Voornaam FROM reserveringen 
    INNER JOIN fotograven ON reserveringen.fotograaf_id = fotograven.id
    INNER JOIN users ON reserveringen.user_id = users.id where user_id ='$id'";

$result = $conn->query($sql);
if(isset($_GET['Message'])){
    echo $_GET['Message'];
}
if ($result->num_rows > 0) {?>
<!--    // output data of each row-->
   <div class='flex justify-center mt-2 '>
       <table class='  table-auto'><tr>
            <th class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'>ID</th>
            <th class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'>plaats</th>
            <th class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'>Fotograaf naam</th>
            <th class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'>user name</th></tr>
           <?php

           while ($row = $result->fetch_assoc()) {?>


            <tr class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'>
                <td class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'><?= htmlentities($row["id"]) ?></td>
                <td class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'><?= htmlentities($row["Plaats"]) ?></td>
                <td class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'> <?= htmlentities($row["Voornaam"]) ?></td>
                <td class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'> <?= htmlentities($row["u_Voornaam"] )?></td>
                <td class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'><a href='update.php?id=<?= htmlentities($row["id"] )?>'>wijzig</a></td>
                <td class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'><a href='details.php?id=<?= htmlentities($row["id"]) ?>'>Bekijk</a></td>
                <td class='border-b border-slate-200 dark:border-slate-600 p-4 pr-8 text-slate-500 dark:text-slate-400'><a href='delete.php?id=<?= htmlentities($row["id"] )    ?>'>Delete</a></td>

            </tr>

   <?php }
           ?>
    </table></div>
<?php           } else {
    echo " er zijn nog geen reserveringen aangemaakt";
}
$conn->close();
?>
