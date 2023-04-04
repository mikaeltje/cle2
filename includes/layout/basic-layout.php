<?php require_once 'C:\xampp\htdocs\php\cle2\test\includes\initialize.php';

session_start();




//pak voornaam van sessie
//$name = $_SESSION['loggedInUser']['u_Voornaam'];


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/output.css">
    <title>Reserveringen</title>
</head>
<body>

<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <a href="index.php">
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Fotografie</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="flex flex-col p-4 mt-4 border  md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                <?php
                if (!isset($_SESSION['loggedInUser'])) {

                ?>

                    <li>
                        <a href="login.php"
                           class="block py-2 pl-3 pr-4  md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white   md:dark:hover:bg-transparent">Login</a>
                    </li>
                    <li>
                        <a href="register.php"
                           class="block py-2 pl-3 pr-4  md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white   md:dark:hover:bg-transparent">Register</a>
                    </li>
                <?php }else{
                ?>
                    <li>
                        <a href="index.php"
                           class="block py-2 pl-3 pr-4  md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white   md:dark:hover:bg-transparent">Reserveringen</a>
                    </li>
                    <li>
                        <a href="#"
                           class="block py-2 pl-3 pr-4  md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white   md:dark:hover:bg-transparent">Over
                            ons</a>
                    </li>
                    <li>
                        <a href="logout.php"
                           class="block py-2 pl-3 pr-4  md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white   md:dark:hover:bg-transparent ">Logout </a>
                    </li>
                <?php }
                ?>

            </ul>
        </div>
    </div>
</nav>

</body>
</html>