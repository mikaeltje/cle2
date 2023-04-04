<?php
include 'C:\xampp\htdocs\php\cle2\test\includes\layout\basic-layout.php';

//session_start();

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
                if ($result) {
                    $message = "welkom ".$user['u_Voornaam'];
                    header("Location: index.php?Message=".$message);
                    exit;
                }
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
?>

<body class="bg-no-repeat bg-cover bg-center bg-fixed min-h-screen pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif; background-image: url('../images/gemeentenissewaard.jpg')">
<main class="bg-white max-w-lg mx-auto p-8 md:p-12 mt-14 rounded-lg shadow-2xl">
    <section>
        <h3 class="font-bold text-2xl">Login</h3>
        <p class="text-gray-600 pt-2">Log hier in op je account</p>
    </section>

    <?php if ($login) { ?>
        <p>Je bent ingelogd!</p>
        <p><a href="logout.php">Uitloggen</a> / <a href="index.php">Naar index pagina</a></p>
    <?php } else { ?>
        <section class="mt-10">
            <form class="flex flex-col" autocomplete="off" action="" method="post">
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input type="text" id="u_Email" autocomplete="off" name="u_Email" value="<?= $email ?? '' ?>" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                    <p class="help is-danger">
                        <?= $errors['u_Email'] ?? '' ?>
                    </p>
                </div>

                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <input type="password" id="wachtwoord" autocomplete="off" name="wachtwoord" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                    <?php if(isset($errors['loginFailed'])) { ?>
                        <div class="notification is-danger">
                            <button class="delete"></button>
                            <?=$errors['loginFailed']?>
                        </div>
                    <?php } ?>
                </div>
<!--                <div class="flex justify-end">-->
<!--                    <a href="#" class="text-sm text-purple-600 hover:text-purple-700 hover:underline mb-6">Forgot your password?</a>-->
<!--                </div>-->
                <button class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200"
                        type="submit" name="login">log In</button>
            </form>
        </section>
    <?php } ?>
</main>
<div class="max-w-lg mx-auto bg-white rounded-lg md:p-6 mt-4">
    <div class="max-w-lg mx-auto text-center mt-2 mb-6">
        <p class="text-black">Nog geen account? <a href="register.php" class="font-bold hover:underline">Sign up</a>.</p>
    </div>
</div>
</body>
<footer class="max-w-lg mx-auto flex justify-center text-black">
    <a href="index.php" class="hover:underline">Home</a>
    <span class="mx-3">•</span>
    <a href="#" class="hover:underline">Reserveringen</a>
</footer>