<?php
//require_once 'C:\xampp\htdocs\php\cle2\test\includes\classes\pages\validation\form-validation.php';

//require_once 'includes\classes\Klant_fotograaf_reservering\Reservering.php';
/** @var mysqli $con */

const register = 'http://localhost/php/cle2/test/src/login_register/register.php';

try
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cle2";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

//Check if Post isset, else do nothing
    if (isset($_POST['submit'])) {
        //Postback with the data showed to the user, first retrieve data from 'Super global'



        $datum = mysqli_real_escape_string($conn, $_POST['Datum']);
        $tijd = mysqli_real_escape_string($conn,$_POST['Tijd']);
        $plaats =mysqli_real_escape_string($conn, $_POST['Plaats']);
        session_start();

        $user_id = $_SESSION['loggedInUser']['id'];
        $fotograaf_id =mysqli_real_escape_string($conn, $_POST['fotograaf']);



        if(empty($datum))
        {
            $error = "Vul een datum in";
        }
        else if(empty($tijd))
        {
            $error = "Vul een tijd in";
        }
        else if(empty($plaats))
        {
            $error = "Vul een plaats in";
        }
        else if(empty($fotograaf_id))
        {
            $error = "Selecteer een fotograaf";
        }


//    //Require the form validation handling

        if (empty($errors)) {

            //Save the record to the database
            $sql = "INSERT INTO reserveringen (Datum, Tijd, Plaats, user_id, Fotograaf_id)
                  VALUES ('$datum', '$tijd', '$plaats', $user_id, $fotograaf_id)";
            $result = mysqli_query($conn, $sql) or die('Error: ' . mysqli_error($conn) . ' with query ' . $sql);

            //Close connection
            mysqli_close($conn);

            // Redirect to index.php
            header('Location: index.php');
            exit;
        }
    }
        //maak verbinding met de database
        //controleer of de user ingelogd is
        //Haal de gegevens op vanuit de database
        //controleer of de user id gelijk is aan het user_id van de reservering
        //Als de submit knop ingedrukt wordt worden de veranderde gegevens meegestuurd met de post method
        //De variablen worden gecontroleerd en beveiligd
        //als dit gelukt is worden de gegevens geupdate in de database en wordt je geredirect naar de index pagina
        //als dit niet gelukt is krijg je een error message op de update pagina


        if (isset($_POST['update'])) {




            //als de update methode wordt uitgevoerd worden de gegevens beveiligd met een mysqli_real_escape_string

            $date = mysqli_real_escape_string($conn,$_POST['Datum']);
            $tijd = mysqli_real_escape_string($conn,$_POST['Tijd']);
            $plaats = mysqli_real_escape_string($conn,$_POST['Plaats']);
            session_start();
            $user_id = $_SESSION['loggedInUser']['id'];
            $fotograaf_id = mysqli_real_escape_string($conn,$_POST['fotograaf']);

            if(empty($datum))
            {
                $error = "Vul een datum in";
            }
            else if(empty($tijd))
            {
                $error = "Vul een tijd in";
            }
            else if(empty($plaats))
            {
                $error = "Vul een plaats in";
            }
            else if(empty($fotograaf_id))
            {
                $error = "Selecteer een fotograaf";
            }

            $timestamp = date('Y-m-d H:i:s', strtotime($date));
            $time = date('h:i:s:',strtotime($tijd));


            if (!isset($_GET['id']) || $_GET['id'] === '') {
                header('Location: index.php');
                exit;
            }
            $id = $_GET['id'];

            $sql = "UPDATE reserveringen SET Datum='$timestamp',Tijd='$time', Plaats = '$plaats', user_id ='$user_id',Fotograaf_id ='$fotograaf_id' WHERE id= $id";

            $result = mysqli_query($conn, $sql) or die('Error: '.mysqli_error($conn). ' with query ' . $sql);



            mysqli_close($conn);

            // Redirect to index.php
            header('Location: index.php');
            exit;
        }
        if (isset($_POST['delete'])) {
            //Postback with the data showed to the user, first retrieve data from 'Super global'



            $datum = $_POST['Datum'];
            $tijd = $_POST['Tijd'];
            $plaats = $_POST['Plaats'];
            $user_id = $_POST['user_id'];
            $fotograaf_id = $_POST['fotograaf_id'];

            if (!isset($_GET['id']) || $_GET['id'] === '') {
                header('Location: index.php');
                exit;
            }
            $id = $_GET['id'];

            $sql = "DELETE FROM reserveringen  WHERE id= $id";

            $result = mysqli_query($conn, $sql) or die('Error: '.mysqli_error($conn). ' with query ' . $sql);


            mysqli_close($conn);

            // Redirect to index.php
            header('Location: index.php');
            exit;
        }
    $login = false;
// Is user logged in?
    if (isset($_SESSION['loggedInUser'])) {
        $login = true;
    }

    if (isset($_POST['login'])) {

        // Get form data
        $email =( $_POST['u_Email']);
        $wachtwoord = $_POST['wachtwoord'];

        // Server-side validation
        $errors = [];
        if ($email == '') {
            $errors['u_Email'] = 'Please fill in your email.';
        }
        if ($wachtwoord == '') {
            $errors['wachtwoord'] = 'Please fill in your password.';
        }

        // If data valid
        if (empty($errors)) {
            // SELECT the user from the database, based on the email address.
            $sql = "SELECT * FROM users WHERE u_Email= '$email'";
//        $sql = "UPDATE reserveringen SET Fotograaf_id ='$fotograaf_id' WHERE id= $id";

//        $result = mysqli_query($conn, $sql) or die('Error: ' . mysqli_error($conn) . ' with query ' . $sql);
            $result = mysqli_query($conn, $sql);


            // check if the user exists
            if (mysqli_num_rows($result) == 1) {
                // Get user data from result
                $user = mysqli_fetch_assoc($result);
//            // Check if the provided password matches the stored password in the database

                if (!password_verify($wachtwoord, $user['wachtwoord'])) {

                    $login = true;
                    // Store the user in the session
                    $_SESSION['loggedInUser'] = [
                        'id'    => $user['id'],
                        'u_Voornaam'  => $user['u_Voornaam'],
                        'u_Email' => $user['u_Email'],
                    ];

                    // Redirect to secure page
                } else {
                    //error incorrect log in
                    $errors['loginFailed'] = 'The provided credentials do not match. het ww werkt niet';
                }

            }
            else {
                //error incorrect log in
                $errors['loginFailed'] = 'The provided credentials do not match.';
            }
        }
    }

}

catch(Exception $e)
{
    $sMsg = '<p> 
            Line: '.$e->getLine().'<br /> 
            File: '.$e->getFile().'<br /> 
            Error: '.$e->getMessage().' 
        </p>';

    trigger_error($sMsg);
}
?>