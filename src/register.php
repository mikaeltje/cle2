<?php
include 'C:\xampp\htdocs\php\cle2\test\includes\layout\basic-layout.php';

if(isset($_POST['register'])) {



    // Get form data
    $voornaam = ( $_POST['u_Voornaam']);
    $achternaam = ( $_POST['u_Achternaam']);
    $email = ( $_POST['u_Email']);
    $telefoonnummer = ( $_POST['u_Telefoonnummer']);
    $wachtwoord = $_POST['wachtwoord'];

    // Server-side validation
    $errors = [];
    if($voornaam == '') {
        $errors['u_Voornaam'] = 'Please fill in your name.';
    }
    if($achternaam == '') {
        $errors['u_Achternaam'] = 'Please fill in your name.';
    }
    if($email == '') {
        $errors['u_Email'] = 'Please fill in your email.';
    }
    if($telefoonnummer == '') {
        $errors['u_telefoonnummer'] = 'Please fill in your email.';
    }
    if($wachtwoord == '') {
        $errors['wachtwoord'] = 'Please fill in your password.';
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //This email is valid
    } else {
        $errors['u_Email'] = 'Dit is geen goed email adress.';
    }
    // If data valid
    if(empty($errors)) {
        // create a secure password, with the PHP function password_hash()
//        print_r($wachtwoord);

        $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
        // store the new user in the database.
        $sql = "INSERT INTO users (u_Voornaam, u_Achternaam, u_email,u_Telefoonnummer, wachtwoord) VALUES ('$voornaam', '$achternaam','$email','$telefoonnummer', '$wachtwoord')";

        $result = mysqli_query($conn, $sql) or die('Error: ' . mysqli_error($conn) . ' with query ' . $sql);

        if ($result) {
            header('Location: login.php');
            exit;
        }
    }
}
?>

<body class="bg-no-repeat bg-cover bg-center bg-fixed min-h-screen pb-6 px-2 md:px-0">
<main class="flex justify-center mt-2">
    <section>
        <h3 class="font-bold text-2xl">Registreer</h3>
        <p class="text-gray-600 pt-2 mb-2">Maak hier je account</p>

    <section class="mt-10">
        <form class="flex flex-col" autocomplete="off" action="" method="post">
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="name">Voornaam</label>
                <input type="text" id="u_Voornaam" name="u_Voornaam"  value="<?= $voornaam ?? '' ?>" class="bg-slate-400 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                <p class="help is-danger">
                    <?= $errors['u_Voornaam'] ?? '' ?>
                </p>
            </div>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Achternaam</label>
                <input type="text" id="u_Achternaam" name="u_Achternaam"  value="<?= $achternaam ?? '' ?>" class="bg-slate-400 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                <p class="help is-danger">
                    <?= $errors['u_Achternaam'] ?? '' ?>
                </p>
            </div>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="u_Email">Email</label>
                <input type="text" id="u_Email" name="u_Email" autocomplete="off" value="<?= $email ?? '' ?>"  class="bg-slate-400 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                <p class="help is-danger">
                    <?= $errors['u_Email'] ?? '' ?>
                </p>
            </div>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Telefoonnummer</label>
                <input type="text" id="u_Telefoonnummer" name="u_Telefoonnummer" value="<?= $telefoonnummer ?? '' ?>"  class="bg-slate-400 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                <p class="help is-danger">
                    <?= $errors['u_telefoonnummer'] ?? '' ?>
                </p>
            </div>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                <input type="password" id="wachtwoord" autocomplete="new-password" name="wachtwoord" class="bg-slate-400 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3">
                <?= $errors['wachtwoord'] ?? '' ?>
            </div>

            <div class="flex justify-end">
                <a href="#" class="text-sm text-purple-600 hover:text-purple-700 hover:underline mb-6">Forgot your password?</a>
            </div>
            <button class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200"
                    type="submit" name="register">Sign In</button>
        </form>
    </section>
    </section>

</main>
<div class="max-w-lg mx-auto bg-white rounded-lg md:p-6 mt-4">
    <div class="max-w-lg mx-auto text-center mt-2 mb-6">
        <p class="text-black">Heb je al een account? <a href="Login.php" class="font-bold hover:underline">Log in</a>.</p>
    </div>

</div>
</body>
