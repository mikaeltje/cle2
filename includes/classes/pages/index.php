<?php
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = '    SELECT * FROM reserveringen INNER JOIN klant ON reserveringen.klant_id = klant.ID
        INNER JOIN fotograaf ON reserveringen.fotograaf_id = fotograaf.ID';
if ($result = mysqli_query($conn, $sql)) {
//        var_dump($result);
    foreach ($result as $r) {
        foreach ($r as $result) {

        }
    }
}